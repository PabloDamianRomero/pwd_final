<?php
include_once("../../../configuracion.php");
$datos=data_submitted();
$resp=false;
if (isset($datos['idusuario'])){
    $abmCompra=new abmCompra();
    $arrayCompra=$abmCompra->buscar(['idusuario'=>$datos['idusuario']]);
    if (!empty($arrayCompra)){
        foreach($arrayCompra as $obj){
            $obj->eliminar();   //Borra los objetos con claves foraneas de tabla Compra
        }
    }
    $abmUsuarioRol=new abmUsuariorol();
    $arrayUsuarioRol=$abmUsuarioRol->buscar(['idusuario'=>$datos['idusuario']]);
    if (!empty($arrayUsuarioRol)){
        foreach($arrayUsuarioRol as $obj){
            $obj->eliminar();   //Borra los objetos con claves foraneas de tabla UsuarioRol
        }
    }
    $abmUs=new abmUsuario();
    $resp=$abmUs->baja($datos);
}
if (!$resp){
    $retorno['errorMsg']="No se pudo ELIMINAR el usuario.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);

?>