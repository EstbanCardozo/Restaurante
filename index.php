<?php
session_start();
if (!empty($_SESSION['active'])) {
    header('location: src/');
} else {
    if (!empty($_POST)) {
        $alert = '';
        if (empty($_POST['correo']) || empty($_POST['pass'])) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Ingrese correo y contraseña
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            require_once "conexion.php";
            $user = mysqli_real_escape_string($conexion, $_POST['correo']);
            $pass = md5(mysqli_real_escape_string($conexion, $_POST['pass']));
            $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$user' AND pass = '$pass'");
            mysqli_close($conexion);
            $resultado = mysqli_num_rows($query);
            if ($resultado > 0) {
                $dato = mysqli_fetch_array($query);
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $dato['id'];
                $_SESSION['nombre'] = $dato['nombre'];
                $_SESSION['rol'] = $dato['rol'];
                header('Location: src/dashboard.php');
            } else {
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Contraseña incorrecta
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                session_destroy();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">  
  <!-- Font Awesome -->
  <style>
  .login-container {
    display: flex;
    width: 100%;
    height: 100vh;
  }
  .login-image {
    flex: 1;
    background-image: url('https://png.pngtree.com/png-vector/20240322/ourlarge/pngtree-kitchen-tools-seamless-pattern-doodle-kitchen-stuff-png-image_12179217.png'); /* Reemplaza con tu URL de imagen */
    background-size: cover;
    background-position: center;
  }
  .login-form {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px;
  }
  .login-box {
    width: 100%;
    max-width: 400px;
  }
  .login-logo a {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
  }
  .titulo{
    text-decoration: none;
  }
</style>
</head>
<body class="hold-transition login-page">

<div class="login-container">
  <div class="login-image"></div>
  
  <div class="login-form">
    <div class="login-box">
      <div class="login-logo">
        <a href="#" class="titulo" ><b>EL </b>FOGÓN</a>
        <br><br>
      </div>
      
      <div class="card">  
        <div class="card-body login-card-body">
          <p class="login-box-msg">Por Favor Inicia Sesión</p>
          <form action="" method="post" autocomplete="off">
            <?php echo (isset($alert)) ? $alert : '' ; ?>
            <div class="input-group mb-3">
              <input type="email" class="form-control" name="correo" placeholder="Correo">

            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="pass" placeholder="Contraseña">
            </div>
            <div class="registrar">
              No tienes cuenta? 
              <a href="registro.php">registrate aqui</a>
            </div>
            <br>
            <div class="row">
              <div class="col-4">
                <button type="submit" class="btn btn-secondary btn-block">Ingresar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
