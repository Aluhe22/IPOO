<?php
class Calculadora{
    private $num1;
    private $num2;
    private $operacion;
    private $resultado;
    
    public function __construct($x,$y){
        $this->num1=$x;
        $this->num2=$y;
    }
    /**
     * @return mixed
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * @param mixed $resultado
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;
    }

    /**
     * @return mixed
     */
    public function getOperacion()
    {
        return $this->operacion;
    }

    /**
     * @param mixed $operacion
     */
    public function setOperacion($operacion)
    {
        $this->operacion = $operacion;
    }

    /**
     * @return mixed
     */
    public function getNum1()
    {
        return $this->num1;
    }

    /**
     * @return mixed
     */
    public function getNum2()
    {
        return $this->num2;
    }

    /**
     * @param mixed $num1
     */
    public function setNum1($num1)
    {
        $this->num1 = $num1;
    }

    /**
     * @param mixed $num2
     */
    public function setNum2($num2)
    {
        $this->num2 = $num2;
    }
    
    public function Suma(){
        $this->setOperacion("+");
        $res = $this->getNum1() + $this->getNum2();
        $this->setResultado($res);
    }
    
    public function Resta(){
        $this->setOperacion("-");
        $res = $this->getNum1() - $this->getNum2();
        $this->setResultado($res);
    }
    
    public function Multi(){
        $this->setOperacion("*");
        $res = $this->getNum1() * $this->getNum2();
        $this->setResultado($res);
    }
    
    public function Divi(){
        $this->setOperacion("/");
        $res = $this->getNum1() / $this->getNum2();
        $this->setResultado($res);
    }
    public function __toString(){
        return "Numero: ".$this->getNum1()." ".$this->getOperacion()." Numero: ".$this->getNum2()." Resultado: ".$this->getResultado()."\n";
    }
    
    
}