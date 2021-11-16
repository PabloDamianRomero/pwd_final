<?php
include_once("../../../configuracion.php");
$datos=data_submitted();

if (isset($datos['idproducto']) && isset($datos['pronombre']) && isset($datos['prodetalle']) && isset($datos['proprecio']) && isset($datos['procantstock']) && isset($datos['prodeshabilitado'])){
    $abmProd=new abmProducto();
    $resp=$abmProd->modificacion($datos);
}else{
    $resp=false;
    $retorno['errorMsg']="No se pudo MODIFICAR el stock.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);
?>