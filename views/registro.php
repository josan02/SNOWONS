<?php include('../includes/header.php'); ?>

<main class="zona-formulario">
  <div class="formulario">
    <h2>Crear una nueva cuenta</h2>
    <form action="../controllers/UserController.php?action=register" method="POST">
      <input type="text" name="nombre" placeholder="Nombre completo" required>
      <input type="email" name="email" placeholder="Correo electrónico" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <button type="submit" class="btn-principal">Registrar</button>
    </form>
  </div>
</main>

<?php include('../includes/footer.php'); ?>

