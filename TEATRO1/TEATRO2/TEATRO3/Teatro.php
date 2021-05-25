<?php
namespace TP3;
class Teatro
{
    private $nombreActividad;
    private $direccion;
    private $arregloFunciones;
    
    /**constructor
     * @param string $nombreTeatro
     * @param string $direccion
     * @param array $arregloFunciones
     **/
    public function __construct($nombreActividad, $direccion, $arregloFunciones){
        $this ->nombreActividad = $nombreActividad;
        $this ->direccion = $direccion;
        $this ->arregloFunciones = $arregloFunciones;
    }
    /**
     * @return string $nombreTeatro
     **/
    public function get_nombreActividad(){
        return $this->nombreActividad;
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
    public function set_nombreActividad($nombre){
        $this->nombreActividad = $nombre;
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
    
    /** 
     * el método darCostos, el cual determina según las actividades del teatro cuál
debería ser el cobro obtenido. Para obtener el mismo, hay que tener en cuenta que se deben sumar los precios
de cada tipo de actividad programada para un mes dado, y aplicar un incremento por actividad según se
detalle:
8.1. Si es una obra de teatro: 45%
8.2. Si es un musical: 12%
8.3. Si es un película: 65%.
**/
    
    public function darCosto(){
        $arrayFunciones = $this->get_arregloFunciones();
        $total=0;
        for ($i = 0; $i < count($arrayFunciones); $i++) {
            $unaFuncion = $arrayFunciones[$i];
            $total += $unaFuncion->darCosto();
        }
        $total = $total * 100;//PARA QUE me DE UN ENTERO
        return $total;
    }
    
    /**Construye una cadena de las funciones
     * @return array $cFunciones
     **/
    private function armarCadenaArrayFunciones (){
        $cadena="";
        $colFunciones=$this->get_arregloFunciones();
        foreach ($colFunciones as $indice => $funcion)
        {
            $j= $indice+1;
            $cadena= $cadena."\nLa Funcion ".$j." es:\n".$funcion;
        }
        return $cadena;
    }
    
    public function __unset($i){
        unset($this->arregloFunciones[$i]);
    }
    
    /**
     * @return string $direccion
     **/
    public function __toString(){
        $caFuncion=$this->armarCadenaArrayFunciones();
        $cadena = "Nombre de Actividad: ". $this-> get_nombreActividad().
        "\nDireccion: ". $this-> get_direccion().
        "\n".($caFuncion==""?
            "No hay funciones. ": "Funciones\n".$caFuncion);
        return $cadena;
    }
}
