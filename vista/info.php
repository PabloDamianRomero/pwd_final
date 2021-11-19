<?php
include_once("../configuracion.php");
$titulo = "Información";
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
        font-size: 20px;
    }
    .negrita{
        font-weight: bold;
    }
</style>

<div style="margin-bottom: 20%" class="container-fluid text-center">
    <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
        <div class="container">
            <h1 class="display-4 fuente-monts">Información</h1>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid" style="margin-top: 50px;">
        <div class="container">
            <p class=p-about>Tienda On-Line con 2 vistas: una vista “pública” y otra “privada”.</p>
            <p class=p-about>Desde la <span class=negrita>vista pública</span> se tiene acceso a la información de la tienda: dirección, medios de contacto, descripción y toda aquella información que crea importante desplegar. Además se podrá acceder a la vista privada de la aplicación, a partir del ingreso de un usuario y contraseña válida.</p>
            <p class=p-about>Desde la <span class=negrita>vista privada</span>, luego de concretar el proceso de autenticación y dependiendo los roles con el que cuenta el usuario que ingresa al sistema, se van a poder realizar diferentes operaciones. Los roles iniciales son: cliente, depósito y administrador.</p>
        </div>
    </div>
<div>

<div style="margin-bottom: 20%" class="container-fluid text-center">
    <div class="jumbotron jumbotron-fluid" style="margin-top: 60px;">
        <div class="container">
            <h1 class="display-4 fuente-monts">Características</h1>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid" style="margin-top: 50px;">
        <div class="container">
            <p class=p-about>La aplicación es desarrollada sobre una arquitectura <span class="negrita">MVC</span> (Modelo-Vista-Control) utilizando PHP como lenguaje de programación.</p>
            <p class=p-about>Se utiliza una Base de Datos llamada <span class="negrita">bdcarritocompras</span> otorgada por la cátedra. Esto es acompañado con la implementación del <span class="negrita">ORM</span> de las tablas del modelo de base de datos. </p>
            <p class=p-about>La aplicación utiliza un módulo de autenticación para otorgar acceso tanto a las páginas públicas como a las restringidas, mediante un usuario y contraseña.</p>
            <p class=p-about>El menú de la aplicación es un menú dinámico que puede ser gestionado por el administrador de la aplicación.</p>
            <p class=p-about>Cualquier usuario que tenga más de un rol asignado, puede cambiar de rol según lo desee.</p>
            <p class=p-about></p>
            <p class=p-about></p>
            <p class=p-about></p>
        </div>
    </div>
<div>

<div style="margin-bottom: 20%" class="container-fluid text-center">
    <div class="jumbotron jumbotron-fluid" style="margin-top: 60px;">
        <div class="container">
            <h1 class="display-4 fuente-monts">Permisos</h1>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid" style="margin-top: 60px;">
        <div class="container">
            <h3 class="fuente-monts">Para un usuario Cliente:</h3>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid" style="margin-top: 50px;">
        <div class="container">
            <p class=p-about>- Gestionar los datos de su cuenta, como cambiar su e-mail y contraseña.</p>
            <p class=p-about>- Realizar la compra de uno o más productos con stock suficiente.</p>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid" style="margin-top: 60px;">
        <div class="container">
            <h3 class="fuente-monts">Para un usuario Depósito:</h3>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid" style="margin-top: 50px;">
        <div class="container">
            <p class=p-about>- Crear nuevos productos y administrar los existentes.</p>
            <p class=p-about>- Acceder a los procedimientos que permite el cambio de estado de los productos.</p>
            <p class=p-about>- Modificar el stock de los productos.</p>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid" style="margin-top: 60px;">
        <div class="container">
            <h3 class="fuente-monts">Para un usuario Administrador:</h3>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid" style="margin-top: 50px;">
        <div class="container">
            <p class=p-about>- Crear nuevos usuarios al sistema, asignar los roles correspondientes y actualizar la información que se requiera.</p>
            <p class=p-about>- Gestionar y administrar nuevos roles e ítem del menú. Vinculando item del menú al rol según corresponda.</p>
        </div>
    </div>
<div>

<?php
ini_restore('display_errors');
include_once "estructura/pie.php";
?>