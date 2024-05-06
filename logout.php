<!-- logout.php -->
<?php
// Incluye el archivo de conexión a la base de datos si es necesario
include 'conexion.php';
session_start();

// Cierra la sesión
session_destroy();

// Redirige al inicio de sesión
header('Location: login.php');
exit();
?>

