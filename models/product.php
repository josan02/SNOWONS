<?php
class Product {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    // Obtener los productos
    public function getAllProducts() {
        $stmt = $this->pdo->prepare("SELECT * FROM productos ORDER BY fecha_creacion DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Obtener un producto por su ID 
    public function getProductoById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM productos WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //Obtener los productos nuevos para el carrusel, se cogen solo tres
    public function getProductosNuevos($limit = 3) {
    $stmt = $this->pdo->prepare("SELECT * FROM productos ORDER BY id DESC LIMIT ?");
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
    }
    //Obtener los productos mas baratos ordenando por precio para los productos que se suponen que estan en oferta
    public function getProductosBaratos($limite = 6) {
    $stmt = $this->pdo->prepare("SELECT * FROM productos ORDER BY precio ASC LIMIT ?");
    $stmt->bindValue(1, (int)$limite, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>
