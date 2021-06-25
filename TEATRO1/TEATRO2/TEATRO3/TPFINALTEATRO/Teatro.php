<?php
namespace TPFINALINTENTOTRES;

include_once 'BaseDatos.php';
include_once 'Funciones.php';
include_once 'Obra.php';
include_once 'Musical.php';
include_once 'Cine.php';

class Teatro {
    
    private $idTeatro;
    private $nombre;
    private $direccion;
    private $colFunciones;
    private $mensaje;
    
    public function __construct(){
        
        $this-> idTeatro = 0;
        $this-> nombre= "";
        $this-> direccion = "";
        $this-> colFunciones = array();
    }
    
    public function cargar($idTeatro, $nombre, $direccion){
        
        $this->setIdTeatro($idTeatro);
        $this->setNombre($nombre);
        $this->setDireccion($direccion);
    }
    
    //Metodos de acceso get and set de la clase
    /**
     * @return mixed
     */
    public function getIdTeatro()
    {
        return $this->idTeatro;
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
    public function getDireccion()
    {
        return $this->direccion;
    }
    
    //Obtengo la coleccion de funciones
    
    public function getColFunciones(){
        $funcionesM = new Musical();
        $funcionesC = new Cine();
        $funcionesO = new Obra();
        
        $idteatro =$this->getIdTeatro();
        $cond= "idTeatro=$idteatro";
        
        $musical = $funcionesM->listar($cond);
        $cine = $funcionesC->listar($cond);
        $obra = $funcionesO->listar($cond);
        
        //array_merge es un arreglo de arreglos.
        $funciones = array_merge( $cine, $obra, $musical);
        $this->setColFunciones($funciones);
        return $this->colFunciones;
    }
    /**
     * @return mixed $mensaje
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }
    
    
    /**
     * @param mixed $idTeatro
     */
    public function setIdTeatro($idTeatro)
    {
        $this->idTeatro = $idTeatro;
    }
    
    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    
    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }
    
    /**
     * @param mixed $colFunciones
     */
    public function setColFunciones($colFunciones)
    {
        $this->colFunciones = $colFunciones;
    }
    
    /**
     * @param mixed $mensaje
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }
    
    public function __toString(){
        $funciones= $this->actividades();
        $cadena= "\nInformacion general del Teatro: ".
            "\nId Teatro: ".      $this->getIdTeatro().
            "\nNombre: ".         $this->getNombre().
            "\nDireccion: ".      $this->getDireccion().
            "\n---Actividades--- \n". $funciones;
        return $cadena;
    }
    
    private function actividades(){
        $cadena="";
        $col = $this->getColFunciones();
        foreach ($col as $funcion) {
            $cadena.= $funcion;
        }
        return $cadena;
    }
    
    private function validarFuncion($datos, $objFuncion)
    {
        $horaInicioNueva = $datos['inicio'];//13
        $horaAMinutosNueva = $horaInicioNueva * 60;// si es a las 13*60 =780
        $duracionNueva = $datos['duracion'];//60min
        $horaFinalNueva = ($horaAMinutosNueva + $duracionNueva)/60; //la hora final es 840 y si lo divido por 60 me da la hora final
        
        $horaInicioObjCargado = $objFuncion->getInicio();//14
        $horaAMinutosObjCargado = $objFuncion->getInicio()*60;//14 * 60 = 840
        $duracionObjCargado = $objFuncion->getDuracion();// 60minutos
        $horaFinalObjCargado = ($horaAMinutosObjCargado + $duracionObjCargado)/60; //la hora final del cargado 880
        $existe = false;
        /*$horaFinalObjCargado <= $horaInicioNueva || $horaInicioObjCargado >= $horaFinalNueva*/
        if (($horaInicioNueva <= $horaFinalObjCargado && $horaInicioObjCargado >= $horaInicioNueva )&&
            ($horaInicioNueva >= $horaInicioObjCargado && $horaFinalNueva >=$horaInicioObjCargado)) {
                $existe = true;
        }
        return $existe;
    }
    
    public function agregarFuncion($datosFuncion, $tipo, $id_teatro)
    {   
        $exito = false;
        $coleccionFunciones = $datosFuncion['idTeatro']->getColFunciones();
            $existe = false;
            $i = 0;
            
            while ($i < count($coleccionFunciones) && !$existe) {
                $existe = $this->validarFuncion($datosFuncion, $coleccionFunciones[$i]);
                
                $i++;
            }
            
            if (!$existe) {
                $exito = $this->nuevaActividad($datosFuncion, $tipo);
            }
            
        
        return $exito;
    }
    
    public function nuevaActividad($ArregloDatos,$tipo){
        
        $insertar = false;
        
        if($tipo=="cine"){
            
            $nueva= new Cine();
            
        }elseif($tipo=="musical"){
            $nueva= new Musical();
            
        }elseif($tipo=="obra"){
            
            $nueva= new Obra();
        }
        $nueva->cargar($ArregloDatos);
        $insertar= $nueva->insertar();
        return $insertar;
    }
    
    //-----------------------------------FUNCIONES PRINCIPALES-------------------------------------------
    //-------------------------------------------LISTAR--------------------------------------------------
    public function listar($condicion){
        $arregloTeatro = null;
        $base=new BaseDatos();
        $consultaTeatro="Select * from teatro ";
        if ($condicion!=""){
            $consultaTeatro=$consultaTeatro.' where idTeatro='.$condicion; //pasa un entero
        }
        $consultaTeatro.=" order by direccion ";
        if($base->Iniciar()){
            if($base->Ejecutar($consultaTeatro)){
                $arregloTeatro= array();
                while($row2=$base->Registro()){
                    $idTeatro=$row2['idTeatro'];
                    $nombre=$row2['nombre'];
                    $direccion=$row2['direccion'];
                    
                    $t = new Teatro();
                    $t->cargar($idTeatro, $nombre, $direccion);
                    array_push($arregloTeatro,$t);
                }
            }   else {
                $this->setMensaje($base->getError());
            }
        }   else {
            $this->setMensaje($base->getError());
        }
        return $arregloTeatro;
    }
    
    //-------------------------------------------BUSCAR--------------------------------------------------
    /**
     * Recupera los datos de una teatro por id
     * @param int $id
     * @return true en caso de encontrar los datos, false en caso contrario
     */
    public function Buscar($id){
        $base= new BaseDatos();
        $consultaTeatro="SELECT * FROM teatro WHERE idTeatro=". $id;
        $resp= false;
        //echo "\n".$consultaTeatro."\n";
        if($base->Iniciar()){
            if($base->Ejecutar($consultaTeatro)){
                if($row2=$base->Registro()){
                    //idFuncion,nombre,precio,inicio,duracion,idTeatro
                    $this->setIdTeatro($id);
                    $this->setNombre($row2['nombre']);
                    $this->setDireccion($row2['direccion']);
                    $resp= true;
                }
            }   else {
                $this->setMensaje($base->getError());
            }
        }   else {
            $this->setMensaje($base->getError());
        }
        return $resp;
    }
    
    //-------------------------------------------INSERTAR--------------------------------------------------
    public function insertar(){
        
        $base= new BaseDatos();
        $resp= false;
        $nombre= $this->getNombre();
        $direccion= $this->getDireccion();
        $consultaInsertar="INSERT INTO teatro (nombre, direccion) VALUES ('".$nombre."'". ",'". $direccion. "')";
        
        if($base->Iniciar()){
            if($id = $base->devuelveIDInsercion($consultaInsertar)){
                $this->setIdTeatro($id);
                $resp=  true;
            }   else {
                $this->setMensaje($base->getError());
            }
        } else {
            
            $this->setMensaje($base->getError());
        }
        
        return $resp;
    }
    
    //-------------------------------------------MODIFICAR--------------------------------------------------
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $id= $this->getIdTeatro();
        $consulta="UPDATE teatro SET nombre='".$this->getNombre()."',direccion='".$this->getDireccion()."'
                           WHERE idTeatro='". $this->getIdTeatro()."'";
        
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $resp=  true;
            }else{
                $this->setMensaje($base->getError());
                
            }
        }else{
            $this->setMensaje($base->getError());
            
        }
        return $resp;
    }
    
    //-------------------------------------------ELIMINAR--------------------------------------------------
    
    public function eliminar(){
        $base= new BaseDatos();
        $resp= false;
        if($base->Iniciar()){
            $consultaBorra="DELETE FROM teatro WHERE idTeatro=".$this->getIdTeatro();
            if($base->Ejecutar($consultaBorra)){
                $resp=  true;
            }else{
                $this->setmensajeoperacion($base->getError());
                
            }
        }else{
            $this->setmensajeoperacion($base->getError());
            
        }
        return $resp;
    }
    
    //-----------------------INSERTAR FUNCION-------------------------------
    
    
    public function precioTotal(){
        
        $colFun= $this->getColFunciones();
        $preObra= 0;
        $preMusical = 0;
        $preCine = 0;
        $total=0;
        for($i=0;$i<count($colFun); $i++){
            $precio= $colFun[$i]->darCosto();
            
            if(is_a($precio, 'Cine')){
                $preCine += $precio;
            }
            elseif(is_a($precio, 'Musical')){
                $preMusical += $precio;
            }
            elseif(is_a($precio, 'Obra')){
                $preObra += $precio;
            }
            
        }
        $total += $preCine + $preMusical + $preObra;
        return $total;
    }
    
    public function darCostoTotal($id){
        
        $fun = new Funciones();
        $cond= "idTeatro=$id";
        $ver= $fun->listar($cond);
        $cont=0;
        $pre= 0;
        $indiceFunciones = count($ver);
        
        for ($i = 0; $i < $indiceFunciones; $i++) {
            $pre= $ver[$i]->darCostos();
            $cont += $pre;
            
        }
        return $cont;
    }
    
}
