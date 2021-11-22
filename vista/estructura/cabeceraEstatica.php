<!DOCTYPE html>
<html lang="es">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<head>
<?php
if ($estructuraAMostrar == "desdeVista") {
    include_once("../configuracion.php");?>
    <link rel='stylesheet' href='css/bootstrap/bootstrap.css'>
    <link rel='stylesheet' href='css/bootstrap/bootstrap.min.css'>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/gral.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
  $sesion = new Session();
  if ($sesion->activa()) {
      $idRol = $sesion->getRolActivo()->getIdrol();
      header("Location:paginaSegura.php?idrol=".$idRol."");
      exit();
  }
  ?>
    <nav class="navbar navbar-expand-lg menu-pagina">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
          </svg>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <?php
        if ($estructuraAMostrar=="desdeVista"){?>
          <!-- ICONO USUARIO -->
          <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li><button class="dropdown-item text-center" type="button"><a href="login.php">Iniciar Sesión</a></button></li>
              <li><button class="dropdown-item text-center" type="button"><a href="registro.php">Registrarse</a></button></li>              
            </ul>
          </div>
        <?php
        }

        if ($estructuraAMostrar=="desdeAccion"){?>
            <!-- ENLACE ABRIR SESION -->
            <!-- <div>
                <a class="navbar-brand" href="../login.php">
                Iniciar Sesión
                </a>
            </div> -->
            <?php
        }?>

    </div> <!-- cierre container-fluid -->
  </nav>



  
<main class="container mh-100" style="min-height: 100vh;">
