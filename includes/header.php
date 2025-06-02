<?php 
include_once(__DIR__ . '/../config/config.php'); 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$carrito = $_SESSION['carrito'] ?? [];
$total_items = 0;

foreach ($carrito as $item) {
    $total_items += $item['cantidad'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <header>
        <h1><?= APP_NAME ?></h1>
        <nav>
            <a href="<?= BASE_URL ?>/index.php">INICIO</a>
            <a href="<?= BASE_URL ?>/views/products.php">PRODUCTOS</a>
            <a href="<?= BASE_URL ?>/views/carrito.php">CARRITO (<?= $total_items ?>)</a>
            
            <?php if(isset($_SESSION['usuario_nombre'])): ?>
                <span>BIENVENIDO, <?= $_SESSION['usuario_nombre'] ?></span>
                <a href="<?= BASE_URL ?>/controllers/cierreSesion.php">CERRAR SESION</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>/views/login.php">LOGIN</a>
                <a href="<?= BASE_URL ?>/views/registro.php">REGISTRO</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['usuario_nombre']) && $_SESSION['usuario_nombre'] === 'admin'): ?>
                 <a href="<?= BASE_URL ?>/views/usuarios.php" >Opciones</a>
            <?php endif; ?>

        </nav>
    </header>
    <main>
