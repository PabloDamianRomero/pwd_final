<?php
class CompraEstado{
    private $idcompraestado;
    private $objCompra;
    private $objCompraestadotipo;
    private $cefechaini;
    private $cefechafin;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idcompraestado="";
        $this->objCompra=null;
        $this->objCompraestadotipo=null;
        $this->cefechaini="";
        $this->cefechafin="";
        $this->mensajeoperacion="";
    }
    public function setear($idcompraestado,$objCompra,$objCompraestadotipo,$cefechaini,$cefechafin){
        $this->idcompraestado=$idcompraestado;
        $this->objCompra=$objCompra;
        $this->objCompraestadotipo=$objCompraestadotipo;
        $this->cefechaini=$cefechaini;
        $this->cefechafin=$cefechafin;
    }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestado WHERE idcompraestado = ".$this->getIdcompraestado();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $abmCompra=new abmCompra();
                    $objCompra=$abmCompra->buscar(['idcompra'=>$row['idcompra']]);
                    if (!empty($objCompra)){
                        $objCompra=$objCompra[0];
                    }
                    $abmCompraestadotipo=new abmCompraestadotipo();
                    $objCompraestadotipo=$abmCompraestadotipo->buscar(['idcompraestadotipo'=>$row['idcompraestadotipo']]);
                    if (!empty($objCompraestadotipo)){
                        $objCompraestadotipo=$objCompraestadotipo[0];
                    }
                    $this->setear($row['idcompraestado'], $objCompra,$objCompraestadotipo,$row['cefechaini'],$row['cefechafin']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("Compraestado->cargar: ".$base->getError());
        }
        return $resp;
    
        
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compraestado(idcompra,idcompraestadotipo,cefechaini,cefechafin)  VALUES('".$this->getObjCompra()->getIdcompra()."','".$this->getObjCompraestadotipo()->getIdcompraestadotipo()."','".$this->getCefechaini()."','".$this->getCefechafin()."');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdcompraestado($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compraestado->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compraestado->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE compraestado SET idcompra='".$this->getObjCompra()->getIdcompra()."', idcompraestadotipo= '" . $this->getObjCompraestadotipo()->getIdcompraestadotipo(). "', cefechaini= '" . $this->getCefechaini() . "', cefechafin= '" . $this->getCefechafin() . "' WHERE idcompraestado=".$this->getIdcompraestado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compraestado->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compraestado->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraestado WHERE idcompraestado=".$this->getIdcompraestado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Compraestado->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compraestado->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestado ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Usuario();
                    $abmCompra=new abmCompra();
                    $objCompra=$abmCompra->buscar(['idcompra'=>$row['idcompra']]);
                    if (!empty($objCompra)){
                        $objCompra=$objCompra[0];
                    }
                    $abmCompraestadotipo=new abmCompraestadotipo();
                    $objCompraestadotipo=$abmCompraestadotipo->buscar(['idcompraestadotipo'=>$row['idcompraestadotipo']]);
                    if (!empty($objCompraestadotipo)){
                        $objCompraestadotipo=$objCompraestadotipo[0];
                    }
                    $obj->setear($row['idcompraestado'], $objCompra,$objCompraestadotipo,$row['cefechaini'],$row['cefechafin']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            $this->setmensajeoperacion("Compraestado->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

    public function getIdcompraestado()
    {
        return $this->idcompraestado;
    }
    public function setIdcompraestado($idcompraestado)
    {
        $this->idcompraestado = $idcompraestado;

        return $this;
    }
    public function getObjCompra()
    {
        return $this->objCompra;
    }
    public function setObjCompra($objCompra)
    {
        $this->objCompra = $objCompra;
    }
    public function getObjCompraestadotipo()
    {
        return $this->objCompraestadotipo;
    }
    public function setObjCompraestadotipo($objCompraestadotipo)
    {
        $this->objCompraestadotipo = $objCompraestadotipo;
    }
    public function getCefechaini()
    {
        return $this->cefechaini;
    }
    public function setCefechaini($cefechaini)
    {
        $this->cefechaini = $cefechaini;
    }
    public function getCefechafin()
    {
        return $this->cefechafin;
    }
    public function setCefechafin($cefechafin)
    {
        $this->cefechafin = $cefechafin;
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