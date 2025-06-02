<?php
include_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/models/product.php';
include_once __DIR__ . '/includes/db.php';

$productModel = new Product($pdo);
$nuevosProductos = $productModel->getProductosNuevos(3);
$productosOferta = $productModel->getProductosBaratos(6); // ← usamos productos más baratos
?>

<div class="container mt-5 text-center">
  <h2 class="mb-4">Novedades</h2>
</div>

<div id="carruselProductos" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner w-50 mx-auto">
    <?php foreach ($nuevosProductos as $index => $producto): ?>
      <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
        <div class="d-flex justify-content-center align-items-center flex-column p-3 text-center">
          <img src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($producto['imagen']) ?>"
               class="d-block mx-auto"
               style="width: 180px; height: 180px; object-fit: cover; border-radius: 10px;">
          <h5 class="mt-3 mb-1"><?= htmlspecialchars($producto['nombre']) ?></h5>
          <p class="mb-2"><?= number_format($producto['precio'], 2) ?> €</p>
          <a href="<?= BASE_URL ?>/views/producto.php?id=<?= $producto['id'] ?>" class="btn-gris btn-sm">Ver producto</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carruselProductos" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carruselProductos" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<div class="container mt-5 text-center">
  <h2 class="mb-4">🔥Ofertas especiales</h2>
  <div class="row justify-content-center">
    <?php foreach ($productosOferta as $producto): ?>
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

<?php include_once __DIR__ . '/includes/sidebarCarrito.php'; ?>
<?php include_once __DIR__ . '/includes/footer.php'; ?>
<script src="<?= BASE_URL ?>/assets/js/carrito.js"></script>
