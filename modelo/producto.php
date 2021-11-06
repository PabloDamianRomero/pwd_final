<?php
class Producto{
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $cantstock;
    private $mensajeoperacion;
    public function __construct()
    {
        $this->idproducto="";
        $this->pronombre="";
        $this->prodetalle="";
        $this->cantstock="";
        $this->mensajeoperacion="";
    }
    public function setear($idproducto,$pronombre,$prodetalle,$cantstock){
        $this->idproducto=$idproducto;
        $this->pronombre=$pronombre;
        $this->prodetalle=$prodetalle;
        $this->cantstock=$cantstock;
    }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM producto WHERE idproducto = ".$this->getIdproducto();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idproducto'], $row['pronombre'],$row['prodetalle'],$row['cantstock']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("Producto->cargar: ".$base->getError());
        }
        return $resp;
    
        
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO producto(pronombre,prodetalle,cantstock)  VALUES('".$this->getPronombre()."','".$this->getProdetalle()."','".$this->getCantstock()."');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdproducto($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE producto SET pronombre='".$this->getPronombre()."', prodetalle= '" . $this->getProdetalle() . "', cantstock= '" . $this->getCantstock() . "' WHERE idproducto=".$this->getIdproducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM producto WHERE idproducto=".$this->getIdproducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Producto->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM producto ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Producto();
                    $obj->setear($row['idproducto'], $row['pronombre'],$row['prodetalle'],$row['cantstock']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            $this->setmensajeoperacion("Producto->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

    public function getIdproducto()
    {
        return $this->idproducto;
    }
    public function setIdproducto($idproducto)
    {
        $this->idproducto = $idproducto;
    }
    public function getPronombre()
    {
        return $this->pronombre;
    }
    public function setPronombre($pronombre)
    {
        $this->pronombre = $pronombre;
    }
    public function getProdetalle()
    {
        return $this->prodetalle;
    }
    public function setProdetalle($prodetalle)
    {
        $this->prodetalle = $prodetalle;
    }
    public function getCantstock()
    {
        return $this->cantstock;
    }
    public function setCantstock($cantstock)
    {
        $this->cantstock = $cantstock;
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