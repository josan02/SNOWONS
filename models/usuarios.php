<?php
// Creamos la clase Usuario
class Usuario {
  // Guardamos la conexion a la base de datos en esta variable privada
  private $db;
  // Cuando se crea un objeto Usuario, se le pasa la conexion $pdo
  public function __construct($pdo) {
    $this->db = $pdo;
  }
  // Esta funcion devuelve todos los usuarios con su id, nombre y email
  public function getAll() {
    $stmt = $this->db->query("SELECT id, nombre, email FROM usuarios");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Esta funcion inserta un nuevo usuario en la base de datos
  public function crear($nombre, $email, $password) {
    $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    return $stmt->execute([$nombre, $email, $password]);
  }

  // Esta funcion elimina un usuario por su ID
  public function eliminar($id) {
    $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
    return $stmt->execute([$id]);
  }

  // Esta funcion actualiza el nombre y email de un usuario por su ID
  public function actualizar($id, $nombre, $email) {
    $stmt = $this->db->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
    return $stmt->execute([$nombre, $email, $id]);
  }

  // Esta funcion devuelve los datos de un usuario por su ID
  public function obtenerPorId($id) {
    $stmt = $this->db->prepare("SELECT id, nombre, email FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
