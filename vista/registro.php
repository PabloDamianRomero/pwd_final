<?php
$titulo = "Registrar";
$estructuraAMostrar = "desdeVista";
$seguro = false;
include_once("estructura/cabecera.php");
$objLogin = new Session();
if ($objLogin->activa()) {
    $idRol = $objLogin->getRolActivo()->getIdrol();
    header("Location:paginaSegura.php?idrol=".$idRol."");
     exit();
}

$datos = data_submitted();
$mensaje = "";
if (isset($datos['reg'])){
    $mensaje = $datos['reg'];
}
?>

<div style="margin-bottom: 20%" class="container-fluid text-center">
<div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
        <div class="container">
            <h1 class="display-4">Compupartes</h1>
            <p class="lead">La tienda online de componentes de PC que estabas buscando.</p>
        </div>
        <h2 class="display-5" style="margin-top:50px;">Crear usuario</h2>
    </div>

    <div class="text-center mt-5 mb-5">
        <form class="card needs-validation" method="post" action="accion/cliente/cliente_registro.php" style="max-width: 300px;margin:auto; padding:20px" novalidate>
                    <div class="mt-3">
                        <div id="invalid" style="color:red">
                            <?php if (!$mensaje==""){
                                echo $mensaje;
                            } ?>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
                            </span>
                            <input type="text" id="usnombre" name="usnombre"  class="form-control" placeholder="Usuario" aria-describedby="basic-addon1" required>
                            <div class="invalid-feedback" id="user-text"></div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/></svg>
                            </span>
                            <input type="password" id="uspass" name="uspass" class="form-control" placeholder="Contraseña" aria-describedby="basic-addon2" required>
                            <div class="invalid-feedback" id="pass-text"></div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/></svg>
                            </span>
                            <input type="text" id="usmail" name="usmail" class="form-control" placeholder="Mail" aria-describedby="basic-addon2" required>
                            <div class="invalid-feedback" id="mail-text"></div>
                        </div>
                        
                    </div>
                <div class="mt-3 d-grid">
                    <button type="submit" class="btn btn-lg btn-success">Registrarse</button>
                </div>
                <div class="mt-3 d-grid">
                    <a href="index.php">Volver a inicio</a>
                </div>
        </form>
    </div>

</div>

<?php
include_once "estructura/pie.php";
?>