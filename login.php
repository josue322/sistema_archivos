<?php
include 'conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Utilizar sentencia preparada
    $query = "SELECT * FROM usuarios WHERE username = ? AND password = ?";

    // Preparar la consulta
    $stmt = mysqli_prepare($conexion, $query);

    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, 'ss', $username, $password);

    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);

    // Obtener el resultado
    $result = mysqli_stmt_get_result($stmt);

    // Cerrar la sentencia preparada
    mysqli_stmt_close($stmt);

    if (!$result) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    if (mysqli_num_rows($result) > 0) {
        // Credenciales válidas, iniciar sesión
        $_SESSION['username'] = $username;
        header('Location: inicio.php');
        exit();
    } else {
        // Credenciales inválidas, mostrar mensaje de error
        echo '<div class="container mt-3 alert alert-danger">Credenciales inválidas</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar sesion</title>
    <link rel="stylesheet" href="template/vendors/feather/feather.css">
    <link rel="stylesheet" href="template/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="template/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="template/css/vertical-layout-light/style.css">
    <link rel="icon" href="template/images/icono.png"/>
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo text-center">
                            <img src="template/images/Captura%20de%20pantalla%202023-12-07%20205614.png" alt="logo">
                        </div>
                        <form action="login.php" method="POST" class="pt-3">
                            <div class="form-group">
                                <input type="text" id="username" name="username" required
                                       class="form-control form-control-lg"
                                       placeholder="Ingrese su usuario">
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" name="password"
                                       class="form-control form-control-lg" required
                                       placeholder="Ingrese su contraseña">
                            </div>
                            <div class="mt-3">
                                <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                    INICIAR SESIÓN
                                </button>
                            </div>
                            <div class="my-2 d-flex justify-content-beween align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input">
                                        Mantener sesion iniciada
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="template/vendors/js/vendor.bundle.base.js"></script>
<script src="template/js/off-canvas.js"></script>
<script src="template/js/hoverable-collapse.js"></script>
<script src="template/js/template.js"></script>
<script src="template/js/settings.js"></script>
<script src="template./js/todolist.js"></script>
</body>
</html>
