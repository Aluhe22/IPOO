<?php
/*
 * Implementar una clase Login que almacene el nombreUsuario, contrase�a, frase que permite recordar la
contrase�a ingresada y las ultimas 4 contrase�as utilizadas. Implementar un m�todo que permita validar
una contrase�a con la almacenada y un m�todo para cambiar la contrase�a actual por otra nueva, el
sistema deja cambiar la contrase�a siempre y cuando esta no haya sido usada recientemente (es decir no se
encuentra dentro de las cuatro almacenadas). Implementar el m�todo recordar que dado el usuario,
muestra la frase que permite recordar su contrase�a.*/
class Login{
    
    private $nombreUsuario;
    private $contraseNa;
    private $frase;
    private $arreglocontraseNas = array();
    
    
    public function __construct($nombreUsuario,$contraseNa,$frase,$arreglo){
        $this->nombreUsuario=$nombreUsuario;
        $this->contraseNa=$contraseNa;
        $this->frase=$frase;
        $this->arreglocontraseNas=$arreglo;
       
        
    }
    
    public function getnombreUsuario(){
        return $this->nombreUsuario;
    }
    public function getcontraseNa(){
        return $this->contraseNa;
        
    }
    public function getfrase(){
        return $this->frase;
    }
    
    public function getarreglocontraseNas(){
        return $this->arreglocontraseNas;
        
    }
    
    
    public function setnombreUsuario($nombreUsuario){
        $this-> nombreUsuario= $nombreUsuario;
    }
    public function setcontraseNa($contraseNa){
        $this-> contraseNa = $contraseNa;
        
    }
    public function setfrase($frase){
        $this-> frase = $frase;
    }
    
    public function setarreglocontraseNas($arreglocontraseNas){
            $this-> arreglocontraseNas = $arreglocontraseNas;
    }
    
    public function validar($unacontraseNa){
        $respuesta=false;
        $objpass = $this->getcontraseNa();
        if($unacontraseNa == $objpass){
            $respuesta = true;
        }
        return $respuesta;
    }
    
    public function cambiarPass($new) {
        $arreglopass = $this->getarreglocontraseNas();
        if (!($this->validar($new))) {
            array_push($arreglopass,$new);
            $this->setcontraseNa($new);
            $resp = true;
        }else{
            $resp = false;
        }
        
        return $resp;
    }
    
    
    
    public function recordar($usuario){
        $lafrase="";
        $u=$this->getnombreUsuario();
        if($usuario==$u){
            $lafrase=$this->getfrase();
        }else{
            return false;
        }
        return $lafrase;
    }
    
    
    public function __tostring(){
        $datos="\nNombre: ".$this->getnombreUsuario()."\nFrase: ".$this->getfrase();
        return $datos;
    }
    
    
    
    
    
    
}
