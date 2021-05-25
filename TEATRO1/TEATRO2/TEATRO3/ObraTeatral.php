<?php
namespace TP3;
include_once 'Funciones.php';
class ObraTeatral extends Funciones
{
    
    public function __construct($nombre,$precio,$horaInicio,$duracion){
        parent::__construct($nombre,$precio,$horaInicio,$duracion);
    }
    
    public function darCosto (){
        $monto = parent::darCosto();
        $total= 0;
        $total += $monto * 0.45;
        return $total;
    }
    
    
    public function __toString(){
        return parent::__toString();
    }
}
