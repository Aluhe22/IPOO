<?php
class Teatro{
    private $nombreTeatro;
    private $direccion;
    private $arregloFunciones;
    
    public function __construct($nombreTeatro, $direccion, $arregloFunciones){
        $this ->nombreTeatro = $nombreTeatro;
        $this ->direccion = $direccion;
        $this ->arregloFunciones = $arregloFunciones;
    }
    /**
     * @return string $nombreTeatro
     **/
    public function get_nombreTeatro(){
        return $this->nombreTeatro;
    }
    /**
     * @return string $direccion
     **/
    public function get_direccion(){
        return $this->direccion;
    }
    /**
     * @return array $arregloFunciones
     **/
    public function get_arregloFunciones(){
        return $this->arregloFunciones;
    }
    /**
     * @param string $nombreTeatro
     **/
    public function set_nombreTeatro($nombreTeatro){
        $this->nombreTeatro = $nombreTeatro;
    }
    /**
     * @param string $direccion
     **/
    public function set_direccion($direccion){
        $this->direccion = $direccion;
    }
    /**
     * @param array $arregloFunciones
     **/
    public function set_arregloFunciones($arregloFunciones){
        $this ->arregloFunciones = $arregloFunciones;
    }
    
    /**Construye una cadena de las funciones
     * @return array $cFunciones
     **/
    private function armarCadenaArrayFunciones (){
        $aFunciones= $this->get_arregloFunciones();
        $indice=count($aFunciones);
        $cFunciones= "";
        for ($i=0;$i<$indice; $i++){
            $nroFuncion=$i+1;
            $cFunciones= $cFunciones. " ".$nroFuncion.
            " Nombre: ". $aFunciones[$i]["nombre"].
            "- Precio: $".$aFunciones[$i]["precio"].
            "- Hora inicio: ".$aFunciones[$i]["hora inicio"].
            "- Duracion: ".$aFunciones[$i]["duracion"]."\n";
            
        }
        
        return $cFunciones;
    }
    /**Modifica una funcion del arreglo funciones
     * @param string $nombreFuncion
     * @param string $nombreNuevo
     * @param double $precioNuevo
     * @param string $horaInicio
     * @param string $duracion
     * @return boolean $resp
     **/
    public function modificaFuncion($nombreFuncion,$nombreNuevo,$precioNuevo,$horaInicio, $duracion){
        $i=0;
        $resp=false;
        $colFuncion = $this->get_arregloFunciones();
        $indice=count($colFuncion);
        while($i< $indice && !$resp){
            $unaFuncion = $colFuncion[$i];
            if($unaFuncion["nombre"]==$nombreFuncion){
                $unaFuncion["nombre"]=$nombreNuevo;
                $unaFuncion["precio"]=$precioNuevo;
                $unaFuncion["hora inicio"]=$horaInicio;
                $unaFuncion["duracion"]=$duracion;
                $colFuncion[$nroFuncion] = $unaFuncion;
                $colFuncion[$i] = $unaFuncion;
                $resp=true;
            }
            $i++;
        }
        $this->set_arregloFunciones($colFunction);
        return $resp;
    }
    /**
     * @return string $direccion
     **/
    public function __toString(){
        $caFuncion=$this->armarCadenaArrayFunciones();
        $cadenaTeatro = "Teatro: ". $this-> get_nombreTeatro().
        "\nDireccion: ". $this-> get_direccion().
        "\n".($caFuncion==""?
            "No hay funciones. ": "Funciones\n".$caFuncion);
        return $cadenaTeatro;
    }
    
}


?>
