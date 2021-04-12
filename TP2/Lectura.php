<?php
/*4. Se desea implementar una clase Lectura que almacena información sobre la lectura de un determinado libro. 
Esta clase tiene como variable instancia un referencia a un objeto Libro y el número de la página que se esta 
leyendo. Por otro lado la clase contiene los siguientes métodos: 
a) Método constructor _ _construct() que recibe como parámetros los valores iniciales para los atributos 
de la clase. 
b) Los métodos de acceso de cada uno de los atributos de la clase. 
c) siguientePagina(): método que retorna la página del libro y actualiza la variable que contiene la 
pagina actual. 
d) retrocederPagina(): método que retorna la página anterior a la actual del libro y actualiza su valor. 
e) irPagina(x): método que retorna la página actual y setea como página actual al valor recibido por 
parámetro. 
f) Redefinir el método _ _toString() para que retorne la información de los atributos de la clase. 
g) Crear un script Test_Lectura que cree un objeto Lectura e invoque a cada uno de los métodos 
implementados. */
include 'Libro.php';
class Lectura
{
    private $refLibro;
    private $numPag;
    
    public function __construct($objLibro,$numPagina){
        $this->refLibro=$objLibro;
        $this->numPag=$numPagina;
        
    }
    /**
     * @return mixed
     */
    public function getRefLibro()
    {
        return $this->refLibro;
    }

    /**
     * @return mixed
     */
    public function getNumPag()
    {
        return $this->numPag;
    }

    /**
     * @param mixed $refLibro
     */
    public function setRefLibro($refLibro)
    {
        $this->refLibro = $refLibro;
    }

    /**
     * @param mixed $numPag
     */
    public function setNumPag($numPag)
    {
        $this->numPag = $numPag;
    }
    
    public function siguientePagina(){
        $libro = $this->getRefLibro();
        $totalPaginas = $libro->getCantPaginas();
        $pagActual = $this->getNumPag();
        if ($pagActual < $totalPaginas) {
            $pagSiguiente = $pagActual+1;
            $this->setNumPag($pagSiguiente);
        }
        return $this->getNumPag();
    }
    
    public function retrocederPagina(){
        $libro = $this->getRefLibro();
        $totalPaginas = $libro->getCantPaginas();
        $pagActual = $this->getNumPag();
        if ($pagActual < $totalPaginas && $pagActual > 0) {
            $pagAnterior = $pagActual-1;
            $this->setNumPag($pagAnterior);
        }
        return $this->getNumPag();
        
    }
    
    public function irPagina($num){
        $libro = $this->getRefLibro();
        $totalPaginas = $libro->getCantPaginas();
        
        if ($num >= $totalPaginas && $num <= $totalPaginas) {
            $nuevo = $num;
            $this->setNumPag($nuevo);
        }
        return $this->getNumPag();
    }
    
    public function __toString(){
        $objLibro = $this->getRefLibro();
        return "\nISBN:\n".$objLibro->getISBN()."\nTitulo: ".$objLibro->getTitulo()."\nAño de Edicion: "
            .$objLibro->getAnioEdicion()."\nEditorial: ".$objLibro->getEditorial()."\nCantidad de Paginas: "
                .$objLibro->getCantPaginas()."\nSinopsis: ".$objLibro->getSinopsis()."\nPaginas leidas actualmente: ".$this->getNumPag()."\n";
    }
}

