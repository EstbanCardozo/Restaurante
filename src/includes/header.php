<?php
if (empty($_SESSION['active'])) {
    header('Location: ../');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de restaurante</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark bg-secondary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark bg-dark">
            <!-- Brand Logo -->
            <a href="dashboard.php" class="brand-link text-center text-light bg-secondary p-3">
                <img src="../assets/img/logo.png" alt="RestBAR Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 40px;">
                <span class="brand-text font-weight-light">EL FOGÓN</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                    <div class="image">
                    <i class='bx bx-user-circle'></i>
                    </div>
                    <div class="info ms-2">
                        <a href="#" class="d-block text-light"><?php echo $_SESSION['nombre']; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link text-white bg-primary">
                            <i class='bx bxs-dashboard'></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white bg-secondary">
                                <i class='bx bx-cart-add'></i>
                                <p>Ventas <i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3) {
                                    echo '<li class="nav-item">
                                        <a href="index.php" class="nav-link text-dark bg-light">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Nueva venta</p>
                                        </a>
                                    </li>';
                                } if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                                    echo '<li class="nav-item">
                                        <a href="lista_ventas.php" class="nav-link text-dark bg-light">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Historial ventas</p>
                                        </a>
                                    </li>';
                                } ?>
                            </ul>
                        </li>

                        <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                            echo '<li class="nav-item">
                                <a href="platos.php" class="nav-link text-white bg-success">
                                    <i class="bx bx-bowl-hot"></i>
                                    <p>Platos</p>
                                </a>
                            </li>';
                        } if ($_SESSION['rol'] == 1) {
                            echo '<li class="nav-item">
                                <a href="salas.php" class="nav-link text-white bg-warning">
                                    <i class="bx bx-home"></i>
                                    <p>Salas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link text-white bg-danger">
                                    <i class="bx bx-cog" ></i>
                                    <p>Ajustes <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="usuarios.php" class="nav-link text-dark bg-light">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Usuarios</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="config.php" class="nav-link text-dark bg-light">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Configuración</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>';
                        } ?>
                        <li class="nav-item">
                            <a href="salir.php" class="nav-link text-white bg-danger">
                            <i class='bx bx-log-out-circle' ></i>
                                <p>Salir</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid py-2">
                <!-- Aquí va el contenido de la página -->
