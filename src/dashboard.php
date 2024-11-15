<?php
session_start();
include_once "includes/header.php";
include "../conexion.php";
$query1 = mysqli_query($conexion, "SELECT COUNT(id) AS total FROM salas WHERE estado = 1");
$totalSalas = mysqli_fetch_assoc($query1);
$query2 = mysqli_query($conexion, "SELECT COUNT(id) AS total FROM platos WHERE estado = 1");
$totalPlatos = mysqli_fetch_assoc($query2);
$query3 = mysqli_query($conexion, "SELECT COUNT(id) AS total FROM usuarios WHERE estado = 1");
$totalUsuarios = mysqli_fetch_assoc($query3);
$query4 = mysqli_query($conexion, "SELECT COUNT(id) AS total FROM pedidos WHERE estado = 1");
$totalPedidos = mysqli_fetch_assoc($query4);

$query5 = mysqli_query($conexion, "SELECT SUM(total) AS total FROM pedidos");
$totalVentas = mysqli_fetch_assoc($query5);
?>
<div class="card">
    <div class="card-header text-center">
        Dashboard
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $totalPlatos['total']; ?></h3>

                        <h1>Platos</h1>
                    </div>
                    <a href="platos.php" class="small-box-footer">Dar click<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo $totalSalas['total']; ?></h3>

                        <h1>Salas</h1>
                    </div>
                    <a href="salas.php" class="small-box-footer">Dar click<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo $totalUsuarios['total']; ?></h3>

                        <h1>Usuarios</h1>
                    </div>
                    <a href="usuarios.php" class="small-box-footer">Dar click <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php echo $totalPedidos['total']; ?></h3>

                        <h1>Pedidos</h1>
                    </div>
                    <a href="lista_ventas.php" class="small-box-footer">Dar click <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Ventas</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">$<?php echo $totalVentas['total']; ?></span>
                                <span>Total</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->

                        <div class="chart-container" style="position: relative; height: 600px; width: 90%; margin: 0 auto;">
                            <canvas id="sales-chart"></canvas>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>

<script src="../assets/js/dashboard.js"></script>