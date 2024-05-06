<?php
$conexion = new mysqli('localhost', 'root', '', 'sistema_archivos');

if (!$conexion->connect_error) {
    // Obtén el ID del archivo a eliminar permanentemente desde la URL
    $archivo_id = $_GET['id'];

    // Elimina permanentemente el archivo de la base de datos
    $sql = "DELETE FROM archivos WHERE id = $archivo_id";
    $result = $conexion->query($sql);

    if ($result) {
        // Redirige a la página de la papelera después de eliminar permanentemente
        header('Location: papelera.php');
        exit;
    } else {
        echo "Error al eliminar permanentemente el archivo: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Error en la conexión a la base de datos.";
}
?>
