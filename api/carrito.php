<?php
session_start();
// Cogemos el carrito si es que lo hay, y si no, lo dejamos en un array vacio
$carrito = $_SESSION['carrito'] ?? [];
$total = 0;

// Si el carrito esta vacio, mostramos un mensaje y cortamos el script
if (empty($carrito)) {
    echo "<p>El carrito está vacío.</p>";
    exit;
}
// Empezamos la lista para mostrar los productos
echo '<ul>';

// Recorremos todos los productos del carrito para mostrarlos
foreach ($carrito as $item) {
    // Calcula el subtotal 
    $subtotal = $item['precio'] * $item['cantidad'];
    // Lo sumamos al total 
    $total += $subtotal;
    echo "<li>{$item['nombre']} x {$item['cantidad']} - " . number_format($subtotal, 2) . " €</li>";
}
echo '</ul>';
// Mostramos el total del carrito
echo "<p><strong>Total:</strong> " . number_format($total, 2) . " €</p>";

// Ponemos el boton para que redirija al carrito completo
echo '<a href="../views/carrito.php"><button>Ir al carrito</button></a>';
?>
