<?php
session_start();

if (!empty($_POST)) {
    // Validación de campos
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['pass'])) {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Todos los campos son obligatorios
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    } else {
        // Conectar con la base de datos
        require_once "conexion.php";
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
        $pass = md5(mysqli_real_escape_string($conexion, $_POST['pass'])); // Encriptar la contraseña

        // Verificar si el correo ya está registrado
        $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo'");
        $resultado = mysqli_num_rows($query);
        if ($resultado > 0) {
            $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        El correo ya está registrado
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            // Insertar nuevo usuario
            $query_insert = mysqli_query($conexion, "INSERT INTO usuarios (nombre, correo, pass, rol, estado)   
                                                      VALUES ('$nombre', '$correo', '$pass', 1, 1)");
            if ($query_insert) {
                $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Usuario registrado correctamente
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
            } else {
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Error al registrar el usuario
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
            }
        }
        mysqli_close($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro de Usuario</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    /* Estilos generales */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f4f6f9;
    }

    .login-container {
      margin-top: 100px;
      display: flex;
      width: 800px;
      height: 500px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      border-radius: 8px;
      overflow: hidden;
    }

    /* Estilo de la sección de la imagen */
    .login-image {
      width: 50%;
      background-image: url('https://www.elfogonlatinorestaurant.com/uploads/b/924b60a0-d3b6-11eb-ba20-d53a61ca7cf0/Fogon%20Latino%20HQ.png'); /* Cambia 'ruta_de_la_imagen.jpg' por la URL o ruta de tu imagen */
      background-size: cover;
      background-position: center;
    }

    /* Estilo de la sección del formulario */
    .login-form {
      width: 50%;
      padding: 40px;
      background-color: #ffffff;
    }

    .login-logo {
      font-size: 1.8rem;
      font-weight: bold;
      color: #333;
      text-align: center;
      margin-bottom: 20px;
    }

    .login-box-msg {
      margin-bottom: 20px;
      text-align: center;
      color: #666;
    }

    .input-group {
      display: flex;
      margin-bottom: 15px;
    }

    .input-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .input-group .input-group-text {
      padding: 10px;
      background-color: #e9ecef;
      border: 1px solid #ccc;
      border-left: none;
      border-radius: 0 4px 4px 0;
      color: #555;
    }

    .btn-primary {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }
    .titulo{
      text-decoration: none;
      color: black;
    }
  </style>
</head><body>
  <div class="login-container">
    <!-- Imagen en el lado izquierdo -->
    <div class="login-image"></div>

    <!-- Formulario en el lado derecho -->
    <div class="login-form">
      <div class="login-logo">
        <a href="#" class="titulo"><b>El </b>FOGÓN</a>
      </div>
      <p class="login-box-msg">Registra tu cuenta</p>
      <form action="" method="post" autocomplete="off">
        <?php echo (isset($alert)) ? $alert : ''; ?>  
        <div class="input-group">
          <input type="text" class="form-control" name="nombre" placeholder="Nombre Completo">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
        <div class="input-group">
          <input type="email" class="form-control" name="correo" placeholder="Correo Electrónico">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
        <div class="input-group">
          <input type="password" class="form-control" name="pass" placeholder="Contraseña">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
        <div class="registrar">
              Ya tienes Cuenta?
              <a href="index.php">Inicia Aqui</a>
            </div>
            <br>
        <button type="submit" class="btn btn-secondary btn-block">Registrar</button>
      </form>
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
