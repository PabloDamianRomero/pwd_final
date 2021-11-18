<?php
include_once("../../../configuracion.php");
$data=data_submitted();
$objControl=new abmMenurol();
$list=$objControl->buscar($data);
$arreglo_salida=array();
foreach($list as $elem){
    $nuevoElem['idmenu']=$elem->getObjMenu()->getIdmenu();
    $abmMe=new abmMenu();
    $arrMe=$abmMe->buscar(['idmenu'=>$elem->getObjMenu()->getIdmenu()]);
    if (!empty($arrMe)){
        $nuevoElem['menombre']=$arrMe[0]->getMenombre();
    }else{
        $nuevoElem['menombre']="";
    }
    $nuevoElem['idrol']=$elem->getObjRol()->getIdrol();
    $abmRol=new abmRol();
    $arrRol=$abmRol->buscar(['idrol'=>$elem->getObjRol()->getIdrol()]);
    if (!empty($arrRol)){
        $nuevoElem['rodescripcion']=$arrRol[0]->getRodescripcion();
    }else{
        $nuevoElem['rodescripcion']="";
    }
    
    array_push($arreglo_salida,$nuevoElem);
}
echo json_encode($arreglo_salida);
?>