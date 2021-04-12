<?php
/*
2. Implementar una clase Disquera con los atributos: hora_desde y hora_hasta (que indican el horario de 
atención de la tienda), estado (abierta o cerrada), dirección y dueño. El atributo dueño debe referenciar a un 
objeto de la clase Persona implementada en el punto 1. Defina en la clase los siguientes métodos: 
a) Método constructor _ _construct () que recibe como parámetros los valores iniciales para los atributos 
de la clase. 
b) Los métodos de acceso de cada uno de los atributos de la clase. 
c) dentroHorarioAtencion($hora,$minutos): que dada una hora y minutos retorna true si la tienda debe 
encontrarse abierta en ese horario y false en caso contrario. 
d) abrirDisquera($hora,$minutos): que dada una hora y minutos corrobora que se encuentra dentro del 
horario de atención y cambia el estado de la disquera solo si es un horario válido para su apertura. 
e) cerrarDisquera($hora,$minutos): que dada una hora y minutos corrobora que se encuentra fuera del 
horario de atención y cambia el estado de la disquera solo si es un horario válido para su cierre. 
f) Redefinir el método _ _toString() para que retorne la información de los atributos de la clase. 
g) Crear un script Test_Disquera que cree un objeto Disquera e invoque a cada uno de los métodos 
implementados.*/
class Disquera{
    //Atributos
    private $hora_desde;
    private $hora_hasta;
    private $estado;
    private $direccion;
    
    public function __construct($horaDesde, $horaHasta, $estado , $dire, $persona){
        $this -> hora_desde = $horaDesde;
        $this -> hora_hasta = $horaHasta;
        $this -> estado = $estado;
        $this -> direccion = $dire;
        $this -> objPersona = $persona;
    }
    
    public function getHoraDesde() {
        return $this -> hora_desde;
    }
    
    public function getHoraHasta() {
        return $this -> hora_hasta;
    }
    
    public function getEstado() {
        return $this -> estado;
    }
    
    public function getDireccion() {
        return $this -> direccion;
    }
    
    public function getObjPersona() {
        return $this -> objPersona;
    }
    public function setHoraDesde($horaDesde) {
        $this -> hora_desde = $horaDesde;
    }
    
    public function setHoraHasta($horaHasta) {
        $this -> hora_hasta = $horaHasta;
    }
    
    public function setEstado($estado) {
        $this -> estado = $estado;
    }
    
    public function setDireccion($dire) {
        $this -> direccion = $dire;
    }
    
    public function setObjPersona($persona) {
        $this -> objPersona = $persona;
    }
    
    public function dentroHorarioAtencion($hora) {
        $retorno = false;
        if(($hora >= $this -> getHoraDesde()) && ($hora <= $this -> getHoraHasta())) {
            $retorno = true;
        }
        return $retorno;
    }
    
    public function abrirDisquera($hora) {
        if($hora = $this -> setHoraDesde($hora)) {
            $this -> getEstado("Abierto");
        }
    }
    
    public function cerrarDisquera($hora){
        if($hora = $this -> setHoraHasta($hora)) {
            $this -> getEstado("Cerrado");
        }
    }
    
    public function __toString() {
        return "La disquera abre desde las ".$this->getHoraDesde()." hs y cierra ".$this->getHoraHasta()." hs\n".
            "Actualmente se encuentra ".$this->getEstado()."\n"."Ubicada en la calle ".$this->getDireccion()."\n".
            "y pertenece a ".$this->getObjPersona()."\n";
    }
} 

