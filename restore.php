<?php
$conexion = new mysqli('localhost', 'root', '', 'sistema_archivos');

if (!$conexion->connect_error) {
    // Obtén el ID del archivo a restaurar desde la URL
    $archivo_id = $_GET['id'];

    $sql = "UPDATE archivos SET eliminado = 0 WHERE id = $archivo_id";
    $result = $conexion->query($sql);

    if ($result) {
        // Redirige a la página de la papelera después de restaurar
        header('Location: papelera.php');
        exit;
    } else {
        echo "Error al restaurar el archivo: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Error en la conexión a la base de datos.";
}
?>

