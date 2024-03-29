<?php

require_once('controladores/funciones.php');

setcookie("user_logged", "user_logged", time() + (60*60*24*10));



if($_POST){

  // Validar datos de usuario
  $errors = validar_campos_vacios_registro($_POST);
  // Validar password
  $error_clave = validar_password($_POST);

  // Validar que no haya errores
  if (!$errors && !$error_clave) {

    // Almacenar datos de usuario
    guardarUsuario($_POST);
    $usuario = verificarUsuario($_POST);
    session_start();
    $_SESSION['user'] = $usuario;

    // Redireccionar
    header('location: create_list.php');
  }

}

?>

<!DOCTYPE html>
<html>

<head>

    <!-- Configuración -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- styles CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login_register_contact.css">

    <!-- icons -->
    <link rel="stylesheet" href="assets/icons/icons.css">

    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&display=swap" rel="stylesheet">

    <!-- favicon -->
    <link rel="shortcut icon" href="iso-superbuscado.ico" />

</head>

<body class="bg-grey">

  <!-- _____________________ Register _____________________ -->

  <section class="container pt-5">
    <div class="row d-flex justify-content-center">

      <div class="col-12 col-md-8 col-lg-5">
        <div class="card card-shadow d-flex align-items-center">

          <div class="row">
            <div class="col-12">

              <div class="icon-piggy-bank mt-3"></div>

              <p class="title-login">¡Este es tu primer paso <br> para comenzar a ahorrar!</p>

              <form class="" action="register.php" method="post">


                <div class="row">

                  <div class="col-12 mb-0">
                    <input class="input-login mb-2" type="text" name="name" value="<?= $_POST['name'] ?? '' ?>" placeholder="Nombre">
                  </div>
                  <div class="col-12 mb-2" style="color: #e03232; background-color: color: #f8d7da;">
                    <?=$errors['name'] ?? '' ?>
                  </div>

                  <div class="col-12 mb-0">
                    <input class="input-login mb-2" type="text" name="lastname" value="<?= $_POST['lastname'] ?? '' ?>" placeholder="Apellido">
                  </div>
                  <div class="col-12 mb-2" style="color: #e03232; background-color: color: #f8d7da;">
                    <?=$errors['lastname'] ?? '' ?>
                  </div>

                  <div class="col-12 mb-0">
                    <input class="input-login mb-2" type="email" name="email" value="<?= $_POST['email'] ?? '' ?>" placeholder="Email">
                  </div>
                  <div class="col-12 mb-2" style="color: #e03232; background-color: color: #f8d7da;">
                    <?=$errors['email'] ?? '' ?>
                  </div>

                  <div class="col-12 mb-0">
                    <input class="input-login mb-2" type="password" name="password" value="<?= $_POST['password'] ?? '' ?>" placeholder="Contraseña">
                  </div>
                  <div class="col-12 mb-2" style="color: #e03232; background-color: color: #f8d7da;">
                    <?=$error_clave['password'] ?? '' ?>
                  </div>


                  <div class="col-12 d-flex justify-content-center">
                    <button class="btn-ingresar" type="submit" name="button">Registrate</button>
                  </div>

                </div>


              </form>

              <p class="terminos-y-condiciones">Al hacer clic en "Registrate", acepta nuestros <a class="redirect-link" href="#">términos de servicio y política de privacidad.</a>  Ocasionalmente le enviaremos correos electrónicos relacionados con la cuenta.</p>

              <p class="redirect">¿Ya tenes una cuenta? <a class="redirect-link" href="login.php">Iniciar sesión</a></p>

            </div>

          </div>

        </div>
      </div>

    </div>
  </section>



  <!-- jQuery CDN - Slim version (=without AJAX) -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  <!-- Popper.JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

  <!-- jQuery Custom Scroller CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

</body>

</html>
