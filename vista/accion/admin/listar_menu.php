<?php
include_once("../../../configuracion.php");
$data=data_submitted();
$objControl=new abmMenu();
$list=$objControl->buscar($data);
$arreglo_salida=array();
foreach($list as $elem){
    $nuevoElem['idmenu']=$elem->getIdmenu();
    $nuevoElem['menombre']=$elem->getMenombre();
    $nuevoElem['medescripcion']=$elem->getMedescripcion();
    if ($elem->getObjMenu()!=null){
        $nuevoElem['idpadre']=$elem->getObjMenu()->getidMenu();
    }else{
        $nuevoElem['idpadre']=null;
    }
    $nuevoElem['medeshabilitado']=$elem->getMedeshabilitado();
    array_push($arreglo_salida,$nuevoElem);
}
echo json_encode($arreglo_salida);
?>