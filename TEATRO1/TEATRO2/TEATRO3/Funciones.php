<?php
namespace TP3;
include_once('Teatro.php');
class Funciones
{
    private $nombre;
    private $precio;
    private $horaInicio;
    private $duracion;
    
    /**
     * @param string $nombre
     * @param double $precio
     * @param string $horaInicio
     * @param string $duracion
     **/
    public function __construct($nombre,$precio,$horaInicio,$duracion){
        $this->nombre=$nombre;
        $this->precio=$duracion;
        $this->duracion=$duracion;
        $this->horaInicio=$horaInicio;
    }
    /**
     * @return string $nombre
     **/
    public function get_nombre(){
        return $this->nombre;
    }
    /**
     * @return double $precio
     **/
    public function get_precio(){
        return $this->precio;
    }
    /**
     * @return string $horaInicio
     **/
    public function get_horaInicio(){
        return $this->horaInicio;
    }
    /**
     * @return string $duracion
     **/
    public function get_duracion(){
        return $this->duracion;
    }
    
    /**
     * @param string $nombreTeatro
     **/
    public function set_nombre($nombre){
        $this->nombre=$nombre;
    }
    /**
     * @param double $precio
     **/
    public function set_precio($precio){
        $this->precio=$precio;
    }
    /**
     * @param string $horaInicio
     **/
    public function set_horaInicio($horaInicio){
        $this->horaInicio=$horaInicio;
    }
    /**
     * @param string $duracion
     **/
    public function set_duracion($duracion){
        $this->duracion=$duracion;
    }
    
    public function darCosto(){
        $total = 0;
            $precio = $this->get_precio();
            $total += $precio;
        
            return $total;
    }
    
    /**
     * @return string $cadena
     **/
    public function __toString(){
        return "\nNombre: ".$this->get_nombre()."\nPrecio:$".$this->get_precio()."\nHora Inicio: ".$this->get_horaInicio()."\nDuracion: ".$this->get_duracion();
    }
}
