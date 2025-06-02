<?php
require_once __DIR__ . '/../includes/db.php';       
require_once __DIR__ . '/../models/Product.php';    
class ProductController {
    private $productModel;

    // Cuando se crea el controlador, se le pasa la conexion PDO
    public function __construct($pdo) {
        // Creo el modelo de productos con la conexion
        $this->productModel = new Product($pdo); 
    }

    public function showProducts() {
        // Saca todos los productos del modelo
        $products = $this->productModel->getAllProducts();

        // Incluye la vista y le pasa los productos 
        include __DIR__ . '/../views/products.php';
    }
}

// Instancio el controlador y llamo a la funcion para mostrar productos
$controller = new ProductController($pdo);
$controller->showProducts();

?>