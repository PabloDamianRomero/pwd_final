<?php
class Menu
{
    private $idmenu;
    private $menombre;
    private $medescripcion;
    private $idpadre; //referencia a menu
    private $medeshabilitado;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idmenu = "";
        $this->menombre = "";
        $this->medescripcion = "";
        $this->idpadre = "";
        $this->medeshabilitado = "";
        $this->mensajeoperacion = "";
    }

    public function setear($idmenu, $menombre, $medescripcion, $idpadre, $medeshabilitado)
    {
        $this->idmenu = $idmenu;
        $this->menombre = $menombre;
        $this->medescripcion = $medescripcion;
        $this->idpadre = $idpadre;
        $this->medeshabilitado = $medeshabilitado;
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM menu WHERE idmenu = " . $this->getIdmenu();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idmenu'], $row['menombre'], $row['medescripcion'], $row['idpadre'], $row['medeshabilitado']);

                }
            }
        } else {
            $this->setmensajeoperacion("Menu->cargar: " . $base->getError());
        }
        return $resp;

    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO menu(menombre,medescripcion,idpadre,medeshabilitado)  VALUES('" . $this->getMenombre() . "','" . $this->getMedescripcion() . "','" . $this->getIdpadre() . "','" . $this->getMedeshabilitado() . "');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdmenu($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Menu->insertar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Menu->insertar-2: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE menu SET menombre='" . $this->getMenombre() . "', medescripcion= '" . $this->getMedescripcion() . "', idpadre= '" . $this->getIdpadre() . "', medeshabilitado= '" . $this->getMedeshabilitado() . "' WHERE idmenu=" . $this->getIdmenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("menu->modificar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("menu->modificar-2: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM menu WHERE idmenu=" . $this->getIdmenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("menu->eliminar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("menu->eliminar-2: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM menu ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new Menu();
                    $obj->setear($row['idmenu'], $row['menombre'], $row['medescripcion'], $row['idpadre'], $row['medeshabilitado']);
                    array_push($arreglo, $obj);
                }

            }

        } else {
            $this->setmensajeoperacion("menu->listar: " . $base->getError());
        }

        return $arreglo;
    }

    public function getIdmenu()
    {
        return $this->idmenu;
    }

    public function setIdmenu($idmenu)
    {
        $this->idmenu = $idmenu;
    }

    public function getMenombre()
    {
        return $this->menombre;
    }

    public function setMenombre($menombre)
    {
        $this->menombre = $menombre;
    }

    public function getMedescripcion()
    {
        return $this->medescripcion;
    }

    public function setMedescripcion($medescripcion)
    {
        $this->medescripcion = $medescripcion;
    }

    public function getIdpadre()
    {
        return $this->idpadre;
    }

    public function setIdpadre($idpadre)
    {
        $this->idpadre = $idpadre;
    }

    public function getMedeshabilitado()
    {
        return $this->medeshabilitado;
    }

    public function setMedeshabilitado($medeshabilitado)
    {
        $this->medeshabilitado = $medeshabilitado;
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
