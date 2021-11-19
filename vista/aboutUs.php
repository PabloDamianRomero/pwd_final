<?php
include_once("../configuracion.php");
$titulo = "Sobre Nosotros";
$estructuraAMostrar = "desdeVista";
$seguro = true;
$contactSession = new Session();
ini_set('display_errors', 0); // ocultar mensaje Ignoring session_start() because a session is already active
if ($contactSession->activa()) {
    include_once "estructura/cabecera.php";
}else{
    $contactSession->cerrar();
    include_once "estructura/cabeceraEstatica.php";
}
?>
<style>
    .p-about{
        font-size: 23px;
    }
</style>

<div style="margin-bottom: 20%" class="container-fluid text-center">
    <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
        <div class="container">
            <h1 class="display-4 fuente-monts">Sobre Nosotros</h1>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid" style="margin-top: 50px;">
        <div class="container">
            <div class="table-responsive" style="margin-top: 50px;">
            <table class="table table-striped text-center">
                <thead>
                    <tr style="color: #6a6a6a; background-color: #93d7e7;">
                        <th scope="col">Apellido y Nombres</th>
                        <th scope="col">Legajo</th>
                        <th scope="col">Mail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Peralta Macri, Matías Federico</th>
                        <th scope="row">FAI - 3077</th>
                        <th scope="row">matias.peralta@est.fi.uncoma.edu.ar</th>
                    </tr>
                    <tr>
                        <th scope="row">Romero, Pablo Damian</th>
                        <th scope="row">FAI - 1652</th>
                        <th scope="row">pablo.romero@est.fi.uncoma.edu.ar</th>
                    </tr>
                </tbody>
                </table>
    </div>
    </div>
    <div class="jumbotron jumbotron-fluid" style="margin-top: 50px;">
        <div class="container">
            <h1 class="display-4 fuente-monts">Objetivo</h1>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid" style="margin-top: 50px;">
        <div class="container">
            <p class=p-about>Tienda On-line de componentes para Pc. La misma puede ser accedida a través de un usuario registrado.
                Los usuarios a su vez, cuentan con distintos roles, según los permisos otorgados por un administrador.
                Dependiendo del rol del usuario, podrá efectuar distintas acciones.
            </p>
        </div>
    </div>
<div>

<?php
ini_restore('display_errors');
include_once "estructura/pie.php";
?>