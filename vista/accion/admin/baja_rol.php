<?php
include_once("../../../configuracion.php");
$datos=data_submitted();

$resp=false;
if (isset($datos['idrol'])){
    $abmMenuRol=new abmMenurol();
    $arrayMenuRol=$abmMenuRol->buscar(['idrol'=>$datos['idrol']]);
    if (!empty($arrayMenuRol)){
        foreach ($arrayMenuRol as $obj){
            $obj->eliminar();   //Borra los objetos con claves foraneas de tabla MenuRol
        }
                    
    }
    $abmUsuarioRol=new abmUsuariorol();
    $arrayUsuarioRol=$abmUsuarioRol->buscar(['idrol'=>$datos['idrol']]);
    if (!empty($arrayUsuarioRol)){
        foreach ($arrayUsuarioRol as $obj){
            $obj->eliminar();   //Borra los objetos con claves foraneas de tabla UsuarioRol
        }
    }
    $abmRol=new abmRol();
    $resp=$abmRol->baja($datos);
}
if (!$resp){
    $retorno['errorMsg']="No se pudo ELIMINAR el rol.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);
?>