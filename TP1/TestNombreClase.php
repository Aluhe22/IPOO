<?php

include_once 'Calculadora.php';

echo "----CLASE CALCULADORA----";
$calcu = new Calculadora(5, 4);
$calcu->Suma();
echo $calcu->__toString();
$calcu->Resta();
echo $calcu->__toString();
$calcu->Multi();
echo $calcu->__toString();
$calcu->Divi();
echo $calcu->__toString();
echo "----FIN CLASE CALCULADORA----";

echo "\n----CLASE LOGIN----\n";
include_once 'Login.php';
$arrPass = array();
$arrPass = array("qwerty567", "angel123", "123", "456");
echo "----PRUEBA UNO----\n";
$l=new Login("Pato", "angel123", "olala",$arrPass);
$resp = $l->validar("1234243");
echo "La funci�n validar retorno: ";
if($resp==true){
    echo " es la misma contrase�a \n";
}elseif($resp==false){
    echo "error, no son la misma contrase�a \n";
}
echo "CAMBIO LA CONTRASE�A\n";
$resp = $l->cambiarPass("123bjl");
if ($resp) {
    echo "se modifico correctamente";
}else{
    echo "esa contrace�a es invalida";
}
echo "\nINGRESO LAS CONTRACE�A QUE TENIA ANTES:\n";
$resp = $l->validar("angel123");
echo "La funci�n validar retorno: ";
if($resp==true){
    echo " es la misma contrase�a \n";
}elseif($resp==false){
    echo "error, no son la misma contrase�a";
}
echo $l->__tostring();
echo "\n----PRUEBA DOS----\n";
$l = new Login("Viviana", "123", "esta es la frase", $arrPass);
$resp = $l->validar("123");
echo "La funcion validar retorno: ";
if($resp==true){
    echo " es la misma contrase�a \n";
}elseif($resp==false){
    echo "error, no son la misma contrase�a \n";
}
$resp = $l->recordar("Viviana");
echo $resp;
echo $l->__tostring();
echo "\n----FIN CLASE LOGIN----\n";
