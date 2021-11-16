<?php
include_once("../../../configuracion.php");
$data=data_submitted();
$objControl=new abmProducto();
$list=$objControl->buscar($data);
$arreglo_salida=array();
foreach($list as $elem){
    $nuevoElem['idproducto']=$elem->getIdproducto();
    $nuevoElem['pronombre']=$elem->getPronombre();
    $nuevoElem['prodetalle']=$elem->getProdetalle();
    $nuevoElem['proprecio']=$elem->getProprecio();
    $nuevoElem['procantstock']=$elem->getProcantstock();
    $nuevoElem['prodeshabilitado']=$elem->getProdeshabilitado();
    array_push($arreglo_salida,$nuevoElem);
}
echo json_encode($arreglo_salida);
?>