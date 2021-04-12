<?php
use TP2\Persona;
use TP2\CuentaBancaria;

include 'Persona.php';
include 'CuentaBancaria.php';

$objPersona = new Persona("Micaela", "Martinez", "DNI", 41358725);
echo $objPersona->__toString();

$cadenap = $objPersona->__toString();

$objBancario = new CuentaBancaria(1234, $cadenap , 10000, 0.12);
echo $objBancario->__toString();
