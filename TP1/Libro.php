<?php
namespace TP1;

class Libro
{
    private $ISBN;
    private $titulo;
    private $anioEdicion;
    private $editorial;
    private $nombreAutor;
    private $apellidoAutor;
    private $parreglo;

    public function __construct($ISBN,$titulo,$anioEdicion,$editorial,$nombreAutor,$apellidoAutor,$libro0, $libro1, $libro2, $libro3){
        
        $this->ISBN=$ISBN;
        $this->titulo=$titulo;
        $this->anioEdicion=$anioEdicion;
        $this->editorial=$editorial;
        $this->nombreAutor=$nombreAutor;
        $this->apellidoAutor=$apellidoAutor;
        
        $this->parreglo = array( $libro1, $libro2, $libro3);
        $this->arregloautor=array();
        
    }
    /**
     * @return mixed
     */
    public function getISBN()
    {
        return $this->ISBN;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @return mixed
     */
    public function getAnioEdicion()
    {
        return $this->anioEdicion;
    }

    /**
     * @return mixed
     */
    public function getEditorial()
    {
        return $this->editorial;
    }

    /**
     * @return mixed
     */
    public function getNombreAutor()
    {
        return $this->nombreAutor;
    }

    /**
     * @return mixed
     */
    public function getApellidoAutor()
    {
        return $this->apellidoAutor;
    }

    /**
     * @return multitype:unknown 
     */
    public function getparreglo()
    {
        return $this->libros;
    }

    /**
     * @param mixed $ISBN
     */
    public function setISBN($ISBN)
    {
        $this->ISBN = $ISBN;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @param mixed $anioEdicion
     */
    public function setAnioEdicion($anioEdicion)
    {
        $this->anioEdicion = $anioEdicion;
    }

    /**
     * @param mixed $editorial
     */
    public function setEditorial($editorial)
    {
        $this->editorial = $editorial;
    }

    /**
     * @param mixed $nombreAutor
     */
    public function setNombreAutor($nombreAutor)
    {
        $this->nombreAutor = $nombreAutor;
    }

    /**
     * @param mixed $apellidoAutor
     */
    public function setApellidoAutor($apellidoAutor)
    {
        $this->apellidoAutor = $apellidoAutor;
    }

    /**
     * @param multitype:unknown  $parreglo
     */
    public function setparreglo($libro1,$libro2,$libro3)
    {
        $this->parreglo[0]=$libro1;
        $this->parreglo[1]=$libro2;
        $this->parreglo[2]=$libro3;
    }
    
    public function setlibro ($libro, $pos){
        $this->libros[$pos] = $libro;
    }
    
    public function getlibro($pos){
        return $this->parreglo[$pos];
    }
    
    private function setarregloautor($arregloautor){
        $this->arregloautor = $arregloautor;
    }
    
    private function getarregloautor(){
        return $this->arregloautor;
    }
    
    public function __toString(){
        return "\nCodigo ISBN: ".$this->getISBN()."\nTitulo: ".$this->getTitulo()."\nAño de Edicion: ".$this->getAnioEdicion()."\nEditorial: "-$this->getEditorial()."\nNombre del autor: ".$this->getNombreAutor()."\nApellido del autor".$this->getApellidoAutor()."\n";
    }
    
    public function perteneceEditorial ($perteneceEdito){
        $resultado = false;
        if ($this->getEditorial()== $perteneceEdito){
            $resultado = true;
        }
        
        return $resultado;
    }
    
    public function iguales($plibro,$parreglo){
        $cantidadLibros = count($parreglo);
        $encontrado = false;
        $i = 0;
        while ($i<$cantidadLibros && !$encontrado) {
            $encontrado = $plibro->gettitulo()==$parreglo[$i]->gettitulo();
            $i++;
        }
        
        return $encontrado;
    }
    
    public function aniosdesdeEdicion(){
        $anioactual=date("Y");
        $anios=$anioactual-($this->getEditorial());
        return $anios;
    }
    public function librodeEditoriales($arregloautor, $peditorial){
        for($i=0 ; $i < count($arregloautor); $i++){
            if($peditorial == $this->getEditorial()){
                $a = $this->getarregloautor();
                array_push($a,$this->gettitulo());
            }
        }
    }
    

}

