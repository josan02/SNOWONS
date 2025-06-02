<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../models/usuarios.php';

// Creamos una instancia del modelo de Usuario y le pasamo la conexion
$usuarioModel = new Usuario($pdo);
// Recogemos la acción que queremos hacer (crear, eliminar o editar)
$action = $_GET['action'] ?? '';
// Si la accion es "crear", recogemos los datos del formulario
if ($action === 'crear') {
  $nombre = $_POST['nombre'];
  $email = $_POST['email'];
  // Encriptamos la contraseña antes de guardarla 
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  // Llamamos a la funcion del modelo para crear el nuevo usuario
  $usuarioModel->crear($nombre, $email, $password);
  // Volvemos de nuevo a la lista de todos los usuarios
  header('Location: ../views/usuarios.php');
  exit;
}
// Si la accion es eliminar, cogemos el ID y llamamos a la función eliminar()
if ($action === 'eliminar') {
  $id = $_POST['id'];
  $usuarioModel->eliminar($id);
  header('Location: ../views/usuarios.php');
  exit;
}
// Si la acción es actualizar, recogemos los datos y actualizaremos el usuario
if ($action === 'actualizar') {
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $email = $_POST['email'];
  $usuarioModel->actualizar($id, $nombre, $email);
  header('Location: ../views/usuarios.php');
  exit;
}
