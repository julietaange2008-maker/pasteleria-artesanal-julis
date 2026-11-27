<?php
// admin/crear.php (Create)
require_once '../config/conexion.php';

$stmtCat = $pdo->prepare("SELECT id, nombre FROM categorias ORDER BY nombre ASC");
$stmtCat->execute();
$categorias = $stmtCat->fetchAll();

$errores = [];
$nombre = '';
$categoriaId = '';
$descripcion = '';
$precio = '';
$disponible = 1;

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
        $sql = "INSERT INTO productos (categoria_id, nombre, descripcion, precio, disponible)
                VALUES (:categoria_id, :nombre, :descripcion, :precio, :disponible)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':categoria_id' => $categoriaId,
            ':nombre'       => $nombre,
            ':descripcion'  => $descripcion !== '' ? $descripcion : null,
            ':precio'       => $precio,
            ':disponible'   => $disponible,
        ]);

        header('Location: index.php?status=created');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Producto — Pastelería Artesanal</title>
    <link rel="stylesheet" href="../clase5/style.css">
    <link rel="stylesheet" href="crud.css">
</head>
<body>
    <main>
        <h1>Agregar Nuevo Producto</h1>
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

        <form method="POST" action="crear.php" class="form-post">
            <div>
                <label for="nombre">Nombre del producto *:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div>
                <label for="categoria_id">Categoría *:</label>
                <select id="categoria_id" name="categoria_id" required>
                    <option value="">Seleccioná una categoría</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= (int) $cat['id'] ?>" <?= (int) $categoriaId === (int) $cat['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['nombre'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="precio">Precio *:</label>
                <input type="text" id="precio" name="precio" value="<?= htmlspecialchars((string) $precio, ENT_QUOTES, 'UTF-8') ?>" placeholder="25000.00" required>
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

            <button type="submit">Guardar producto</button>
        </form>
    </main>
</body>
</html>