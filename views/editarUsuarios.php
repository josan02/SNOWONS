<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../models/usuarios.php';
include_once __DIR__ . '/../includes/header.php';

$usuarioModel = new Usuario($pdo);
$id = $_GET['id'] ?? null;
$usuario = $usuarioModel->obtenerPorId($id);

if (!$usuario) {
  echo "<p>Usuario no encontrado.</p>";
  include_once __DIR__ . '/../includes/footer.php';
  exit;
}
?>

<div class="zona-formulario">
  <div class="formulario">
    <h2>Editar Usuario</h2>
    <form action="../controllers/crudController.php?action=actualizar" method="POST">
      <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
      <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
      <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
      <button type="submit" class="btn-principal">Guardar cambios</button>
    </form>
  </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
