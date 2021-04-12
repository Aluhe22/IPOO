<?php
use TP2\Persona;

include 'Persona.php';

$objPersona = new Persona("Micaela", "Martinez", "DNI", 41358725);
echo $objPersona->__toString();
