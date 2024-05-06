<?php
// Verificamos si se ha proporcionado una categoría en la URL
if (isset($_GET['categoria'])) {
    // Obtenemos la categoría de la URL y la sanitizamos
    $categoria = htmlspecialchars($_GET['categoria']);

    // Creamos un array asociativo que mapea las categorías a las ubicaciones de los archivos
    $archivos_por_categoria = array(
        "no existe" => "inicio.php",
        "recursos humanos" => "listaRecursosHumanos.php",
        "abastecimiento" => "listarAbastecimiento.php",
        "secretaria general" => "listarSecretariaGeneral.php",
        "arbitrios municipales" => "listarArbitriosMunicipales.php",
        "tesoreria" => "listarTesoreria.php",
        "imagen institucional" => "listarImagenInstitucional.php",
        "patrimonio" => "listarPatrimonio.php",
        "infraestructura" => "listarInfraestructura.php",
        "gerencia de desarrollo social y humano" => "listarDesarrolloSocial.php",
        "sub gerencia de servicios municipales" => "listarSubGerenciaServicios.php",
        "sub gerencia de residuos solidos" => "listarSubGerenciaResiduosSolidos.php",
        "gerencia de instituto vial huanta" => "listarGerenciaInstitutoVialHuanta.php",
        "archivo central" => "listarArchivoCentral.php",
    );

    // Verificamos si la categoría existe en el array
    if (array_key_exists($categoria, $archivos_por_categoria)) {
        // Obtenemos la ruta del archivo correspondiente a la categoría
        $ruta_archivo = $archivos_por_categoria[$categoria];
        // Redirigimos al usuario a la ubicación del archivo
        header("Location: $ruta_archivo");
        exit;
    } else {
        echo "La categoría '$categoria' no existe.";
    }
} else {
    echo "No se proporcionó ninguna categoría.";
}
?>