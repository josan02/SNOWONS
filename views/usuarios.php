<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../models/usuarios.php';
include_once __DIR__ . '/../includes/header.php';
include_once __DIR__ . '/../controllers/crudController.php';


// Comprobar si el usuario es el admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_nombre'] !== 'admin') {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

include_once __DIR__ . '/../includes/header.php';

$usuarioModel = new Usuario($pdo);
$usuarios = $usuarioModel->getAll();
?>



<div class="zona-formulario">
  <div class="formulario" style="max-width: 800px;">
    <h2>Usuarios registrados</h2>
    <form action="<?= BASE_URL ?>/controllers/crudController.php?action=crear" method="POST">
      <input type="text" name="nombre" placeholder="Nombre completo" required>
      <input type="email" name="email" placeholder="Correo electrónico" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <button type="submit" class="btn-principal">Añadir</button>
    </form>
    
    <br><hr><br>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($usuarios as $usu): ?>
          <tr>
            <td><?= $usu['id'] ?></td>
            <td><?= htmlspecialchars($usu['nombre']) ?></td>
            <td><?= htmlspecialchars($usu['email']) ?></td>
            <td>
              <form action="<?= BASE_URL ?>/controllers/crudController.php?action=eliminar" method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?= $usu['id'] ?>">
                <button type="submit" class="btn-gris">Eliminar</button>
              </form>
              <a href="<?= BASE_URL ?>/views/editarUsuarios.php?id=<?= $usu['id'] ?>" class="btn-gris">Editar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
