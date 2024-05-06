<?php

if (isset($_GET['query'])) {
    $query = htmlspecialchars($_GET['query']);

    $categorias = array(
        "no existe",
        "recursos humanos",
        "secretaria general",
        "tesoreria",
        "infraestructura",
        "gerencia de desarrollo social y humano",
        "sub gerencia de servicios municipales",
        "gerencia de instituto vial huanta",
        "archivo central"
    );

    $resultado = array_filter($categorias, function ($categoria) use ($query) {
        return stripos($categoria, $query) !== false;
    });

    if (!empty($resultado)) {
        $categoria = reset($resultado);
        echo "<p>$categoria</strong><a href='ubicacion_archivo.php?categoria=" . urlencode($categoria) . "'>. Ver categoria</a></p>";
    } else {
        echo "<p>La categoría <strong>$query</strong> no existe.</p>";
    }
}
?>