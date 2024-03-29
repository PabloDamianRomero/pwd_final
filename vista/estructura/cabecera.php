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

    <!-- Enlaces jQuery-Easyui -->
    <link rel="stylesheet" type="text/css" href="../util/jquery-easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../util/jquery-easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../util/jquery-easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="../util/jquery-easyui/demo/demo.css">
    <script type="text/javascript" src="../util/jquery-easyui/jquery.min.js"></script>
    <script type="text/javascript" src="../util/jquery-easyui/jquery.easyui.min.js"></script>
    <?php
}

if ($estructuraAMostrar == "desdeAccion") {
    include_once("../../configuracion.php");?>
    <link rel='stylesheet' href='../css/bootstrap/bootstrap.css'>
    <link rel='stylesheet' href='../css/bootstrap/bootstrap.min.css'>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../css/gral.css">
    <!-- Enlaces jQuery-Easyui -->
    <link rel="stylesheet" type="text/css" href="../../util/jquery-easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../../util/jquery-easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../../util/jquery-easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="../../util/jquery-easyui/demo/demo.css">
    <script type="text/javascript" src="../../util/jquery-easyui/jquery.min.js"></script>
    <script type="text/javascript" src="../../util/jquery-easyui/jquery.easyui.min.js"></script>
    <?php
}
if ($estructuraAMostrar == "desdeSubAccion") {
  include_once("../../../configuracion.php");?>
  <link rel='stylesheet' href='../../css/bootstrap/bootstrap.css'>
  <link rel='stylesheet' href='../../css/bootstrap/bootstrap.min.css'>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link rel="stylesheet" href="../../css/gral.css">
  <!-- Enlaces jQuery-Easyui -->
  <link rel="stylesheet" type="text/css" href="../../../util/jquery-easyui/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="../../../util/jquery-easyui/themes/icon.css">
  <link rel="stylesheet" type="text/css" href="../../../util/jquery-easyui/themes/color.css">
  <link rel="stylesheet" type="text/css" href="../../../util/jquery-easyui/demo/demo.css">
  <script type="text/javascript" src="../../../util/jquery-easyui/jquery.min.js"></script>
  <script type="text/javascript" src="../../../util/jquery-easyui/jquery.easyui.min.js"></script>
  <?php
}
?>
<style>
  body{
    padding: 0;
  }
</style>

<title><?php echo $titulo; ?></title>
</head>
<body>
  <?php
  $datos = data_submitted();
  if ($seguro) {
    $sesion = new Session();
    if (!$sesion->activa()) {
        header("Location:index.php");
        exit();
    }
    $roles = $sesion->getRol();
    $rolActivo = "";
    if(count($roles) > 0){
      if(!empty($sesion->getRolActivo())){
        if (isset($datos["idrol"])){
          $sesion->setRolActivo($datos["idrol"]);
        }
        $rolActivo = $sesion->getRolActivo();
      }else{ // si se ingresa por primera vez y variable $_SESSION no pose rolActivo
        $sesion->setRolActivo($roles[0]->getObjRol()->getIdrol());
        $rolActivo = $sesion->getRolActivo();
      }
      $abmMenuRol = new AbmMenurol();
      $arrMenu = $abmMenuRol->buscar(['idrol'=>$rolActivo->getIdrol()]);
      if(count($arrMenu) > 0){
        $abmMenu = new abmMenu();
        $arrMenuPadre = $abmMenu->buscar(['idmenu'=>$rolActivo->getIdrol()]);
        if(count($arrMenuPadre) > 0){
          $idMenuPadre = $arrMenuPadre[0]->getIdmenu();
          $arrSubMenu = $abmMenu->buscar(['idpadre'=>$idMenuPadre]);
        }
      }
      
    }else{
      header("Location:accion/cerrarSesion.php");
      exit();
    }?>
  
    <nav class="navbar navbar-expand-lg menu-pagina">
      <div class="container-fluid">
        <?php $enlaceInicio = "paginaSegura.php?idrol=".$rolActivo->getIdrol(); 
          if($estructuraAMostrar == "desdeSubAccion"){
            $enlaceInicio = "../../paginaSegura.php?idrol=".$rolActivo->getIdrol();
          }
        ?> 
        <a class="navbar-brand enlaces-menu" href=<?php echo $enlaceInicio; ?>>
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
          </svg>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
          </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left: 20px;">
        
        <?php
        if ($estructuraAMostrar=="desdeVista"){?>
          <!-- ICONO y Enlaces MENU-ROL -->
          <div class="btn-group" style="margin-right:10px;">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z"/>
              <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z"/>
              <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z"/>
            </svg>
            <?php 
                if(isset($arrMenuPadre)){
                   if($arrMenuPadre[0]->getMedeshabilitado() == "0000-00-00 00:00:00"){ // si menu padre no está deshabilitado
                     echo $arrMenuPadre[0]->getMenombre();
                   }else{
                     echo "Sin opciones";
                     $arrMenu = array();
                   }
                ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <?php 
                foreach ($arrMenu as $menu) {
                  if($menu->getObjMenu()->getMedeshabilitado() == "0000-00-00 00:00:00"){
                    if(($menu->getObjMenu()->getMedescripcion() != "") && ($menu->getObjMenu()->getObjMenu()!=null)){
                      $enlace = $menu->getObjMenu()->getMedescripcion().".php";
                      $idrol=$rolActivo->getIdrol();
                      echo "<li><button class='dropdown-item text-center' type='button'><a href='".$enlace."?idrol=".$rolActivo->getIdrol()."' class='enlaceSinEstiloYPadding'>".$menu->getObjMenu()->getMenombre()."</a></button></li>";
                    }
                    
                  }
                }
              } // cierre if (isset($arrMenuPadre))
              ?>           
            </ul>
          </div>
            </div> <!-- cierre collapse navbar-collapse -->
            <!-- USUARIO Y ROL -->
            <div style="margin: 0 25px; padding: 0 10px; background: #ffffff87;">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                   Usuario: <span style="font-family: monospace; color: #ff5504; font-weight: 700;"><?php echo $sesion->getUsuarioActual(); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rol: <span style="font-family: monospace; color: #0451ff; font-weight: 700;"><?php echo $rolActivo->getRodescripcion(); ?></span>
                </li>
              </ul>
            </div>
            <!-- ICONO Cambiar ROLES -->
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
          <!-- ---------- CONTENIDO PARA desdeAccion --------------------- -->
          <?php  
        }?>
        <?php
        if ($estructuraAMostrar=="desdeSubAccion"){
          $idrol=$rolActivo->getIdrol();
        }
        ?>
    </div> <!-- cierre container-fluid -->
  </nav>

  <?php
  }?>

  
<main class="container mh-100" style="min-height: 100vh;">