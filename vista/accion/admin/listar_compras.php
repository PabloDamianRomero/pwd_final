<?php
include_once("../../../configuracion.php");
$objControl=new abmCompraestado();
$list=$objControl->buscar(null);
$arreglo_salida=array();
foreach($list as $elem){
    $nuevoElem['idcompraestado']=$elem->getIdcompraestado();
    $nuevoElem['idcompra']=$elem->getObjCompra()->getIdcompra();
    $nuevoElem['idcompraestadotipo']=$elem->getObjCompraestadotipo()->getIdcompraestadotipo();
    $nuevoElem['cetdescripcion']=$elem->getObjCompraestadotipo()->getCetdescripcion();
    $nuevoElem['cefechaini']=$elem->getCefechaini();
    $nuevoElem['cefechafin']=$elem->getCefechafin();
    array_push($arreglo_salida,$nuevoElem);
}
echo json_encode($arreglo_salida);
?>