<?php include('../includes/header.php'); ?>

<?php if (isset($_GET['error']) && $_GET['error'] === 'credenciales')://esto es para que a la hora de poner un usuario equivocado salga el popup ?>
  <script>
    alert("Credenciales incorrectas. Por favor, intenta de nuevo.");
  </script>
<?php endif; ?>
<main class="zona-formulario">
  <div class="formulario">
    <h2>Iniciar sesión</h2>
    <form action="../controllers/UserController.php?action=login" method="POST">
      <input type="email" name="email" placeholder="Correo electrónico" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <button type="submit" class="btn-principal">Iniciar sesión</button>
    </form>
  </div>
</main>

<?php include('../includes/footer.php'); ?>
