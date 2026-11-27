<?php
// --- 1. CONFIGURACIÓN INICIAL Y PERSISTENCIA ---
$errores_post = [];
$exito_post = false;
$pedido_confirmado = [
    'nombre'  => '',
    'email'   => '',
    'mensaje' => '',
];

// Conserva los datos ingresados ante un error de validación en POST
$valores = [
    'nombre'  => '',
    'email'   => '',
    'mensaje' => '',
];

// --- 2. PROCESAMIENTO DEL FORMULARIO POST (Pedido de Pastelería) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar_pedido'])) {
    $nombre_raw  = isset($_POST['nombre']) ? trim((string) $_POST['nombre']) : '';
    $email_raw   = isset($_POST['email']) ? trim((string) $_POST['email']) : '';
    $mensaje_raw = isset($_POST['mensaje']) ? trim((string) $_POST['mensaje']) : '';

    $email_sanitizado = filter_var($email_raw, FILTER_SANITIZE_EMAIL);

    // Persistencia en el servidor para repoblar los campos si hay error
    $valores['nombre']  = $nombre_raw;
    $valores['email']   = $email_sanitizado !== false ? $email_sanitizado : $email_raw;
    $valores['mensaje'] = $mensaje_raw;

    // Validaciones en el servidor
    if (empty($nombre_raw)) {
        $errores_post[] = 'El campo Nombre completo es obligatorio.';
    } elseif (mb_strlen($nombre_raw) < 2) {
        $errores_post[] = 'El Nombre completo debe tener al menos 2 caracteres.';
    }

    if (empty($email_raw)) {
        $errores_post[] = 'El campo Correo electrónico es obligatorio.';
    } elseif (
        $email_sanitizado === false ||
        !filter_var($email_sanitizado, FILTER_VALIDATE_EMAIL)
    ) {
        $errores_post[] = 'Ingresá una dirección de correo electrónico válida.';
    }

    if (empty($mensaje_raw)) {
        $errores_post[] = 'El campo Mensaje / Pedido es obligatorio.';
    } elseif (mb_strlen($mensaje_raw) < 5) {
        $errores_post[] = 'Escribí un detalle un poco más completo de tu pedido (mínimo 5 caracteres).';
    }

    // Si todo es válido, confirmamos y limpiamos $valores
    if (empty($errores_post)) {
        $exito_post = true;
        $pedido_confirmado = [
            'nombre'  => $nombre_raw,
            'email'   => $email_sanitizado,
            'mensaje' => $mensaje_raw,
        ];
        $valores = [
            'nombre'  => '',
            'email'   => '',
            'mensaje' => '',
        ];
    }
}

// --- 3. PROCESAMIENTO DEL FORMULARIO GET (Buscador de Categorías) ---
$categorias = [
    'Tortas artesanales',
    'Tartas dulces y frutales',
    'Facturas y medialunas',
    'Alfajores y cookies',
    'Opciones sin TACC',
];

$termino_busqueda = '';
$resultados_busqueda = [];
$busqueda_realizada = false;

if (isset($_GET['categoria'])) {
    $busqueda_realizada = true;
    $termino_busqueda = trim((string) $_GET['categoria']);

    if ($termino_busqueda !== '') {
        foreach ($categorias as $categoria) {
            if (mb_stripos($categoria, $termino_busqueda) !== false) {
                $resultados_busqueda[] = $categoria;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clase 5 — Formularios POST y GET | Pastelería Artesanal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="contenedor">
        <header class="encabezado-principal">
            <h1>Pastelería Artesanal — Clase 5</h1>
            <p>Procesamiento dinámico de formularios por GET y POST con validación, persistencia y protección XSS</p>
        </header>

        <!-- FORMULARIO GET: Buscador de Categorías -->
        <section class="tarjeta">
            <h2>Buscador de Categorías (GET)</h2>
            <form action="" method="GET">
                <div class="campo">
                    <label for="categoria">Buscar categoría:</label>
                    <input
                        type="text"
                        id="categoria"
                        name="categoria"
                        placeholder="Ej.: tortas, tartas, facturas..."
                        value="<?= htmlspecialchars($termino_busqueda, ENT_QUOTES, 'UTF-8') ?>"
                    >
                </div>
                <button type="submit" class="btn-primario">Buscar</button>
            </form>

            <?php if ($busqueda_realizada): ?>
                <div class="resultado-busqueda">
                    <?php if ($termino_busqueda === ''): ?>
                        <p>No ingresaste un término específico. Mostrando todas las categorías disponibles:</p>
                        <ul>
                            <?php foreach ($categorias as $cat): ?>
                                <li><?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Resultados para: <strong><?= htmlspecialchars($termino_busqueda, ENT_QUOTES, 'UTF-8') ?></strong></p>
                        <?php if (!empty($resultados_busqueda)): ?>
                            <ul>
                                <?php foreach ($resultados_busqueda as $resultado): ?>
                                    <li><?= htmlspecialchars($resultado, ENT_QUOTES, 'UTF-8') ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No se encontraron categorías que coincidan con «<?= htmlspecialchars($termino_busqueda, ENT_QUOTES, 'UTF-8') ?>».</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>

        <!-- FORMULARIO POST: Pedido de Pastelería -->
        <section class="tarjeta">
            <h2>Formulario de Pedido de Pastelería (POST)</h2>

            <?php if (!empty($errores_post)): ?>
                <div class="alerta-error" role="alert">
                    <strong>No se pudo enviar el pedido. Revisá lo siguiente:</strong>
                    <ul>
                        <?php foreach ($errores_post as $error): ?>
                            <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($exito_post): ?>
                <div class="alerta-exito" role="status">
                    <strong>¡Pedido recibido correctamente!</strong>
                    <p><strong>Nombre:</strong> <?= htmlspecialchars($pedido_confirmado['nombre'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p><strong>Correo electrónico:</strong> <?= htmlspecialchars($pedido_confirmado['email'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p><strong>Detalle del pedido:</strong> <?= nl2br(htmlspecialchars($pedido_confirmado['mensaje'], ENT_QUOTES, 'UTF-8')) ?></p>
                </div>
            <?php endif; ?>

            <form action="" method="POST" novalidate>
                <div class="campo">
                    <label for="nombre">Nombre completo *</label>
                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        value="<?= htmlspecialchars($valores['nombre'], ENT_QUOTES, 'UTF-8') ?>"
                    >
                </div>

                <div class="campo">
                    <label for="email">Correo electrónico *</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= htmlspecialchars($valores['email'], ENT_QUOTES, 'UTF-8') ?>"
                    >
                </div>

                <div class="campo">
                    <label for="mensaje">Mensaje / Pedido *</label>
                    <textarea id="mensaje" name="mensaje" rows="4"><?= htmlspecialchars($valores['mensaje'], ENT_QUOTES, 'UTF-8') ?></textarea>
                </div>

                <button type="submit" name="enviar_pedido" value="1" class="btn-primario">Enviar pedido</button>
            </form>
        </section>
    </main>
</body>
</html>