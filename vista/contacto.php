<?php
include_once("../configuracion.php");
$titulo = "Contacto";
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

<div style="margin-bottom: 20%" class="container-fluid text-center">
   <!-- Section: Contact v.1 -->
<section class="my-5">

<!-- Section heading -->
<h1 class="h1-responsive font-weight-bold text-center my-5 fuente-monts">Compupartes - Contacto</h1>
<!-- Section description -->

<!-- Grid row -->
<div class="row">

  <!-- Grid column -->
  <div class="col-lg-5 mb-lg-0 mb-4">

    <!-- Form with header -->
    <div class="card">
      <div class="card-body">
        <!-- Header -->
        <div class="form-header blue accent-1">
          <h3 class="mt-2"><i class="fas fa-envelope"></i> Consúltenos:</h3>
        </div>
        <p class="dark-grey-text">Ante cualquier duda o consulta, complete el siguiente formulario.</p>
        <!-- Body -->
        <div class="md-form m-3">
          <i class="fas fa-user prefix grey-text"></i>
          <label for="form-name">Su nombre</label>
          <input type="text" id="form-name" class="form-control">
        </div>
        <div class="md-form m-3">
          <i class="fas fa-envelope prefix grey-text"></i>
          <label for="form-email">Su email</label>
          <input type="text" id="form-email" class="form-control">
        </div>
        <div class="md-form m-3">
          <i class="fas fa-tag prefix grey-text"></i>
          <label for="form-Subject">Sujeto</label>
          <input type="text" id="form-Subject" class="form-control">
        </div>
        <div class="md-form m-3">
          <i class="fas fa-pencil-alt prefix grey-text"></i>
          <label for="form-text">Escriba su mensaje</label>
          <textarea id="form-text" class="form-control md-textarea" rows="3"></textarea>
        </div>
        <div class="text-center">
          <button class="btn btn-primary">Enviar</button>
        </div>
      </div>
    </div>
    <!-- Form with header -->

  </div>
  <!-- Grid column -->

  <!-- Grid column -->
  <div class="col-lg-7">

    <!--Google map-->
    <div id="map-container-section" class="z-depth-1-half map-container-section mb-4" style="height: 400px">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3103.297736883845!2d-68.05798068455162!3d-38.94002600709299!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x960a33ddad7d7867%3A0x8e9d0c6aed561b29!2sBuenos%20Aires%201400%2C%20Q8300%20Neuqu%C3%A9n!5e0!3m2!1ses-419!2sar!4v1637312341262!5m2!1ses-419!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <!-- Buttons-->
    <div class="row text-center">
      <div class="col-md-4">
        <a class="btn-floating blue accent-1">
          <i class="fas fa-map-marker-alt"></i>
        </a>
        <p>Buenos Aires, 1400</p>
        <p class="mb-md-0">Argentina</p>
      </div>
      <div class="col-md-4">
        <a class="btn-floating blue accent-1">
          <i class="fas fa-phone"></i>
        </a>
        <p>+ 01 234 567 89</p>
        <p class="mb-md-0">Mon - Fri, 8:00-22:00</p>
      </div>
      <div class="col-md-4">
        <a class="btn-floating blue accent-1">
          <i class="fas fa-envelope"></i>
        </a>
        <p>info@gmail.com</p>
        <p class="mb-0">sale@gmail.com</p>
      </div>
    </div>

  </div>
  <!-- Grid column -->

</div>
<!-- Grid row -->

</section>
<!-- Section: Contact v.1 -->
<div>

<?php
ini_restore('display_errors');
include_once "estructura/pie.php";
?>