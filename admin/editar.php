<?php
// admin/editar.php (Update)
require_once '../config/conexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmtCat = $pdo->prepare("SELECT id, nombre FROM categorias ORDER BY nombre ASC");
$stmtCat->execute();
$categorias = $stmtCat->fetchAll();

$stmtProd = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
$stmtProd->execute([':id' => $id]);
$producto = $stmtProd->fetch();

if (!$producto) {
    header('Location: index.php');
    exit;
}

$errores = [];
$nombre = $producto['nombre'];
$categoriaId = (int) $producto['categoria_id'];
$descripcion = (string) ($producto['descripcion'] ?? '');
$precio = (string) $producto['precio'];
$disponible = (int) $producto['disponible'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $categoriaId = (int) ($_POST['categoria_id'] ?? 0);
    $descripcion = trim($_POST['descripcion'] ?? '');
    $precioRaw = str_replace(',', '.', trim($_POST['precio'] ?? ''));
    $disponible = isset($_POST['disponible']) ? 1 : 0;

    if ($nombre === '') {
        $errores[] = 'El nombre del producto es obligatorio.';
    }
    if ($categoriaId <= 0) {
        $errores[] = 'Debés seleccionar una categoría válida.';
    }
    if ($precioRaw === '' || !is_numeric($precioRaw) || (float) $precioRaw <= 0) {
        $errores[] = 'El precio debe ser un número mayor a 0.';
    } else {
        $precio = number_format((float) $precioRaw, 2, '.', '');
    }

    if (empty($errores)) {
        $sql = "UPDATE productos
                SET categoria_id = :categoria_id,
                    nombre = :nombre,
                    descripcion = :descripcion,
                    precio = :precio,
                    disponible = :disponible
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':categoria_id' => $categoriaId,
            ':nombre'       => $nombre,
            ':descripcion'  => $descripcion !== '' ? $descripcion : null,
            ':precio'       => $precio,
            ':disponible'   => $disponible,
            ':id'           => $id,
        ]);

        header('Location: index.php?status=updated');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto — Pastelería Artesanal</title>
    <link rel="stylesheet" href="../clase5/style.css">
    <link rel="stylesheet" href="crud.css">
</head>
<body>
    <main>
        <h1>Editar Producto #<?= htmlspecialchars((string) $id, ENT_QUOTES, 'UTF-8') ?></h1>
        <p><a href="index.php">Volver al listado</a></p>

        <?php if (!empty($errores)): ?>
            <div class="alerta-error">
                <p>Revisá los siguientes errores:</p>
                <ul>
                    <?php foreach ($errores as $err): ?>
                        <li><?= htmlspecialchars($err, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="editar.php?id=<?= urlencode((string) $id) ?>" class="form-post">
            <div>
                <label for="nombre">Nombre del producto *:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div>
                <label for="categoria_id">Categoría *:</label>
                <select id="categoria_id" name="categoria_id" required>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= (int) $cat['id'] ?>" <?= $categoriaId === (int) $cat['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['nombre'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="precio">Precio *:</label>
                <input type="text" id="precio" name="precio" value="<?= htmlspecialchars($precio, ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4"><?= htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>

            <div class="checkbox-row">
                <label>
                    <input type="checkbox" name="disponible" value="1" <?= $disponible === 1 ? 'checked' : '' ?>>
                    Disponible para la venta
                </label>
            </div>

            <button type="submit">Actualizar producto</button>
        </form>
    </main>
</body>
</html>