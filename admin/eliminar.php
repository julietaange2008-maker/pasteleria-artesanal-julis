<?php
// admin/eliminar.php (Delete)
require_once '../config/conexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php');
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id = :id");
    $stmt->execute([':id' => $id]);

    if ($stmt->rowCount() > 0) {
        header('Location: index.php?status=deleted');
    } else {
        header('Location: index.php');
    }
    exit;
} catch (PDOException $e) {
    if ($e->getCode() === '23000') {
        header('Location: index.php?status=fk_error');
        exit;
    }
    error_log('Error al eliminar producto: ' . $e->getMessage());
    header('Location: index.php?status=error');
    exit;
}