<?php
require_once(__DIR__ . '/../includes/db.php');
require_once(__DIR__ . '/../models/product.php');
include_once(__DIR__ . '/../includes/header.php');
include_once(__DIR__ . '/../includes/sidebarCarrito.php'); 


$productModel = new Product($pdo);
$id = $_GET['id'] ?? null;


$producto = $productModel->getProductoById($id);

if (!$producto) {
    echo '<div class="container mt-5"><div class="alert alert-warning">Producto no disponible.</div></div>';
    include_once(__DIR__ . '/../includes/footer.php');
    exit;
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <img src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($producto['imagen']) ?>" 
                 class="img-fluid rounded shadow" 
                 alt="<?= htmlspecialchars($producto['nombre']) ?>">
        </div>
        <div class="col-md-6">
            <h2><?= htmlspecialchars($producto['nombre']) ?></h2>
            <p class="text-muted"><?= htmlspecialchars($producto['descripcion']) ?></p>
            <h4 class="text-precio-producto"><?= number_format($producto['precio'], 2) ?> €</h4>

            <!-- Formulario adaptado para usar tu JS -->
            <form class="form-carrito mt-3" data-id="<?= $producto['id'] ?>">
                <button type="submit" class="btn-gris btn-sm">🛒 Añadir al carrito</button>
            </form>
        </div>
    </div>
</div>

<!-- Asegúrate de tener cargado tu JS de carrito al final del body -->
<script src="<?= BASE_URL ?>/assets/js/carrito.js"></script>

<?php include_once(__DIR__ . '/../includes/footer.php'); ?>
