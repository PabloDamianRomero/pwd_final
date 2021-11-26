<?php
include_once("../../../configuracion.php");
$datos=data_submitted();

if (isset($datos['idproducto']) && isset($datos['pronombre']) && isset($datos['prodetalle']) && isset($datos['proprecio']) && isset($datos['procantstock']) && isset($datos['prodeshabilitado'])){
    $abmProd=new abmProducto();
    $retorno=$abmProd->modificacion($datos);
}else{
    $retorno['respuesta']=$resp;
    $retorno['errorMsg']="No se pudo MODIFICAR el stock.";
}

echo json_encode($retorno);
?>