<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $conexion = new mysqli('localhost', 'root', '', 'sistema_archivos');

    if (!$conexion->connect_error) {
        // Mover el archivo a la papelera 
        $sql = "UPDATE archivos SET eliminado = 1 WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header('location: listarSubGerenciaServicios.php');
            exit();
        } else {
            echo "Error al mover el archivo a la papelera: " . $stmt->error;
        }

        $stmt->close();
        $conexion->close();
    } else {
        echo "Error en la conexión a la base de datos: " . $conexion->connect_error;
    }
} else {
    echo "ID de archivo no proporcionado";
}
?>