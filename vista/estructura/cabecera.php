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

<style>
  button.dropdown-item.text-center {
    padding: 4px 0;
  }

   a.enlaces-menu {
    color: #000;
    font-family: monospace;
  }

   a.enlaces-menu:hover {
    color: white;
    text-shadow: 1px 1px 2px #0000009e;
  }

  a.enlaceSinEstilo{
    color: #000;
    text-decoration: none;
    display: block;
  }
  
</style>

<title><?php echo $titulo; ?></title>
</head>
<body>
  <?php
  $datos = data_submitted();
  // print_r($datos);
  if ($seguro) {
    $sesion = new Session();
    if (!$sesion->activa()) {
        header("Location:index.php");
        exit();
    }
    $roles = $sesion->getRol();
    // $rolDesc = "";
    $rolActivo = "";
    if(count($roles) > 0){
      // $rolDesc = $roles[0]->getObjRol()->getRodescripcion();

      if(isset($datos["idrol"])){
        $sesion->setRolActivo($datos["idrol"]);
        $rolActivo = $sesion->getRolActivo();
      }else{ // si se ingresa por primera vez y variable $_SESSION no pose rolActivo
        $sesion->setRolActivo($roles[0]->getObjRol()->getIdrol());
        $rolActivo = $sesion->getRolActivo();
      }
      
    }else{
      header("Location:accion/cerrarSesion.php");
      exit();
    }?>
  
    <nav class="navbar navbar-expand-lg" style="background-color: #93d7e7;">
      <div class="container-fluid"> 
        <a class="navbar-brand enlaces-menu" href="paginaSegura.php?idrol="<?php $rolActivo->getIdrol();?>>
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
          </svg>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <?php
        if ($estructuraAMostrar=="desdeVista"){?>
            <li class="nav-item">
                    <a class="nav-link active enlaces-menu" aria-current="page" href="enlace.php">Enlace_vista_1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active enlaces-menu" aria-current="page" href="enlace.php">Enlace_vista_2</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active enlaces-menu" aria-current="page" href="enlace.php">Enlace_vista_3</a>
              </li>
              </ul>
            </div> <!-- cierre collapse navbar-collapse -->
            <!-- USUARIO Y ROL -->
            <div style="margin: 0 25px; padding: 0 10px; background: #ffffff87;">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                   Usuario: <span style="font-family: monospace; color: #ff5504; font-weight: 700;"><?php echo $sesion->getUsuarioActual(); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rol: <span style="font-family: monospace; color: #0451ff; font-weight: 700;"><?php echo $rolActivo->getRodescripcion(); ?></span>
                </li>
              </ul>
            </div>
            <!-- ICONO ROLES -->
          <div class="btn-group" style="margin-right:10px;">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-diagram-2" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H11a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 5 7h2.5V6A1.5 1.5 0 0 1 6 4.5v-1zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1zM3 11.5A1.5 1.5 0 0 1 4.5 10h1A1.5 1.5 0 0 1 7 11.5v1A1.5 1.5 0 0 1 5.5 14h-1A1.5 1.5 0 0 1 3 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1A1.5 1.5 0 0 1 9 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>
            </svg>
            Roles
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <?php 
                foreach ($roles as $elemRol) {
                  $nombreRol = $elemRol->getObjRol()->getRodescripcion();
                  $idRol = $elemRol->getObjRol()->getIdrol();
                  echo "<li><button class='dropdown-item text-center' type='button'><a href='paginaSegura.php?idrol=".$idRol."' class='enlaceSinEstilo'>".$nombreRol."</a></button></li>";
                }
              ?>           
            </ul>
          </div>
          <!-- ICONO CERRAR SESION -->
          <div class="btn-group">
            <button type="button" class="btn btn-secondary">
              <a href="accion/cerrarSesion.php" style="color:#fff;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
              <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
            </svg>
            </a>
            </button>
          </div>
        <?php
        }

        if ($estructuraAMostrar=="desdeAccion"){?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../enlace.php">Enlace_accion_1</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../enlace.php">Enlace_accion_2</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../enlace.php">Enlace_accion_3</a>
            </li>
            </ul>
            </div><!-- cierre collapse navbar-collapse -->
            <!-- USUARIO Y ROL -->
            <div style="margin: 0 25px; padding: 0 10px; background: #ffffff87;">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                   Usuario: <span style="font-family: monospace; color: #ff5504; font-weight: 700;"><?php echo $sesion->getUsuarioActual(); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rol: <span style="font-family: monospace; color: #0451ff; font-weight: 700;"><?php echo $rolActivo->getRodescripcion(); ?></span>
                </li>
              </ul>
            </div>
            <!-- ENLACE CERRAR SESION -->
            <div>
                <a class="navbar-brand" href="cerrarSesion.php">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                  </svg>
                </a>
            </div>
            <?php
        }?>

    </div> <!-- cierre container-fluid -->
  </nav>

  <?php
  }?>

  
<main class="container mh-100" style="min-height: 100vh;">
