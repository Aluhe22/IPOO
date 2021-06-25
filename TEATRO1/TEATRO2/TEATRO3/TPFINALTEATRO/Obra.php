<?php
namespace TPFINALINTENTOTRES;


include_once 'BaseDatos.php';
include_once 'Funciones.php';

class Obra extends Funciones{
    
    private $autor;
    
    public function __construct(){
        parent::__construct();
        
        $this-> autor = "";
    }
    
    public function cargar($datosFuncion){
        parent::cargar($datosFuncion);
        
        $this->setAutor($datosFuncion['autor']);
        
    }
    
    //Metodos de acceso get and set de la clase
    
    /**
     * @return string
     */
    public function getAutor()
    {
        return $this->autor;
    }
    
    /**
     * @param string $autor
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;
    }
    
    
    public function __toString(){
        $cadena= parent::__toString();
        $cadena.= "\nAutor: ". $this->getAutor();
        return $cadena;
    }
    
    
    //--------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------
    
    /*Si es una obra de teatro: 45%
     */
    
    public function darCostos()
    {
        $costo = parent::darCostos();
        $costo += $costo * 0.45;
    }
    
    //--------------------------------FUNCIONES PRINCIPALES---------------------------------------------------
    //--------------------------------------BUSCAR------------------------------------------------------------
    public function Buscar($idObra){
        $base=new BaseDatos();
        $consulta="Select * from obra where idFuncion=".$idObra;
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                if($row2=$base->Registro()){
                    parent::Buscar($idObra);
                    $this->setAutor($row2['autor']);
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
    
    //-----------------------------------------LISTAR----------------------------------------------------------
    
    public function listar($condicion=""){
        $arreglo = null;
        $base=new BaseDatos();
        $consulta="SELECT * FROM obra INNER JOIN funciones ON obra.idFuncion = funciones.idFuncion ";
        if ($condicion!=""){
            $consulta=$consulta.' where funciones.'.$condicion;
        }
        $consulta.=" order by autor";
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $arreglo= array();
                while($row2=$base->Registro()){
                    $obj=new Obra();
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
    
    
    //----------------------------------------INSERTAR--------------------------------------------------------
    
    public function insertar(){
        $base=new BaseDatos();
        $resp= false;
        if(parent::insertar()){
            $consultaInsertar="INSERT INTO obra (idFuncion, autor) VALUES (".parent::getIdFuncion().",'".$this->getAutor()."')";
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
    
    //----------------------------------------MODIFICAR-------------------------------------------------------
    
    public function modificar(){
        $resp =false;
        $base=new BaseDatos();
        if(parent::modificar()){
            $consultaModifica="UPDATE obra SET autor ='".$this->getAutor()."' WHERE idFuncion=". parent::getIdFuncion();
            //echo "\n". $consultaModifica;
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
    
    //----------------------------------------ELIMINAR-------------------------------------------------------
    
    public function eliminar($id){
        $base=new BaseDatos();
        $resp=false;
        if($base->Iniciar()){
            $consultaBorra="DELETE FROM obra WHERE idFuncion=".parent::getIdFuncion();
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
