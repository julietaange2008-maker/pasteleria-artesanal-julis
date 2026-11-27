<?php
// admin/pedido_rapido.php (Formulario POST conectado a pedidos y detalle_pedidos)
require_once '../config/conexion.php';

$stmtUser = $pdo->prepare("SELECT id, nombre FROM usuarios ORDER BY id ASC LIMIT 1");
$stmtUser->execute();
$usuario = $stmtUser->fetch();
$usuarioId = $usuario ? (int) $usuario['id'] : 1;

$stmtEstado = $pdo->prepare("SELECT id FROM estados_pedido ORDER BY id ASC LIMIT 1");
$stmtEstado->execute();
$estado = $stmtEstado->fetch();
$estadoId = $estado ? (int) $estado['id'] : 1;

$stmtProd = $pdo->prepare("SELECT id, nombre, precio FROM productos WHERE disponible = 1 ORDER BY nombre ASC");
$stmtProd->execute();
$productos = $stmtProd->fetchAll();

$errores = [];
$productoId = 0;
$cantidad = 1;
$observaciones = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productoId = (int) ($_POST['producto_id'] ?? 0);
    $cantidad = (int) ($_POST['cantidad'] ?? 0);
    $observaciones = trim($_POST['observaciones'] ?? '');

    if ($productoId <= 0) {
        $errores[] = 'Seleccioná un producto válido.';
    }
    if ($cantidad <= 0) {
        $errores[] = 'La cantidad debe ser al menos 1.';
    }

    $prodSeleccionado = null;
    foreach ($productos as $p) {
        if ((int) $p['id'] === $productoId) {
            $prodSeleccionado = $p;
            break;
        }
    }

    if (!$prodSeleccionado && empty($errores)) {
        $errores[] = 'El producto seleccionado no está disponible.';
    }

    if (empty($errores)) {
        $precioUnitario = (float) $prodSeleccionado['precio'];
        $total = round($precioUnitario * $cantidad, 2);

        try {
            $pdo->beginTransaction();

            $sqlPedido = "INSERT INTO pedidos (usuario_id, estado_id, total, observaciones)
                          VALUES (:usuario_id, :estado_id, :total, :observaciones)";
            $stmtPedido = $pdo->prepare($sqlPedido);
            $stmtPedido->execute([
                ':usuario_id'    => $usuarioId,
                ':estado_id'     => $estadoId,
                ':total'         => $total,
                ':observaciones' => $observaciones !== '' ? $observaciones : null,
            ]);

            $pedidoId = (int) $pdo->lastInsertId();
            $subtotal = $total;

            $sqlDetalle = "INSERT INTO detalle_pedidos (pedido_id, producto_id, cantidad, precio_unitario, subtotal)
                           VALUES (:pedido_id, :producto_id, :cantidad, :precio_unitario, :subtotal)";
            $stmtDetalle = $pdo->prepare($sqlDetalle);
            $stmtDetalle->execute([
                ':pedido_id'       => $pedidoId,
                ':producto_id'     => $productoId,
                ':cantidad'        => $cantidad,
                ':precio_unitario' => $precioUnitario,
                ':subtotal'        => $subtotal,
            ]);

            $pdo->commit();
            header('Location: index.php?status=pedido_ok');
            exit;
        } catch (PDOException $e) {
            $pdo->rollBack();
            error_log('Error al guardar pedido: ' . $e->getMessage());
            $errores[] = 'No se pudo registrar el pedido en la base de datos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedido Rápido (POST) — Pastelería Artesanal</title>
    <link rel="stylesheet" href="../clase5/style.css">
    <link rel="stylesheet" href="crud.css">
</head>
<body>
    <main>
        <h1>Registrar Pedido Rápido (POST)</h1>
        <p><a href="index.php">Volver al listado de productos</a></p>

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

        <form method="POST" action="pedido_rapido.php" class="form-post">
            <div>
                <label for="producto_id">Producto *:</label>
                <select id="producto_id" name="producto_id" required>
                    <option value="">Seleccioná un producto</option>
                    <?php foreach ($productos as $p): ?>
                        <option value="<?= (int) $p['id'] ?>" <?= $productoId === (int) $p['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($p['nombre'], ENT_QUOTES, 'UTF-8') ?> ($<?= htmlspecialchars(number_format((float) $p['precio'], 2, ',', '.'), ENT_QUOTES, 'UTF-8') ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="cantidad">Cantidad *:</label>
                <input type="number" id="cantidad" name="cantidad" min="1" value="<?= (int) $cantidad ?>" required>
            </div>

            <div>
                <label for="observaciones">Observaciones del pedido:</label>
                <textarea id="observaciones" name="observaciones" rows="3" placeholder="Ej: Sin azúcar agregada, entrega a las 18 hs"><?= htmlspecialchars($observaciones, ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>

            <button type="submit">Confirmar pedido</button>
        </form>
    </main>
</body>
</html>