 <?php session_start(); 
require_once('../includes/db.php'); 
$action = $_GET['action'] ?? ''; 

if ($action === 'register') {
  // Registro de usuario
  $nombre = $_POST['nombre'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encripta la contrasena(chatgpt)

  try {
    // Inserta el nuevo usuario en la base de datos
    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $email, $password]);
    header('Location: ../views/login.php');
  } catch (PDOException $e) {
    // Si falla la insercion (por ejemplo email duplicado), muestra el error
    echo "Error al registrar usuario: " ;
  }

} elseif ($action === 'login') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  // Busca al usuario por el email
  $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
  $stmt->execute([$email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Si el usuario existe y la contrasena coincide
  if ($user && password_verify($password, $user['password'])) {
    // Guarda los datos en la sesion
    $_SESSION['usuario_id'] = $user['id'];
    $_SESSION['usuario_nombre'] = $user['nombre'];
    header('Location: ../index.php');
    exit();
  } else {
    // Si falla, muestra mensaje
   header('Location: ../views/login.php?error=credenciales');
  exit();
  }

} else {
  header('Location: ../views/login.php');
  exit();
}
?>