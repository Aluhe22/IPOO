<?php
namespace TP3;
include_once 'Teatro.php';
include_once 'Funciones.php';
class Musical extends Funciones
{
    private $director;
    private $cantPersonas;
    
    public function __construct($nombre,$precio,$horaInicio,$duracion,$director,$cantPersonas){
        parent::__construct($nombre, $precio, $horaInicio, $duracion);
        $this->director=$director;
        $this->cantPersonas=$cantPersonas;
    }
    
    public function getDirector(){
        return $this->director;
    }
    
    public function getCantPersonas(){
        return $this->cantPersonas;
    }
    
    public function setDirector($director){
        $this->director=$director;
    }
    
    public function setCantPersonas($cantPersonas){
        $this->cantPersonas=$cantPersonas;
    }
    
    public function darCosto (){
        $monto = parent::darCosto();
        $total= 0;
        $total += $monto * 0.12;
        return $total;
    }
    
    public function __toString(){
        return parent::__toString()."\nDirector/s: ".$this->getDirector()."\nPersona/s en escena: ".$this->getCantPersonas();
    }
}

