<?php
include_once("../../../configuracion.php");
$datos=data_submitted();

if (isset($datos['idproducto']) && isset($datos['pronombre']) && isset($datos['prodetalle']) && isset($datos['proprecio']) && isset($datos['procantstock']) && isset($datos['prodeshabilitado'])){
    $abmProd=new abmProducto();
    $controlCantidad = true;
    if($datos['procantstock'] < 0){
        $controlCantidad = false;
    }
    if($controlCantidad){
        $resp=$abmProd->modificacion($datos);
    }else{
        $resp=false;
        $retorno['errorMsg']="El valor de stock no puede ser negativo. Si no existen productos coloque 0 (Cero).";
    }
}else{
    $resp=false;
    $retorno['errorMsg']="No se pudo MODIFICAR el stock.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);
?>