<?php
session_start(); // Iniciamos la sesion 
session_unset(); // Limpia las variables de sesion
session_destroy(); // Destruye la sesion completamente

// Mandamos al usuario al inicio
header('Location: ../index.php');
exit();
