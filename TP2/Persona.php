<?php
namespace TP2;
/*1. Implementar una clase Persona con los atributos: nombre, apellido, tipo y número de documento. 
a) Defina en la clase los siguientes métodos: 
1. Método constructor _ _construct() que recibe como parámetros los valores iniciales para los 
atributos de la clase. 
2. Los métodos de acceso de cada uno de los atributos de la clase. 
3. Redefinir el método _ _toString() para que retorne la información de los atributos de la clase. 
4. Crear un script Test_Persona que cree un objeto Persona e invoque a cada uno de los 
métodos implementados. */
class Persona
{
    private $nombre;
    private $apellido;
    private $tipo;
    private $nrodocumento;
   
    public function __construct($nom,$ape,$tipo,$nrod){
        $this->nombre=$nom;
        $this->apellido=$ape;
        $this->tipo=$tipo;
        $this->nrodocumento=$nrod;
    }
    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @return mixed
     */
    public function getNrodocumento()
    {
        return $this->nrodocumento;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @param mixed $nrodocumento
     */
    public function setNrodocumento($nrodocumento)
    {
        $this->nrodocumento = $nrodocumento;
    }
    
    public function __toString(){
        return "\nNombre: ".$this->getNombre()."\nApellido: ".$this->getApellido()."\n".$this->getTipo()." ".$this->getNrodocumento()."\n";
    }

}

