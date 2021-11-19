<?php
$titulo = "Index";
$estructuraAMostrar = "desdeVista";
$seguro = true;
include_once "estructura/cabecera1.php";
?>

<div style="margin-bottom: 20%" class="container-fluid text-center">
    <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
        <div class="container">
            <h1 class="display-4 fuente-monts">Compupartes</h1>
            <p class="lead">La tienda online de componentes de PC que estabas buscando.</p>
        </div>
    </div>

    <div class="jumbotron d-flex align-items-center">
        <div class="container mt-5">
          <!-- ini -->
          <div class="row">
            <div class="col-sm-4">
              <div class="card">
              <img class="card-img-top" src="img/aboutUs.jpg" alt="Sobre nosotros">
                <div class="card-body">
                  <h5 class="card-title">Sobre nosotros</h5>
                  <p class="card-text">Una breve introducción sobre la tienda y sus autores.</p>
                  <a href="aboutUs.php" class="btn btn-primary">Ver más</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
              <img class="card-img-top" src="img/contact.jpg" alt="Contacto">
                <div class="card-body">
                  <h5 class="card-title">Contacto</h5>
                  <p class="card-text">Comuníquese con nosotros ante cualquier duda.</p>
                  <a href="contacto.php" class="btn btn-primary">Ver más</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                <img class="card-img-top" src="img/info.jpg" alt="Información">
                  <div class="card-body">
                    <h5 class="card-title">Información</h5>
                    <p class="card-text">Detalles adicionales sobre el sitio.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                  </div>
                </div>
              </div>
          </div>
          <!-- fin -->
        </div>
      </div>
<div>

<?php
include_once "estructura/pie.php";
?>