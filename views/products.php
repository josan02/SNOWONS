<?php
require_once(__DIR__ . '/../includes/db.php');
require_once(__DIR__ . '/../models/product.php');
include_once(__DIR__ . '/../includes/header.php');

$productModel = new Product($pdo);
$productos = $productModel->getAllProducts();
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Catálogo de productos</h2>
    <div class="row justify-content-center">
        <?php foreach ($productos as $producto): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card border-0 shadow rounded-4 h-100 text-center p-2">
                    <img src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($producto['imagen']) ?>"
                         class="card-img-top rounded-top-4"
                         alt="<?= htmlspecialchars($producto['nombre']) ?>"
                         style="height: 220px; object-fit: cover;">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title mb-1"><?= htmlspecialchars($producto['nombre']) ?></h5>
                        <p class="precio-producto fw-bold"><?= number_format($producto['precio'], 2) ?> €</p>
                        
                        <a href="<?= BASE_URL ?>/views/producto.php?id=<?= $producto['id'] ?>" class="btn-gris btn-sm mt-2">
                            Ver más
                        </a>

                        <form class="form-carrito mt-2" data-id="<?= $producto['id'] ?>">
                            <button type="submit" class="btn-gris btn-sm">🛒 Añadir al carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include_once(__DIR__ . '/../includes/sidebarCarrito.php'); ?>
<?php include_once(__DIR__ . '/../includes/footer.php'); ?>
<script src="<?= BASE_URL ?>/assets/js/carrito.js"></script>
