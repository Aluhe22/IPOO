<?php

class Cafetera{
    
    private $capacidadMaxima ;	#la cantidad máxima de café que puede contener la cafetera
    private $cantidadActual;	#la cantidad actual de café que hay en la cafetera
    
    public function __construct($capacidadMaxima,$cantidadActual){
        $this->capacidadMaxima=$capacidadMaxima;
        $this->cantidadActual=$cantidadActual;
        
    }
    
    public function setcapacidadMaxima($capacidadMaxima){
        $this->capacidadMaxima=$capacidadMaxima;
    }
    public function setcantidadActual($cantidadActual){
        $this->cantidadActual=$cantidadActual;
    }
    
    public function getcapacidadMaxima(){
        return $this->capacidadMaxima;
    }
    public function getcantidadActual(){
        return $this->cantidadActual;
    }
    
    # la cantidad actual debe ser igual a la capacidad de la cafetera
    public function llenarCafetera($capacidadMaxima,$cantidadActual){
        if ($this->getcantidadActual() == $this->getcapacidadMaxima()){
            $resultado=true;
        }elseif($this->getcantidadActual() < $this->getcapacidadMaxima()){
            $faltante=$this->getcapacidadMaxima() - $this->getcantidadActual();
            $resultado=$this->getcantidadActual()+$faltante;
        }
        return $resultado;
    }
    
    public function servirTaza($cantidad){
        if ($this->getcantidadActual() >= $cantidad){
            $resultado=true;
        }elseif($this->getcantidadActual() < $cantidad){
            $servido=$cantidad - $this->getcantidadActual();
            $resultado= "No se pudo llenar la taza de cafe, solo se pudo servir ". $servido;
        }
        return $resultado;
    }
    
    
    public function vaciarCafetera(){
       /* if($this->getcantidadActual() > 0){
            $restado=$this->getcantidadActual() - $this->getcantidadActual();
            $cantidadActual=setcantidadActual($restado);
        }*/
        if($this->getcantidadActual()>0){
            
            $this->setcantidadActual(0);
            $resp = true;
        }else {
            $resp = false;
        }
        return $resp;
    }
    
    
    public function agregarCafe($cantidad){
        if($this->getcantidadActual() > $this->getcapacidadMaxima()){
            $Aagregar=$this->getcapacidadMaxima() - $this->getcantidadActual() ;
            $completar=  $this->getcantidadActual() + $Aagregar;
            $cantidadActual=$this->setcantidadActual($completar);
        }
        
    }
    
    public function __toString(){
        $cadena= "La capacidad ocupada en este momento por la cafetera es: ".$this->getcantidadActual()."\n";
        "La capacidad maxima de la cafetera es:" .$this->getcapacidadMaxima()."\n";
        return $cadena;
        
    }
    
    
}




?>
