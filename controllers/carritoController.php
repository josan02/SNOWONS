<?php 
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../models/Product.php';

// // Instancio el modelo para usar sus metodos
$productModel = new Product($pdo);

// Si no existe todavía el carrito en la sesion, lo creamos como un array vacio
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
// Si se han enviado datos 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Guardamos la accion que se realiza (borrar o añadir) y el ID del producto que se ha cogido
    $action = $_POST['action'] ?? '';
    $productId = $_POST['product_id'] ?? null;
    // Si la acción es añadir y hemos recibido un ID 
    if ($action === 'add' && $productId) {
        // Buscamos el producto en la base de datos por su ID
        $producto = $productModel->getProductoById($productId);
        if ($producto) {
            // Si ya esta en el carrito, simplemente se aumenta la cantidad
            if (isset($_SESSION['carrito'][$productId])) {
                $_SESSION['carrito'][$productId]['cantidad'] += 1;
            } else {
                // Si no esta , lo añadimos con cantidad 1
                $_SESSION['carrito'][$productId] = [
                    'id' => $producto['id'],
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio'],
                    'cantidad' => 1
                ];
            }
        }
    }

    // Si la accion es eliminar y hemos recibido un ID
    if ($action === 'remove' && $productId) {
        // Si ese producto está en el carrito, lo eliminamos
        if (isset($_SESSION['carrito'][$productId])) {
            unset($_SESSION['carrito'][$productId]);
        }
    }
}

// Una vez hecha la accion, mandamos al usuario a la vista del carrito
header('Location: ../views/carrito.php');
exit;
?>
