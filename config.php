<?php
$envPath = __DIR__ . '/.env';
$config = [
    'APP_NAME'  => 'Pastelería Artesanal',
    'APP_EMAIL' => 'contacto@pasteleria.com',
    'APP_ENV'   => 'local',
];

if (file_exists($envPath)) {
    $lineas = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        $linea = trim($linea);
        if ($linea === '' || str_starts_with($linea, '#') || !str_contains($linea, '=')) {
            continue;
        }
        [$clave, $valor] = explode('=', $linea, 2);
        $clave = trim($clave);
        $valor = trim($valor, " \t\n\r\0\x0B\"'");
        $config[$clave] = $valor;
    }
}