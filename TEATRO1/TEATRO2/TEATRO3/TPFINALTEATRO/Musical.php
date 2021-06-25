<?php
namespace TPFINALINTENTOTRES;

include_once 'BaseDatos.php';
include_once 'Funciones.php';

class Musical extends Funciones{
    
    private $director;
    private $actores;
    
    
    public function __construct(){
        parent::__construct();
        
        $this-> director= "";
        $this-> actores = "";
        
    }
    public function cargar($datosFuncion){
        parent::cargar($datosFuncion);
        
        $this->setDirector($datosFuncion['director']);
        $this->setActores($datosFuncion['actores']);
        
    }
    
    //Metodos de acceso get and set de la clase
    /**
     * @return mixed
     */
    public function getDirector()
    {
        return $this->director;
    }
    
    /**
     * @return mixed
     */
    public function getActores()
    {
        return $this->actores;
    }
    
    
    /**
     * @param mixed $director
     */
    public function setDirector($director)
    {
        $this->director = $director;
    }
    
    /**
     * @param mixed $actores
     */
    public function setActores($actores)
    {
        $this->actores = $actores;
    }
    
    
    
    public function __toString(){
        
        $cadena= parent::__toString();
        $cadena.= "\n Director: ". $this->getDirector().
        "\n Actores: ". $this->getActores();
        return $cadena;
    }
    
    //--------------------------------------------DARCOSTO---------------------------------------------------
    /*
     Si es un musical: 12%
     */
    
    public function darCostos()
    {
        $costo = parent::darCostos();
        $costo += $costo * 0.12;
        return $costo;
    }
    
    //--------------------------------FUNCIONES PRINCIPALES---------------------------------------------------
    //--------------------------------------BUSCAR------------------------------------------------------------
    
    public function Buscar($idMusical){
        $base=new BaseDatos();
        $consulta="SELECT * FROM musical WHERE idFuncion=".$idMusical;
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                if($row2=$base->Registro()){
                    parent::Buscar($idMusical);
                    $this->setDirector($row2['director']);
                    $this->setActores($row2['actores']);
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
    
    //--------------------------------------Listar------------------------------------------------------------
    public function listar($condicion=""){
        
        $arreglo = null;
        $base=new BaseDatos();
        $consulta=" SELECT * FROM musical INNER JOIN funciones ON musical.idFuncion = funciones.idFuncion";
        if ($condicion!=""){
            $consulta=$consulta.' where funciones.'.$condicion;
        }
        $consulta.=" order by director ";
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $arreglo= array();
                while($row2=$base->Registro()){
                    $obj=new Musical();
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
    
    //--------------------------------------INSERTAR------------------------------------------------------------
    
    public function insertar(){
        $base=new BaseDatos();
        $resp= false;
        
        if(parent::insertar()){
            $consultaInsertar="INSERT INTO musical(idFuncion, director, actores)
                VALUES (".parent::getIdFuncion().",'".$this->getDirector()."',".$this->getActores().")";
            
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
    
    //--------------------------------------MODIFICAR---------------------------------------------------------
    
    public function modificar(){
        $resp =false;
        $base=new BaseDatos();
        if(parent::modificar()){
            $consultaModifica="UPDATE musical SET director='".$this->getDirector()."', actores=".$this->getActores().
            " WHERE idFuncion=". parent::getIdFuncion();
            echo "\n". $consultaModifica;
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
    
    //--------------------------------------ELIMINAR----------------------------------------------------------
    public function eliminar($id){
        $base=new BaseDatos();
        $resp=false;
        if($base->Iniciar()){
            $consultaBorra="DELETE FROM musical WHERE idFuncion=".parent::getIdFuncion();
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
    
    
    
    
}   

