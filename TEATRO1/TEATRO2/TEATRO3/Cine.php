<?php
namespace TP3;
include_once'Teatro.php';
include_once 'Funciones.php';
class Cine extends Funciones
{
    private $genero;
    private $paisOrigen;
    
    public function __construct($nombre,$precio,$horaInicio,$duracion, $genero, $paisOrigen){
        parent::__construct($nombre, $precio, $horaInicio, $duracion);
        $this->genero=$genero;
        $this->paisOrigen=$paisOrigen;
    }
    
    public function getGenero(){
        return $this->genero;
    }
    
    public function getPaisOrigen(){
        return $this->paisOrigen;
    }
    
    public function setGenero($genero){
        $this->genero=$genero;
    }
    
    public function setPaisOrigen($paisOrigen){
        $this->paisOrigen=$paisOrigen;
    }
    
    public function darCosto (){
        $monto = parent::darCosto();
        $total= 0;
        $total += $monto * 0.65;
        return $total;
    }
    
    public function __toString(){
        return parent::__toString()."\nGenero: ".$this->getGenero()."\nPais de Origen: ".$this->getPaisOrigen()."\n";
    }
}

