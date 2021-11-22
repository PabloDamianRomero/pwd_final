<?php
    $titulo="Finalizar Compra Carrito";
    $estructuraAMostrar = "desdeSubAccion";
    $seguro=true;
    include_once("../../estructura/cabecera.php");
// ---------------------- Si el usuario actual no es cliente  -------------------------------

if($idrol!= 3){?>
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
    $datos=data_submitted();
    if (isset($datos['idcompra'])){
        //Cambio el metodo de compra de 'carrito' a 'normal' para que no se cargue en la tabla de carrito.
        $abmCompra=new AbmCompra();
        $compra=$abmCompra->buscar(['idcompra'=>$datos['idcompra']]);
        $abmCompra->modificacion(['idcompra'=>$datos['idcompra'],'cofecha'=>$compra[0]->getCofecha(),'idusuario'=>$compra[0]->getObjUsuario()->getIdusuario(),'metodo'=>'normal']);
        $abmEstado=new abmCompraestado();
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $date = date('Y-m-d H:i:s');
        $resp=$abmEstado->alta(['idcompra'=>$datos['idcompra'],'idcompraestadotipo'=>1,'cefechaini'=>$date]);
        if ($resp){
            header("Location:retornoCompra.php?resp=exito");
        }else{
            header("Location:retornoCompra.php?resp=fallo");
        }
    }else{
        header("Location:retornoCompra.php?resp=fallo");
    }
    
}
include_once("../../estructura/pie.php");
?>