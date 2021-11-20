<?php
$estructuraAMostrar = "desdeVista";
$seguro=true;
$titulo="Vista de Producto";
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
    $datos=data_submitted();
    $arrayP=[];
    if (isset($datos['idproducto'])){
        $abmProd=new abmProducto();
        $arrayP=$abmProd->buscar($datos);
    }
    $objP=null;
    if (!empty($arrayP)){
        $objP=$arrayP[0];
    }
    if ($objP!=null){
        $enlace="archivos/productos/detalle/".$objP->getProdetalle().".txt";
        $handle = fopen($enlace, "r");
        if(filesize($enlace) > 0){
            $content = fread($handle, filesize($enlace));
        }else{
            $content = "No hay descripcion del producto";
        }
        fclose($handle);

?>
<div class="row">
    <div class="col-2"></div>
    <div class="col-5">
        <a href="<?php echo 'archivos/productos/img/'.$objP->getProdetalle().'.jpg' ?>"><img style="width:500px" src="<?php echo 'archivos/productos/img/'.$objP->getProdetalle().'.jpg' ?>"></a>        
    </div>
    <div class="col-3">
        <div class="row">
            <div class="col-12">
                <h5><?php echo $objP->getPronombre()  ?></h5>
            </div>
            <div class="col-12">
                <p><?php echo $content ?></p>
            </div>
            <?php
                if ($objP->getProCantstock()>0){
                    echo '<div class="col-12 mt-5">
                                <h6>Unidades disponibles: '.$objP->getProCantstock().'</h6>
                            </div>
                            <form method="post" action="accion/compra/ordenCompra.php">
                            <div class="col-12 mb-2">
                                <small>Cantidad</small>
                                <input type="number" name="cantidad" id="cantidad" value="1">';
                                if (isset($datos['error'])){
                                    echo '<div style="color:red">Hubo un error con la compra. Intente de nuevo.</div>';
                                }
                                echo '<input type="hidden" name="idproducto" id="idproducto" value="'.$datos['idproducto'].'">
                            </div>
                            <div class="col">
                                <input type="submit" class="btn btn-primary" id="compra" name="compra" value="Comprar">
                                <input type="submit" class="btn btn-outline-primary" id="orden" name="orden" value="Agregar al carrito">
                            </div>
                            </form>';
                }else{
                    echo '<div class="col-12">
                            <h6>No disponible por el momento</h6>
                        </div>';
                }
            ?>
            

        </div>
    </div>
</div>
<?php
    }else{
        echo '<div class="alert alert-danger" role="alert">Error en la busqueda del producto.</div>';
    }

}
include_once("estructura/pie.php");    
?>
    
