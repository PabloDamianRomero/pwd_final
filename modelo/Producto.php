<?php
class Producto
{
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $procantstock;
    private $proprecio;
    private $prodeshabilitado;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idproducto = "";
        $this->pronombre = "";
        $this->prodetalle = "";
        $this->procantstock = "";
        $this->proprecio= "";
        $this->prodeshabilitado="";
        $this->mensajeoperacion = "";
    }

    public function setear($idproducto, $pronombre, $prodetalle,$proprecio,$prodeshabilitado,$procantstock)
    {
        $this->idproducto = $idproducto;
        $this->pronombre = $pronombre;
        $this->prodetalle = $prodetalle;
        $this->proprecio= $proprecio;
        $this->prodeshabilitado=$prodeshabilitado;
        $this->procantstock = $procantstock;
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto WHERE idproducto = " . $this->getIdproducto();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['proprecio'], $row['prodeshabilitado'], $row['procantstock']);
                }
            }
        } else {
            $this->setmensajeoperacion("Producto->cargar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO producto(pronombre,prodetalle,proprecio,procantstock,prodeshabilitado)  VALUES('" . $this->getPronombre() . "','" . $this->getProdetalle() . "','".$this->getProprecio()."','".$this->getProcantstock()."',";
        if ($this->getProdeshabilitado()!=null){
            $sql.="'".$this->getProdeshabilitado()."'";
        }else{
            $sql.="null";
        }
        $sql.=");";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdproducto($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->insertar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->insertar-2: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE producto SET pronombre='" . $this->getPronombre() . "', prodetalle= '" . $this->getProdetalle() . "',proprecio=".$this->getProprecio().", procantstock= " . $this->getProCantstock() . ", prodeshabilitado= '".$this->getProdeshabilitado()."' WHERE idproducto=" . $this->getIdproducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->modificar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->modificar-2: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM producto WHERE idproducto=" . $this->getIdproducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Producto->eliminar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->eliminar-2: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new Producto();
                    $obj->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['proprecio'], $row['prodeshabilitado'], $row['procantstock']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("Producto->listar: " . $base->getError());
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

    public function getProCantstock()
    {
        return $this->procantstock;
    }

    public function setProCantstock($procantstock)
    {
        $this->procantstock = $procantstock;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }
    public function getProprecio()
    {
        return $this->proprecio;
    }
    public function setProprecio($proprecio)
    {
        $this->proprecio = $proprecio;
    }
    public function getProdeshabilitado()
    {
        return $this->prodeshabilitado;
    }
    public function setProdeshabilitado($prodeshabilitado)
    {
        $this->prodeshabilitado = $prodeshabilitado;
        return $this;
    }
}
