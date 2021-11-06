<?php
class CompraItem{
    private $idcompraitem;
    private $objProducto;
    private $objCompra;
    private $cicantidad;
    private $mensajeoperacion;
    public function __construct()
    {
        $this->idcompraitem="";
        $this->objProducto=null;
        $this->objCompra=null;
        $this->cicantidad="";
        $this->mensajeoperacion="";
    }
    public function setear($idcompraitem,$objProducto,$objCompra,$cicantidad){
        $this->idcompraitem=$idcompraitem;
        $this->objProducto=$objProducto;
        $this->objCompra=$objCompra;
        $this->cicantidad=$cicantidad;
    }
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM compraitem WHERE idcompraitem = ".$this->getIdcompraitem();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $abmProducto=new abmProducto();
                    $objProducto=$abmProducto->buscar(['idproducto'=>$row['idproducto']]);
                    if (!empty($objProducto)){
                        $objProducto=$objProducto[0];
                    }
                    $abmCompra=new abmCompra();
                    $objCompra=$abmCompra->buscar(['idcompra'=>$row['idcompra']]);
                    if (!empty($objCompra)){
                        $objCompra=$objCompra[0];
                    }
                    $this->setear($row['idcompraitem'], $objProducto,$objCompra,$row['cicantidad']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("Compraitem->cargar: ".$base->getError());
        }
        return $resp;
    
        
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compraitem(idproducto,idcompra,cicantidad)  VALUES('".$this->getObjProducto()->getIdproducto()."','".$this->getObjCompra()->getIdcompra()."','".$this->getCicantidad()."');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdcompraitem($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compraitem->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compraitem->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE compraitem SET idproducto='".$this->getObjProducto()->getIdproducto()."', idcompra= '" . $this->getObjCompra()->getIdcompra(). "', cicantidad= '" . $this->getCicantidad() . "' WHERE idcompraitem=".$this->getIdcompraitem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compraitem->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compraitem->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraitem WHERE idcompraitem=".$this->getIdcompraitem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Compraitem->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compraitem->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraitem ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Compraitem();
                    $abmProducto=new abmProducto();
                    $objProducto=$abmProducto->buscar(['idproducto'=>$row['idproducto']]);
                    if (!empty($objProducto)){
                        $objProducto=$objProducto[0];
                    }
                    $abmCompra=new abmCompra();
                    $objCompra=$abmCompra->buscar(['idcompra'=>$row['idcompra']]);
                    if (!empty($objCompra)){
                        $objCompra=$objCompra[0];
                    }
                    $obj->setear($row['idcompraitem'], $objProducto,$objCompra,$row['cicantidad']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            $this->setmensajeoperacion("Compraitem->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

    public function getIdcompraitem()
    {
        return $this->idcompraitem;
    }
    public function setIdcompraitem($idcompraitem)
    {
        $this->idcompraitem = $idcompraitem;
    }
    public function getObjProducto()
    {
        return $this->objProducto;
    }
    public function setObjProducto($objProducto)
    {
        $this->objProducto = $objProducto;
    }
    public function getObjCompra()
    {
        return $this->objCompra;
    }
    public function setObjCompra($objCompra)
    {
        $this->objCompra = $objCompra;
    }
    public function getCicantidad()
    {
        return $this->cicantidad;
    }
    public function setCicantidad($cicantidad)
    {
        $this->cicantidad = $cicantidad;
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