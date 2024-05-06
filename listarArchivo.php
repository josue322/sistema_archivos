<?php
include 'conexion.php';
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header('Location: index.php');  // Redirigir al inicio de sesión si no se ha iniciado sesión
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lista archivos</title>
    <link rel="stylesheet" href="template/vendors/feather/feather.css">
    <link rel="stylesheet" href="template/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="template/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="template/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="template/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="template/js/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="template/css/vertical-layout-light/style.css">
    <link rel="icon" href="template/images/icono.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .input-group {
            width: 250px;
            margin: 10px auto;
        }

        .form-control {
            border-radius: 20px !important;
        }

        .input-group-text {
            background-color: transparent !important;
            border-radius: 20px !important;
        }
    </style>
    <script>
        $(document).ready(function () {
            $("#searchForm").submit(function (event) {
                event.preventDefault(); // Evitar que se envíe el formulario de manera tradicional
                var formData = $(this).serialize(); // Obtener los datos del formulario
                $.ajax({
                    type: "GET",
                    url: "buscar_archivos.php",
                    data: formData,
                    success: function (response) {
                        $("#searchResults").html(response); // Mostrar los resultados en el elemento con id "searchResults"
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="inicio.php"><img
                        src="template/images/Captura%20de%20pantalla%202023-12-07%20205614.png" class="mr-2"
                        alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="inicio.php"><img src="template/images/logo2.png"
                        alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile">
                        <img src="template/images/user-removebg-preview.png" alt="profile" />
                    </li>
                    <form id="searchForm">
                        <div class="input-group rounded">
                            <input type="text" name="query" class="form-control rounded"
                                placeholder="Buscar categorías..." aria-label="Search" aria-describedby="search-addon">
                            <button type="submit" class="input-group-text border-0" id="search-addon">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <div id="searchResults"></div>
                    </form>
                    <li class="nav-item nav-settings">
                        <a class="nav-link text-primary" href="logout.php"
                            style="cursor: pointer; font-weight: bold; color: #007bff;">
                            Cerrar sesión
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="inicio.php">
                            <span class="menu-title">Inicio</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <span class="menu-title">Archivos ⇩</span>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="archivo.php">Subir archivo</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                            aria-controls="form-elements">
                            <span class="menu-title">Categorias ⇩</span>
                        </a>
                        <div class="collapse" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="listaRecursosHumanos.php">Recursos
                                        Humanos</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="listarSecretariaGeneral.php">Secretaria
                                        General</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="listarTesoreria.php">Tesoreria</a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="listarInfraestructura.php">Infraestructura</a></li>
                                <li class="nav-item"><a class="nav-link" href="listarDesarrolloSocial.php">G. de
                                        Desarrollo
                                        Social y Humano</a></li>
                                <li class="nav-item"><a class="nav-link" href="listarSubGerenciaServicios.php">Sub
                                        Gerencia de
                                        Servicios Municipales</a></li>
                                <li class="nav-item"><a class="nav-link" href="listarGerenciaInstitutoVialHuanta.php">G.
                                        de Instituto
                                        Vial Huanta</a></li>
                                <li class="nav-item"><a class="nav-link" href="listarArchivoCentral.php">Archivo
                                        Central</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="convertidor.php" aria-expanded="false" aria-controls="charts">
                            <span class="menu-title">Convertidor PDF</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="papelera.php" aria-expanded="false" aria-controls="charts">
                            <span class="menu-title">Papelera de reciclaje</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="nosotros.php">
                            <span class="menu-title">Acerca de nosotros</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">TABLA DE ARCHIVOS</h4>
                                    <p class="card-description">
                                        Todos los archivos subidos al sistema aparen en este apartado.
                                    </p>
                                    <div class="table-responsive pt-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Nombre</th>
                                                    <th class="text-center">Tipo</th>
                                                    <th class="text-center">Categoría</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Conexión a la base de datos (debes incluir tu lógica de conexión)
                                                $conexion = new mysqli('localhost', 'root', '', 'sistema_archivos');

                                                if (!$conexion->connect_error) {
                                                    // Consultar la base de datos para obtener la lista de archivos
                                                    $sql = "SELECT id, nombre, tipo, categoria FROM archivos WHERE eliminado = 0"; // Agregamos la condición para no mostrar archivos eliminados
                                                    $result = $conexion->query($sql);

                                                    $contador = 1; // Agregamos un contador para la columna #
                                                
                                                    if ($result->num_rows > 0) {
                                                        while ($fila = $result->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>{$contador}</td>";
                                                            echo "<td>{$fila['nombre']}</td>";
                                                            echo "<td>{$fila['tipo']}</td>";
                                                            echo "<td>{$fila['categoria']}</td>";
                                                            echo "<td>
                    <a href='download.php?id={$fila['id']}' class='btn btn-success btn-sm'>
                        <i class='fas fa-download'></i>
                    </a>


                    <a href='delete.php?id={$fila['id']}' class='btn btn-danger btn-sm'>
                        <i class='fas fa-trash'></i>
                    </a>
                </td>";
                                                            echo "</tr>";
                                                            $contador++;
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='5'>No se encontraron archivos.</td></tr>";
                                                    }

                                                    $conexion->close();
                                                } else {
                                                    echo "Error en la conexión a la base de datos.";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div><br><br>
                                    <div class="text-center">
                                        <a class="btn btn-primary btn-sm" href="inicio.php">
                                            Volver al inicio
                                        </a>
                                        <a class="btn btn-primary btn-sm" href="archivo.php">
                                            Volver a subir archivo
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024.
                            Todos los derechos reservados.</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("btnBuscar").addEventListener("click", function () {
            // Redirigir a la página de búsqueda cuando se haga clic en el botón
            window.location.href = "buscar_archivos.php";
        });
    </script>
    <script src="template/vendors/js/vendor.bundle.base.js"></script>
    <script src="template/vendors/chart.js/Chart.min.js"></script>
    <script src="template/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="template/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="template/js/dataTables.select.min.js"></script>
    <script src="template/js/off-canvas.js"></script>
    <script src="template/js/hoverable-collapse.js"></script>
    <script src="template/js/template.js"></script>
    <script src="template/js/settings.js"></script>
    <script src="template/js/todolist.js"></script>
    <script src="template/js/dashboard.js"></script>
    <script src="template/js/Chart.roundedBarCharts.js"></script>
</body>

</html>