<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

$carrito = $_SESSION['carrito'] ?? [];
$usuarioId = $_SESSION['usuario_id'] ?? null;

if (empty($carrito)) {
    header('Location: carrito.php');
    exit;
}

if (!$usuarioId) {
    include_once __DIR__ . '/../includes/header.php';
    echo '<script>alert("Debes iniciar sesión para finalizar el pedido."); window.location.href = "' . BASE_URL . '/views/login.php";</script>';//esto lo he tenido que hacer con chat gpt porque de la manera que lo estaba intentado hacer me daba error
    exit;
}


$total = 0;
foreach ($carrito as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

// Insertar pedido
$stmt = $pdo->prepare("INSERT INTO pedidos (usuario_id, total) VALUES (:usuario_id, :total)");
$success = $stmt->execute([
    'usuario_id' => $usuarioId,
    'total' => $total
]);

if (!$success) {
    die("   Error al insertar el pedido.");
}

$pedido_id = $pdo->lastInsertId();
if (!$pedido_id) {
    die("Error: no se pudo obtener el ID del pedido.");
}

// Insertar detalles del pedido
$stmt_detalle = $pdo->prepare("INSERT INTO detalle_pedido (pedido_id, producto_id, cantidad, precio_unitario) VALUES (:pedido_id, :producto_id, :cantidad, :precio)");

foreach ($carrito as $item) {
    $stmt_detalle->execute([
        'pedido_id' => $pedido_id,
        'producto_id' => $item['id'],
        'cantidad' => $item['cantidad'],
        'precio' => $item['precio']
    ]);
}

// Vaciar carrito
$_SESSION['carrito'] = [];

include_once __DIR__ . '/../includes/header.php';
?>

<div class="confirmacion-pedido centrado">
    <h2>¡Pedido realizado con éxito!</h2>
    <p>Gracias por tu compra. Tu pedido ha sido guardado correctamente.</p>
    <a href="<?= defined('BASE_URL') ? BASE_URL : '/SNOWONS' ?>/index.php" class="btn-principal">
        Volver a la tienda
    </a>
</div>
<?php include_once __DIR__ . '/../includes/footer.php'; ?>
