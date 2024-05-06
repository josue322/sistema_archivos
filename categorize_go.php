<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['categoria']) && is_numeric($_POST['id'])) {
        $id_archivo = $_POST['id'];
        $categoria = $_POST['categoria'];


        $conexion = new mysqli('localhost', 'root', '', 'sistema_archivos');
        if (!$conexion->connect_error) {
            $sql = "UPDATE archivos SET categoria = ? WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("si", $categoria, $id_archivo);

            if ($stmt->execute()) {

                header("Location: listarArchivo.php");
                exit();
            } else {
                echo "Error al categorizar el archivo.";
            }

            $stmt->close();
            $conexion->close();
        } else {
            echo "Error en la conexión a la base de datos.";
        }
    } else {
        echo "Datos no válidos.";
    }
} else {
    echo "Acceso no válido.";
}
?>