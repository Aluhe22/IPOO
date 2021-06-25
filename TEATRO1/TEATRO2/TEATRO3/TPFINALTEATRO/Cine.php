<?php
namespace TPFINALINTENTOTRES;

include_once 'BaseDatos.php';
include_once 'Funciones.php';

class Cine extends Funciones{
    
    private $genero;
    private $nacionalidad;
    
    public function __construct(){
        parent::__construct();
        $this->genero= "";
        $this->nacionalidad= "";
    }
    
    public function cargar($datosFuncion){
        parent::cargar($datosFuncion);
        
        $this->setGenero($datosFuncion['genero']);
        $this->setNacionalidad($datosFuncion['nacionalidad']);
        
    }
    
    //metodos de acceso get and set de la clase
    
    public function getGenero() {
        return $this->genero;
    }
    public function getNacionalidad() {
        return $this->nacionalidad;
    }
    public function setGenero($genero) {
        $this->genero = $genero;
    }
    public function setNacionalidad($nacionalidad){
        $this->nacionalidad = $nacionalidad;
    }
    
    public function __toString(){
        $cadena= parent::__toString()."\n Genero: ". $this->getGenero().
        "\n Nacionalidad: ". $this->getNacionalidad();
        
        return $cadena;
    }
    
    //--------------------------------FUNCIONES PRINCIPALES-------------------------------------------------
    //----------------------------------------BUSCAR--------------------------------------------------------
    
    public function Buscar($idCine){
        $base=new BaseDatos;
        $consulta="Select * from cine where idFuncion=".$idCine;
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                if($row2=$base->Registro()){
                    parent::Buscar($idCine);
                    $this->setGenero($row2['genero']);
                    $this->setNacionalidad($row2['nacionalidad']);
                    $resp= true;
                }
                
            }   else {
                $this->setMensajeoperacion($base->getError());
                
            }
        }  else {
            $this->setMensajeoperacion($base->getError());
            
        }
        return $resp;
    }
    
    //--------------------------------------------LISTAR------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------
    
    public function listar($condicion=""){
        $arreglo = null;
        $base= new BaseDatos();
        
        $consulta="SELECT * FROM cine INNER JOIN funciones ON cine.idFuncion = funciones.idFuncion";
        if ($condicion!=""){
            $consulta=$consulta.' where funciones.'.$condicion;
        }
        $consulta.=" order by genero ";
        
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $arreglo= array();
                while($row2=$base->Registro()){
                    $obj=new Cine();
                    $obj->Buscar($row2['idFuncion']);
                    array_push($arreglo,$obj);
                }
            }   else {
                $this->setMensajeoperacion($base->getError());
            }
        }  else {
            $this->setMensajeoperacion($base->getError());
        }
        return $arreglo;
    }
    
    //------------------------------------------INSERTAR-------------------------------------------------------
    public function insertar(){
        $base=new BaseDatos();
        $resp= false;
        
        if(parent::insertar()){
            $consultaInsertar="INSERT INTO cine(idFuncion,genero, nacionalidad)
                VALUES (".parent::getIdFuncion().",'".$this->getGenero()."','".$this->getNacionalidad()."')";
            
            if($base->Iniciar()){
                if($base->Ejecutar($consultaInsertar)){
                    $resp=  true;
                }   else {
                    $this->setMensajeoperacion($base->getError());
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        }
        return $resp;
    }
    
    //-----------------------------------------MODIFICAR-----------------------------------------------------
    
    public function modificar(){
        $resp =false;
        $base=new BaseDatos();
        if(parent::modificar()){
            $consultaModifica="UPDATE cine SET genero='".$this->getGenero()."', nacionalidad='".$this->getNacionalidad().
            "'WHERE idFuncion=". parent::getIdFuncion();
            
            if($base->Iniciar()){
                if($base->Ejecutar($consultaModifica)){
                    $resp=  true;
                }else{
                    $this->setMensajeoperacion($base->getError());
                }
            }else{
                $this->setMensajeoperacion($base->getError());
                
            }
        }
        
        return $resp;
    }
    
    //-----------------------------------------ELIMINAR-------------------------------------------------------
    
    public function eliminar($id){
        $base=new BaseDatos();
        $resp=false;
        if($base->Iniciar()){
            $consultaBorra="DELETE FROM cine WHERE idFuncion=".parent::getIdFuncion();
            if($base->Ejecutar($consultaBorra)){
                if(parent::eliminar($id)){
                    $resp=  true;
                }
            }else{
                $this->setMensajeoperacion($base->getError());
                
            }
        }else{
            $this->setMensajeoperacion($base->getError());
            
        }
        return $resp;
    }
    
    
    //-------------------------------------------------------------------------------------------------------
    //--------------------------------------------DARCOSTO---------------------------------------------------
    /*
     Si es un pelicula: 65%.
     */
    public function darCostos()
    {
        $costo = parent::darCostos();
        $costo += $costo * 0.65;
        return $costo;
    }
    
    
}


