<?php

include 'conexion.php';
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header('Location: index.php');  // Redirigir al inicio de sesión si no se ha iniciado sesión
    exit();
}

// Verificar si se ha proporcionado un ID de archivo válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
// Conexión a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'sistema_archivos');

    if (!$conexion->connect_error) {
// Consultar la base de datos para obtener la información del archivo
        $id_archivo = $_GET['id'];
        $sql = "SELECT nombre, tipo, ruta FROM archivos WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id_archivo);
        $stmt->execute();
        $stmt->bind_result($nombre_archivo, $tipo_archivo, $ruta_archivo);

        if ($stmt->fetch()) {
//echo "Categorizar el archivo: $nombre_archivo";
            ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <title>Nueva categoria</title>
                <link rel="stylesheet" href="template/vendors/feather/feather.css">
                <link rel="stylesheet" href="template/vendors/ti-icons/css/themify-icons.css">
                <link rel="stylesheet" href="template/vendors/css/vendor.bundle.base.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                <link rel="stylesheet" href="template/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
                <link rel="stylesheet" href="template/vendors/ti-icons/css/themify-icons.css">
                <link rel="stylesheet" type="text/css" href="template/js/select.dataTables.min.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
                      integrity="sha512-iDzLw4RbdMTt5kjiS35a6eGCt8Twnx+df8lFfWr4XZvR81AEx0TT3tgq/uIETDcGW8vY7ZgOA3v+DLXpMyK7FQ=="
                      crossorigin="anonymous"/>
                <link rel="stylesheet" href="template/css/vertical-layout-light/style.css">
                <link rel="icon" href="template/images/icono.png"/>
            </head>
            <body>
            <div class="container-scroller">
                <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                        <a class="navbar-brand brand-logo mr-5" href="inicio.php"><img
                                    src="template/images/Captura%20de%20pantalla%202023-12-07%20205614.png" class="mr-2"
                                    alt="logo"/></a>
                        <a class="navbar-brand brand-logo-mini" href="inicio.php"><img src="template/images/logo2.png"
                                                                                       alt="logo"/></a>
                    </div>
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item nav-profile">
                                <img src="template/images/user-removebg-preview.png" alt="profile"/>
                            </li>
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
                                    <span class="menu-title">Archivos      ⇩</span>
                                </a>
                                <div class="collapse" id="ui-basic">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item"><a class="nav-link" href="archivo.php">Subir archivo</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="listarArchivo.php">Ver lista de
                                                archivos</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                                   aria-controls="form-elements">
                                    <span class="menu-title">Convertidor a PDF    ⇩</span>
                                </a>
                                <div class="collapse" id="form-elements">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item"><a class="nav-link" href="convertidor.php">Convertidor</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false"
                                   aria-controls="charts">
                                    <span class="menu-title">Estadisticas</span>
                                </a>
                                <div class="collapse" id="charts">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item"><a class="nav-link"
                                                                href="template/pages/charts/chartjs.html">ChartJs</a>
                                        </li>
                                    </ul>
                                </div>
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
                                <div class="col-md-12 grid-margin">
                                    <div class="row">
                                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                            <h3 class="font-weight-bold">Nueva categoria</h3>
                                            <h6 class="font-weight-normal mb-0">En este apartado podras renombrar una
                                                categoria
                                            </h6>
                                        </div>
                                        <div class="col-12 col-xl-4">
                                            <div class="justify-content-end d-flex">
                                                <span id="currentDate"
                                                      class="badge badge-outline-primary badge-lg"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="categorize_go.php" method="post" enctype="multipart/form-data"
                                              class="forms-sample">
                                            <div class="form-group">|
                                                <label for="exampleInputEmail3">Categoria</label>
                                                <input type="text" name="categoria" id="categoria" class="form-control"
                                                       placeholder="Ingrese el nuevo nombre de la categoria">
                                                <input type="hidden" name="id" value="<?php echo $id_archivo; ?>">
                                            </div>
                                            <button type=" submit" class="btn btn-primary mr-2">Cambiar</button>
                                            <button class="btn btn-light">Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <footer class="footer">
                            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. Todos los derechos reservados.</span>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
            <script>
                function redirigir(archivo) {
                    window.location.href = archivo;
                }
            </script>
            <script>
                function mostrarFechaActual() {
                    const opcionesFecha = {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        timeZone: 'America/Lima'
                    };
                    const fechaActual = new Date().toLocaleDateString('es-ES', opcionesFecha);

                    document.getElementById('currentDate').textContent = fechaActual;
                }

                mostrarFechaActual();
            </script>
            <script src="template/vendors/js/vendor.bundle.base.js"></script>
            <script src="template/vendors/chart.js/Chart.min.js"></script>
            <script src="template/vendors/datatables.net/jquery.dataTables.js"></script>
            <script src="template/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
            <script src="template/js/dataTables.select.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"
                    integrity="sha512-3SO/Giavz3lRiPajHdu+qoAM68V8vdITPyi1S9m6E+rrZjRdd4k3l+FgUnu9e0dpSmGg3/SIwA6BZk/Dv7tsdw=="
                    crossorigin="anonymous"></script>
            <script src="template/js/off-canvas.js"></script>
            <script src="template/js/hoverable-collapse.js"></script>
            <script src="template/js/template.js"></script>
            <script src="template/js/settings.js"></script>
            <script src="template/js/todolist.js"></script>
            <script src="template/js/dashboard.js"></script>
            <script src="template/js/Chart.roundedBarCharts.js"></script>
            </body>

            </html>
            <?php

            $stmt->close();
        } else {
         
            echo "El archivo no fue encontrado.";
        }
    } else {
        echo "Error en la conexión a la base de datos.";
    }
} else {
    echo "ID de archivo no válido.";
}
?>
