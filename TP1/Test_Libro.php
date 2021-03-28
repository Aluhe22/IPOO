<?php
use TP1\Libro;

include_once 'Libro.php';

$obj = new Libro(7787, "Odisea", 1999, "Mers", "Mauro", "Mels");

$libro1 = new Libro(123, "sparta", 2020, "rio negro", "fran", "rod");
$libro2 = new Libro(113, "gladiador", 2020, "bs", "jose", "barra");
$libro3 = new Libro(132, "iliada", 2019, "nqn", "marce", "fuente");
$buscar = new Libro(113, "iliadjjkllkjjkljkla", 2020, "bs", "jose", "barra");
$libros=array($libro1,$libro2,$libro3);
$editorialALFA=array("rio negro","bs","Mer");

echo $obj;

$resp = $obj->perteneceEditorial("Mers");

if ($resp == true) {
    echo "\nPertenece a la editorial\n";
    
}else{
    echo "\nNo pertenece a la editorial\n";
}

if ($buscar->iguales($buscar, $libros)) {
    echo "\nEsta en la coleccion de libros\n";
}else{
    echo "\nNo esta en la coleccion\n";
}

$r = $obj->aniosdesdeEdicion();
echo "\nAños desde su ultima edicion:";
echo $r;