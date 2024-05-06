<?php
include 'conexion.php';
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header('Location: index.php');  // Redirigir al inicio de sesión si no se ha iniciado sesión
    exit();
}

// Verifica si se ha enviado un archivo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo"])) {
    $categoria_id = $_POST['categoria'];

    // Verifica si se ha seleccionado una categoría
    if (empty($categoria_id)) {
        echo "Por favor, selecciona una categoría antes de subir el archivo.";
        exit();
    }

    // Obtiene el nombre de la categoría según su ID
    $query = "SELECT nombre FROM categorias WHERE id = $categoria_id";
    $result = $conexion->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $categoria_nombre = $row['nombre'];
    } else {
        echo "No se pudo obtener el nombre de la categoría.";
        exit();
    }

    $nombre_archivo = $_FILES["archivo"]["name"];
    $tipo_archivo = $_FILES["archivo"]["type"];
    $tamanio_archivo = $_FILES["archivo"]["size"];
    $temp_archivo = $_FILES["archivo"]["tmp_name"];
    $error = $_FILES["archivo"]["error"];

    // Directorio donde se guardarán los archivos de la categoría actual
    $directorio_destino = "uploads/" . strtolower(str_replace(' ', '_', $categoria_nombre)) . "/";

    // Verifica si el directorio de destino existe, si no, intenta crearlo
    if (!file_exists($directorio_destino) && !is_dir($directorio_destino)) {
        if (!mkdir($directorio_destino, 0777, true)) {
            echo "Error al crear el directorio de destino.";
            exit();
        }
    }

    // Verifica si no hubo errores durante la carga del archivo
    if ($error > 0) {
        echo "Error al subir el archivo.";
        exit();
    }

    // Mueve el archivo al directorio de destino
    if (move_uploaded_file($temp_archivo, $directorio_destino . $nombre_archivo)) {
        // Obtiene la ruta completa del archivo
        $ruta_archivo = $directorio_destino . $nombre_archivo;

        // Inserta el registro del archivo en la base de datos
        $sql = "INSERT INTO archivos (nombre, tipo, ruta, categoria) VALUES ('$nombre_archivo', '$tipo_archivo', '$ruta_archivo', '$categoria_nombre')";
        if ($conexion->query($sql) === TRUE) {

            header("Location: listarArchivo.php?");

            exit();
        } else {
            echo "Error al subir el archivo a la base de datos: " . $conexion->error;
        }
    } else {
        echo "Error al mover el archivo al directorio de destino.";
    }

    $conexion->close();
}
?>