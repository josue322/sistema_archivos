<?php
$nombre_de_usuario = "root";
$contraseña = "";
$nombre_de_base_de_datos = "sistema_archivos";
$nombre_del_servidor = "localhost";

// Crear una conexión
$conexion = new mysqli($nombre_del_servidor, $nombre_de_usuario, $contraseña, $nombre_de_base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

?>
