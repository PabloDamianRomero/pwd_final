<?php
    include_once("../configuracion.php");
    $abmProd=new abmProducto();
    $arreglo=$abmProd->buscar(null);
?>
<!DOCTYPE html>
<head>
    <title>Tienda</title>
    <link rel='stylesheet' href='css/bootstrap/bootstrap.css'>
    <link rel='stylesheet' href='css/bootstrap/bootstrap.min.css'>

</head>

<div class="row">
    <?php
        foreach ($arreglo as $obj){
            if ($obj->getProdeshabilitado()=="0000-00-00 00:00:00"){
                echo '<div class="col-3"> <a href="accion/productos.php?idproducto='.$obj->getIdproducto().'"><img style="width:300px" src="archivos/productos/img/'.$obj->getProdetalle().'.jpg"></a>';
                $enlace="archivos/productos/detalle/".$obj->getProdetalle().".txt";
                echo '<div><p>'.$obj->getPronombre().'</p></div>';
                echo '<div><p>$'.$obj->getProprecio().'</p></div></div>';
            }
        }
    ?>
</div>