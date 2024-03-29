<?php

session_start();

setcookie("user_logged", "user_logged", time() + (60*60*24*10));

// ------------- Cookie para remember (checkbox) -------------

if(isset($_COOKIE['user_logged'])) {

  $usuarios = file_get_contents('user_data.json');
  $array_data = json_decode($usuarios, true);

  foreach($usuarios['usuarios'] as $usuario) {
    if($usuario['email']==$_COOKIE['user_logged']){
      $_SESSION['usuario'] = $usuario;
    }

    header('location: create_list.php');
  }
}

// ------------- Verificar datos de usuario -------------

if($_POST){
  require_once('controladores/funciones.php');

  // Que los campos no esten vacios

  $error = validar_campos_vacios_login($_POST);

  // Si no hay error

  if (!$error) {

    // Verificar que exista el usuarios

    $usuario = verificarUsuario($_POST);

    if (!$usuario) {
      $noExiste = 'El usuario no existe o la contraseña es incorrecta';
    }

    // Si existe en $_SESSION, redirigir

    if ($usuario) {
      $_SESSION['user'] = $usuario;
      header('location: create_list.php');
    }
  }
}

?>

<!DOCTYPE html>
<html>

<head>

  <!-- Configuración -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Login</title>

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

  <!-- _____________________ Login _____________________ -->

  <section class="container container-index">
    <div class="row d-flex justify-content-center">

      <div class="col-12 col-md-8 col-lg-5">
        <div class="card card-shadow d-flex align-items-center">

          <div class="row">
            <div class="col-12">

              <div class="icon-happy-container mt-3"></div>

              <p class="title-login">¡Bienvenid@! <br> Nos encanta tenerte de vuelta.</p>

              <div class="mb-2" style="color: #e03232; background-color: color: #f8d7da;">
                <?= $noExiste ?? '' ?>
              </div>

              <form class="" action="login.php" method="post">
                <div class="row">

                  <div class="col-12 d-flex justify-content-center">
                    <input class="input-login" type="email" name="email" value="<?= $_POST['email'] ?? '' ?> " placeholder="Email">
                  </div>
                  <div class="col-12 mb-2" style="color: #e03232; background-color: color: #f8d7da;">
                    <?=$error['email'] ?? '' ?>
                  </div>

                  <div class="col-12 d-flex justify-content-center">
                    <input class="input-login" type="password" name="password" value="<?= $_POST['password'] ?? '' ?>" placeholder="Contraseña">
                  </div>
                  <div class="col-12 mb-2" style="color: #e03232; background-color: color: #f8d7da;">
                    <?=$error['password'] ?? '' ?>
                  </div>

                  <div class="col-12 remember">
                    <input class="" type="checkbox" name="remember" id="remember3" value="remember">
                    <label for="remember3">Recordar usuario</label>
                  </div>

                  <div class="col-12 d-flex justify-content-center">
                    <button class="btn-ingresar" type="submit" name="button">Ingresar</button>
                  </div>

                </div>
              </form>

              <p class="redirect">¿Todavía no tenés una cuenta? <a class="redirect-link" href="register.php">Registrate</a></p>

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
