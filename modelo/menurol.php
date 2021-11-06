<?php
class MenuRol{
    private $objMenu;
    private $objRol;
    private $mensajeoperacion;
    public function __construct()
    {
        $this->objMenu=null;
        $this->objRol=null;
        $this->mensajeoperacion="";
    }
    public function setear($objMenu,$objRol){
        $this->objMenu=$objMenu;
        $this->objRol=$objRol;
    }
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM menurol WHERE idmenu = ".$this->getObjMenu()->getIdmenu();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idmenu'], $row['idrol']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("menurol->cargar: ".$base->getError());
        }
        return $resp;
    
        
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO menurol(idmenu,idrol)  VALUES('".$this->getObjMenu()->getIdmenu()."','".$this->getObjRol()->getIdrol()."');";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Menurol->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Menurol->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE menurol SET idrol='".$this->getObjRol()->getIdrol()."' WHERE idmenu=".$this->getObjMenu()->getIdmenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("menurol->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("menurol->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM menurol WHERE idmenu=".$this->getObjMenu()->getIdmenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("menurol->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("menurol->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM menurol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Menurol();
                    $obj->setear($row['idmenu'], $row['idrol']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            $this->setmensajeoperacion("menurol->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

    public function getObjMenu()
    {
        return $this->objMenu;
    }
    public function setObjMenu($objMenu)
    {
        $this->objMenu = $objMenu;
    }
    public function getObjRol()
    {
        return $this->objRol;
    }
    public function setObjRol($objRol)
    {
        $this->objRol = $objRol;
    }
    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }
    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }
}
?>