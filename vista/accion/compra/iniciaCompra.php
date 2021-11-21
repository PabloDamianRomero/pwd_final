<?php
$estructuraAMostrar = "desdeSubAccion";
$seguro=true;
$titulo="Inicio Compra - Cliente";
include_once ("estructura/cabecera.php");
// ---------------------- Si el usuario actual no es cliente  -------------------------------
if($rolActivo->getIdrol() != 3){?>
    <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    No puede visualizar esta pagina (No está con el rol <span style='font-weight: bold; font-style: italic;'>Cliente</span>).
            </div>
        </div>
    </div>
<?php
}else{
$objUsuario=$sesion->getUsuario();
$idusuario=$objUsuario->getIdusuario();
$abmCompra=new abmCompra();
$comprasUs=$abmCompra->buscar(['idusuario'=>$idusuario]);
//Busco agregar las compras a las que el usuario todavia no dio inicio (no se encuentra en la tabla de compraestado).
if (!empty($comprasUs)){
    $abmEstado=new abmCompraestado();
    $noIniciada=[];
    foreach($comprasUs as $compra){
        $yaIniciada=$abmEstado->buscar(['idcompra'=>$compra->getIdcompra()]);
        if (empty($yaIniciada)){
            array_push($noIniciada,$compra);
        }
    }
}

}
include_once ("estructura/pie.php");
?>
