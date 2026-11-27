<?php
// admin/index.php (Read + Filtro GET seguro)
require_once '../config/conexion.php';

$status = $_GET['status'] ?? '';
$buscar = trim($_GET['buscar'] ?? '');
$categoriaFiltro = (int) ($_GET['categoria_id'] ?? 0);

$stmtCat = $pdo->prepare("SELECT id, nombre FROM categorias ORDER BY nombre ASC");
$stmtCat->execute();
$categorias = $stmtCat->fetchAll();

$sql = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.disponible, c.nombre AS categoria_nombre
        FROM productos p
        INNER JOIN categorias c ON p.categoria_id = c.id
        WHERE 1=1";
$params = [];

if ($buscar !== '') {
    $sql .= " AND p.nombre LIKE :buscar";
    $params[':buscar'] = '%' . $buscar . '%';
}

if ($categoriaFiltro > 0) {
    $sql .= " AND p.categoria_id = :categoria_id";
    $params[':categoria_id'] = $categoriaFiltro;
}

$sql .= " ORDER BY p.id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$productos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos — Pastelería Artesanal</title>
    <link rel="stylesheet" href="../clase5/style.css">
    <link rel="stylesheet" href="crud.css">
</head>
<body>
    <main>
        <h1>Pastelería Artesanal — Gestión de Productos</h1>

        <div class="barra-acciones">
            <a href="crear.php" class="btn">+ Agregar nuevo producto (POST)</a>
            <a href="pedido_rapido.php" class="btn btn-secundario">Registrar pedido rápido (POST)</a>
            <a href="../index.php" class="btn btn-secundario">Ir al inicio</a>
        </div>

        <?php if ($status === 'created'): ?>
            <div class="alerta-ok">Producto guardado correctamente.</div>
        <?php elseif ($status === 'updated'): ?>
            <div class="alerta-ok">Producto actualizado correctamente.</div>
        <?php elseif ($status === 'deleted'): ?>
            <div class="alerta-ok">Producto eliminado correctamente.</div>
        <?php elseif ($status === 'pedido_ok'): ?>
            <div class="alerta-ok">Pedido registrado correctamente en la base de datos.</div>
        <?php elseif ($status === 'fk_error'): ?>
            <div class="alerta-error">No se puede eliminar este producto porque está asociado a pedidos registrados.</div>
        <?php elseif ($status === 'error'): ?>
            <div class="alerta-error">Ocurrió un error al procesar la solicitud.</div>
        <?php endif; ?>

        <form method="GET" action="index.php" class="filtro-get">
            <div>
                <label for="buscar">Buscar por nombre (GET):</label>
                <input type="text" id="buscar" name="buscar" value="<?= htmlspecialchars($buscar, ENT_QUOTES, 'UTF-8') ?>" placeholder="Ej: Torta, Lemon pie...">
            </div>

            <div>
                <label for="categoria_id">Filtrar por categoría (GET):</label>
                <select id="categoria_id" name="categoria_id">
                    <option value="0">Todas las categorías</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= (int) $cat['id'] ?>" <?= $categoriaFiltro === (int) $cat['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['nombre'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="barra-acciones" style="margin: 0;">
                <button type="submit">Filtrar</button>
                <a href="index.php" class="btn btn-secundario">Limpiar</a>
            </div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Disponible</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($productos)): ?>
                    <tr>
                        <td colspan="7">No se encontraron productos con esos filtros.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($productos as $prod): ?>
                        <tr>
                            <td><?= htmlspecialchars((string) $prod['id'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($prod['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($prod['categoria_nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars((string) ($prod['descripcion'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                            <td>$<?= htmlspecialchars(number_format((float) $prod['precio'], 2, ',', '.'), ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <?php if ((int) $prod['disponible'] === 1): ?>
                                    <span class="badge-si">Sí</span>
                                <?php else: ?>
                                    <span class="badge-no">No</span>
                                <?php endif; ?>
                            </td>
                            <td class="acciones">
                                <a href="editar.php?id=<?= urlencode((string) $prod['id']) ?>" class="btn btn-sm btn-editar">Editar</a>
                                <a href="eliminar.php?id=<?= urlencode((string) $prod['id']) ?>" class="btn btn-sm btn-eliminar" onclick="return confirm('¿Seguro que querés eliminar este producto?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>