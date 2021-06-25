<?php
namespace TPFINALINTENTOTRES;

include_once'BaseDatos.php';
include_once'Teatro.php';

class Funciones
{
    
    private $idFuncion;
    private $nombre;
    private $precio;
    private $inicio;
    private $duracion; //en minutos
    private $objTeatro;
    private $mensajeoperacion;
    
    public function __construct(){
        $this->idFuncion= 0;
        $this->nombre= "";
        $this->precio= "";
        $this->inicio= "";
        $this->duracion= "";
        $this->objTeatro= null;
    }
    
    public function cargar($datosFuncion){
        //$this->setIdFuncion($datosFuncion['id_funcion']);
        $this->setNombre($datosFuncion['nombre']);
        $this->setPrecio($datosFuncion['precio']);
        $this->setInicio($datosFuncion['inicio']);
        $this->setDuracion($datosFuncion['duracion']);
        $this->setObjTeatro($datosFuncion['idTeatro']);
        
    }
    
    //Metodos de acceso get and set de la clase
    public function getObjTeatro()
    {
        return $this->objTeatro;
    }
    public function setObjTeatro($idTeatro)
    {
        $this->objTeatro= $idTeatro;
    }
    /**
     * @return number
     */
    public function getIdFuncion()
    {
        return $this->idFuncion;
    }
    
    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    
    /**
     * @return int
     */
    public function getPrecio()
    {
        return $this->precio;
    }
    
    public function getInicio()
    {
        return $this->inicio;
    }
    
    public function getDuracion()
    {
        return $this->duracion;
    }
    
    /**
     * @return string
     */
    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }
    
    /**
     * @param number $idFuncion
     */
    public function setIdFuncion($idFuncion)
    {
        $this->idFuncion = $idFuncion;
    }
    
    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    
    /**
     * @param int $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    
    /**
     * @param string $inicio
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    }
    
    /**
     * @param string $duracion
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }
    
    
    /**
     * @param string $mensajeoperacion
     */
    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }
    
    public function __toString(){
        $objT =$this->getObjTeatro()->getIdTeatro();
        
        $cadena= "\n--Informacion de Actividad-- ".
            "\nID funcion: ".  $this->getIdFuncion().
            "\nNombre: ".      $this->getNombre().
            "\nPrecio: $".     $this->getPrecio().
            "\nInicio: ".      $this->getInicio().
            "\nDuracion: ".    $this->getDuracion().
            "\nID Teatro: ".   $objT;
        return $cadena;
    }
    public function horaAMinutos()
    {
        $horario = $this->getInicio();
        $min = intval(substr($horario, 0, 2)) * 60;
        $min += intval(substr($horario, 3));
        return $min;
    }
    
    public function calcularHoraFinal()
    {
        $horaFin = $this->horaAMinutos() + $this->getDuracion();
        $horas = (int) ($horaFin / 60);
        $minutos = $horaFin % 60;
        $horas %= 24;
        if ($horas < 10) {
            $horas = "0" . $horas;
        }
        if ($minutos < 10) {
            $minutos = "0" . $minutos;
        }
        $retorno = $horas . ":" . $minutos;
        return $retorno;
    }
    
    //--------------------------------------------DARCOSTO---------------------------------------------------
    public function darCostos()
    {
        return $this->getPrecio();
    }
    
    /**
     * Recupera los datos de una funcion por el id
     * @param int $id
     * @return true en caso de encontrar los datos
     */
     public function Buscar($id){
     $base= new BaseDatos();
     $consultaFuncion="SELECT * FROM funciones WHERE idFuncion=". $id;
     $resp= false;
     if($base->Iniciar()){
     if($base->Ejecutar($consultaFuncion)){
     if($row2=$base->Registro()){
     $objTeatro = new Teatro();
     $objTeatro->Buscar($row2['idTeatro']);
     $this->setIdFuncion($id);
     $this->setNombre($row2['nombre']);
     $this->setPrecio($row2['precio']);
     $this->setInicio($row2['inicio']);
     $this->setDuracion($row2['duracion']);
     $this->setObjTeatro($objTeatro);
     $resp= true;
     }
     }   else {
     $this->setMensajeoperacion($base->getError());
     }
     }   else {
     $this->setMensajeoperacion($base->getError());
     }
     return $resp;
     }
     //-------------------------------------------LISTAR--------------------------------------------------
     
     public function listar($condicion="")
     {
         $arregloFuncion = [];
         $base = new BaseDatos();
         $consultaFunciones = "SELECT * FROM funciones ";
         if ($condicion != "") {
             $consultaFunciones = $consultaFunciones . ' WHERE ' . $condicion;
         }
         $consultaFunciones .= " ORDER BY nombre";
         if ($base->Iniciar()) {
             if ($base->Ejecutar($consultaFunciones)) {
                 $arregloFuncion = array();
                 while ($row2 = $base->Registro()) {
                     $funcion = new Funciones();
                     $funcion->Buscar($row2['idFuncion']);
                     array_push($arregloFuncion, $funcion);
                 }
             } else {
                 $this->setMensajeoperacion($base->getError());
             }
         } else {
             $this->setMensajeoperacion($base->getError());
         }
         return $arregloFuncion;
     }
     
     public function insertar(){
         $base = new BaseDatos();
         $resp= false;
         $idTeatro = $this->getObjTeatro()->getIdTeatro();
         $consultaInsertar="INSERT INTO funciones (nombre, precio, inicio, duracion, idTeatro)
                VALUES ('".$this->getNombre()."',".$this->getPrecio().
                ",".$this->getInicio().",".$this->getDuracion().",".$idTeatro.")";
         if($base->Iniciar()){
             if($id = $base->devuelveIDInsercion($consultaInsertar)){
                 $this->setIdFuncion($id);
                 $resp=  true;
             }   else {
                 $this->setMensajeoperacion($base->getError());
             }
         } else {
             $this->setMensajeoperacion($base->getError());
         }
         return $resp;
     }
     
     /**
      * @param
      * @return boolean $resp
      */
     public function modificar(){
         $resp = false;
         $base = new BaseDatos();
         $consultaModifica = "UPDATE funciones SET nombre=" . "'" . $this->getNombre() . "',inicio=" . $this->getInicio() . "
                           ,duracion=" . $this->getDuracion() . ",precio=" . $this->getPrecio() ."
                         ,idTeatro=" . $this->getObjTeatro()->getIdTeatro() . " WHERE idFuncion=" .  $this->getIdFuncion();
         if ($base->Iniciar()) {
             if ($base->Ejecutar($consultaModifica)) {
                 $resp =  true;
             } else {
                 $this->setmensajeoperacion($base->getError());
             }
         } else {
             $this->setmensajeoperacion($base->getError());
         }
         return $resp;
     }
     
     public function eliminar($id){
         $base= new BaseDatos();
         $resp= false;
         if($base->Iniciar()){
             $consultaBorra="DELETE FROM funciones WHERE idFuncion=".$id;
             
             if($base->Ejecutar($consultaBorra)){
                 $resp=  true;
             }else{
                 $this->setMensajeoperacion($base->getError());
                 
             }
         }else{
             $this->setMensajeoperacion($base->getError());
             
         }
         return $resp;
     }
     
     
}

