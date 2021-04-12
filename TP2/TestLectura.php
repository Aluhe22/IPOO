<?php
include 'Libro.php';
include 'Lectura.php';
include 'Persona.php';

$persona = new Persona("Mica", "Mar", "DNI", 12345678);

$objLibro = new Libro("IQWE", "HOLA MUNDO", 2000, "zalala", 200, "Una lala y una lulu", $persona);

$objLectura = new Lectura($objLibro, 10);

echo $objLectura->__toString();
