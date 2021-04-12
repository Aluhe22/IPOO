<?php
namespace TP2;
include 'Persona.php';
class CuentaBancaria
{
    private $numCuenta;
    private $refPersona;
    private $saldoActual;
    private $interesAnual;
    
    public function __construct($cuenta,$objP,$saldoA,$interes){
        $this->numCuenta=$cuenta;
        $this->refPersona=$objP;
        $this->saldoActual=$saldoA;
        $this->interesAnual=$interes;
    }
    /**
     * @return mixed
     */
    public function getNumCuenta()
    {
        return $this->numCuenta;
    }

    /**
     * @return mixed
     */
    public function getRefPersona()
    {
        return $this->refPersona->__toString();
    }

    /**
     * @return mixed
     */
    public function getSaldoActual()
    {
        return $this->saldoActual;
    }

    /**
     * @return mixed
     */
    public function getInteresAnual()
    {
        return $this->interesAnual;
    }

    /**
     * @param mixed $numCuenta
     */
    public function setNumCuenta($numCuenta)
    {
        $this->numCuenta = $numCuenta;
    }

    /**
     * @param mixed $refPersona
     */
    public function setRefPersona($refPersona)
    {
        $this->refPersona = $refPersona;
    }

    /**
     * @param mixed $saldoActual
     */
    public function setSaldoActual($saldoActual)
    {
        $this->saldoActual = $saldoActual;
    }

    /**
     * @param mixed $interesAnual
     */
    public function setInteresAnual($interesAnual)
    {
        $this->interesAnual = $interesAnual;
    }
    
    public function actualizarSaldo() {
        $this -> saldoActual = $this -> saldoActual + (int)($this -> interesAnual / 365);
    }
    
    public function depositar($cant) {
        $this -> saldoActual = $this -> saldoActual + $cant;
    }
    
    public function retirar($cant) {
        $retorno = false;
        
        $saldoFinal = $this -> saldoActual - $cant;
        if ($saldoFinal > 0) {
            $this -> saldoActual = $saldoFinal;
            $retorno = true;
        }
        return $retorno;
    }
    
    public function __toString(){
        return "\nNumero de cuenta: ".$this->getNumCuenta()."\nCliente: ".$this->getRefPersona()->__toString()."El saldo actual es: ".$this->getSaldoActual()."\nEl interes es: ".$this->getInteresAnual()."\n";
    }

}

