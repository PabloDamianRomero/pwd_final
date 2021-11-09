<!DOCTYPE html>
<html lang="es">
<head>
<?php
if ($estructuraAMostrar == "desdeVista") {
    include_once("../configuracion.php");?>
    <link rel='stylesheet' href='css/bootstrap/bootstrap.css'>
    <link rel='stylesheet' href='css/bootstrap/bootstrap.min.css'>
    <?php
}

if ($estructuraAMostrar == "desdeAccion") {
    include_once("../../configuracion.php");?>
    <link rel='stylesheet' href='../css/bootstrap/bootstrap.css'>
    <link rel='stylesheet' href='../css/bootstrap/bootstrap.min.css'>
    <?php
}
?>

<title><?php echo $titulo; ?></title>
</head>
<body>
  <?php
  if ($seguro) {
    $sesion = new Session();
    if (!$sesion->activa()) {
        header("Location:login.php");
        exit();
    }
    $roles = $sesion->getRol();
    $rolDesc = "";
    if(count($roles) > 0){
      $rolDesc = $roles[0]->getObjRol()->getRodescripcion();
    }else{
      header("Location:accion/cerrarSesion.php");
      exit();
    }
  }?>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Inicio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
      <?php
      if ($estructuraAMostrar=="desdeVista"){?>
          <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="indexFb.php">Enlace_vista_1</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="loginGmail.php">Enlace_vista_2</a>
              </li>
              <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="listaUs.php">Enlace_vista_3</a>
            </li>
              <?php
      }

      if ($estructuraAMostrar=="desdeAccion"){?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../indexFb.php">Enlace_accion_1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../loginGmail.php">Enlace_accion_2</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../listaUs.php">Enlace_accion_3</a>
          </li>
            <?php
      }?>
      
        </ul>
      </div>
    </div>
  </nav>
<main class="container mh-100" style="min-height: 100vh;">
