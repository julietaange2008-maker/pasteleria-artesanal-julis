<?php
$pagina_actual = basename($_SERVER['PHP_SELF'] ?? 'index.php');
?>
<nav aria-label="Navegación principal">
    <a href="index.php#inicio" class="<?= $pagina_actual === 'index.php' ? 'active' : '' ?>">Inicio</a>
    <a href="index.php#productos">Productos</a>
    <a href="index.php#tortas">Tortas</a>
    <a href="index.php#alfajores">Alfajores</a>
    <a href="index.php#masas">Masas y Galletitas</a>
    <a href="index.php#contacto">Contacto</a>
    <a href="index.php#faq">FAQ</a>
</nav>