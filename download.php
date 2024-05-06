<?php
// Verificar si se ha proporcionado un ID de archivo válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
    // Conexión a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'sistema_archivos');

    if (!$conexion->connect_error) {
        // Consultar la base de datos para obtener la información del archivo
        $id_archivo = $_GET['id'];
        $sql = "SELECT nombre, tipo, ruta FROM archivos WHERE id = ?";
        $stmt = $conexion->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id_archivo);
            $stmt->execute();
            $stmt->bind_result($nombre_archivo, $tipo_archivo, $ruta_archivo);

            if ($stmt->fetch()) {
                // Agregar seguridad: verifica que $ruta_archivo sea una ruta segura en el servidor
                if (file_exists($ruta_archivo)) {
                    // Prevenir el almacenamiento en caché del archivo descargado
                    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
                    header('Cache-Control: post-check=0, pre-check=0', false);
                    header('Pragma: no-cache');

                    header("Content-Type: $tipo_archivo");
                    header("Content-Disposition: attachment; filename=\"$nombre_archivo\"");
                    header('Content-Length: ' . filesize($ruta_archivo));

                    readfile($ruta_archivo);
                    exit();
                } else {
                    echo "El archivo no fue encontrado en el servidor.";
                }
            } else {
                echo "El archivo no fue encontrado en la base de datos.";
            }

            $stmt->close();
        } else {
            echo "Error en la consulta SQL: " . $conexion->error;
        }

        $conexion->close();
    } else {
        echo "Error en la conexión a la base de datos.";
    }
} else {
    echo "ID de archivo no válido.";
}
?>
