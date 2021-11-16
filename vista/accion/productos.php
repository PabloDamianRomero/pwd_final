<?php
    include_once("../../configuracion.php");
    $datos=data_submitted();
    $abmProd=new abmProducto();
    $array=$abmProd->buscar($datos);
    $objP=null;
    if (!empty($array)){
        $objP=$array[0];
    }
    if ($objP!=null){
        $enlace="../archivos/productos/detalle/".$objP->getProdetalle().".txt";
        $handle = fopen($enlace, "r");
        if(filesize($enlace) > 0){
            $content = fread($handle, filesize($enlace));
        }else{
            $content = "No hay descripcion";
        }
        fclose($handle);

?>
<head>
    <link rel='stylesheet' href='../css/bootstrap/bootstrap.css'>
    <link rel='stylesheet' href='../css/bootstrap/bootstrap.min.css'>
</head>
<body>
<div class="row">
    <div class="col-2"></div>
    <div class="col-5">
        <a href="<?php echo '../archivos/productos/img/'.$objP->getProdetalle().'.jpg' ?>"><img style="width:500px" src="<?php echo '../archivos/productos/img/'.$objP->getProdetalle().'.jpg' ?>"></a>        
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
                    echo '<div class="col-12">
                                <h6>Cantidad en stock: '.$objP->getProCantstock().'</h6>
                            </div>
                            <div class="col">
                                <a href="#" class="btn btn-primary">Comprar</a>
                                <a href="#" class="btn btn-outline-primary">Agregar al carrito</a>
                            </div>';
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
?>
    
