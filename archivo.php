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
    <title>Subir archivo</title>
    <link rel="stylesheet" href="template/vendors/feather/feather.css">
    <link rel="stylesheet" href="template/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="template/vendors/css/vendor.bundle.base.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="template/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="template/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="template/js/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-iDzLw4RbdMTt5kjiS35a6eGCt8Twnx+df8lFfWr4XZvR81AEx0TT3tgq/uIETDcGW8vY7ZgOA3v+DLXpMyK7FQ=="
        crossorigin="anonymous" />
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
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: "GET",
                    url: "buscar_archivos.php",
                    data: formData,
                    success: function (response) {
                        $("#searchResults").html(response);
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
                                placeholder="📄Buscar categorías..." aria-label="Search"
                                aria-describedby="search-addon">
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
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Subir archivo</h3>
                                    <h6 class="font-weight-normal mb-0">En este apartado podras subir tus archivos a
                                        alojar</h6>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex">
                                        <span id="currentDate" class="badge badge-outline-primary badge-lg"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Ingresa el archivo 📄</h4>
                                <form action="subir_archivo.php" method="post" enctype="multipart/form-data"
                                    class="forms-sample">
                                    <div class="form-group">
                                        <input style="color: blue;" type="file" name="archivo" id="archivo" required
                                            class="form-control" id="archivo" placeholder="Nombre del archivo"
                                            accept=".pdf, .doc, .docx, .txt, .jpg, .jpeg, .png, .gif, .zip, .rar, .xls, .xlsx, .ppt, .pptx">
                                        <label class="input-group-text" for="archivo"><i
                                                class="fas fa-file"></i></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="categoria">Categoría</label>
                                        <select name="categoria" id="categoria" class="form-control">
                                            <option value="" selected disabled style="color: black;">Seleccionar
                                                categoría
                                            </option>
                                            <?php
                                            // Consulta para obtener las categorías de la base de datos
                                            $query = "SELECT id, nombre FROM categorias";
                                            $result = $conexion->query($query);


                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value=\"{$row['id']}\">{$row['nombre']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Subir archivo</button>
                                </form>
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
            window.location.href = "buscar_archivos.php";
        });
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