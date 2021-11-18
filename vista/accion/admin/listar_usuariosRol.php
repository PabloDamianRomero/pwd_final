<?php
include_once("../../../configuracion.php");

$data=data_submitted();
$objControl=new abmUsuariorol();
$list=$objControl->buscar($data);
$arreglo_salida=array();
foreach($list as $elem){
    $nuevoElem['idusuario']=$elem->getObjUsuario()->getIdusuario();
    $abmUs=new abmUsuario();
    $arrUs=$abmUs->buscar(['idusuario'=>$elem->getObjUsuario()->getIdusuario()]);
    if (!empty($arrUs)){
        $nuevoElem['usnombre']=$arrUs[0]->getUsnombre();
    }else{
        $nuevoElem['usnombre']="";
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