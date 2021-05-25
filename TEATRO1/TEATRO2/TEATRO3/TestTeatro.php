<?php
use TP3\Teatro;
use TP3\Funciones;
use TP3\Cine;
use TP3\ObraTeatral;
use TP3\Musical;

include 'Teatro.php';
include 'Funciones.php';
include 'Cine.php';
include 'Musical.php';
include 'ObraTeatral.php';

$objFuncion1 = new Funciones("Simple", 1233, "18:00", 2);
//echo $objFuncion1->__toString();
$objFuncion2 = new Cine("La cumbre", 1000, "20:00", 2, "Terror", "EEUU");
//echo $objFuncion2->__toString();
$objFuncion3 = new  ObraTeatral("ciega", 1500, "17:00", 1);
//echo $objFuncion3->__toString();

$arregloFunciones = array($objFuncion1,$objFuncion2,$objFuncion3);
$objTeatro = new Teatro("Citrus", "Santa fe 123", $arregloFunciones);
//echo $objTeatro->__toString();
//$resp = $objTeatro->darCosto();
//echo "\nVALOR: ".$resp;

function menuTeatro() {
    $obtenerOp = false;
    echo "\nQue operacion desea realizar?\n";
    echo "\n1) Ingrese varias funciones para su Actividad:\n";
    echo "\n2) Agregar Funcion:\n";
    echo "\n3) Ver ganancia de las instalaciones del Teatro:\n";
    echo "\n4) Salir del menu\n";
    do{
        echo"\nIngrese una opcion valida:\n";
        $opcion=trim(fgets(STDIN));
        if(($opcion>7)||($opcion<1)){
            echo "Opcion invalida, intentelo de nuevo:  \n";
        }else{
            $obtenerOp=true;
        }
    }while(!$obtenerOp);
    return $opcion;
}

$arrayFunciones = array();

echo "Ingrese el nombre de su actividad:\n";
$nomActividad = trim(fgets(STDIN));
echo "Ingrese la direccion:\n";
$dire=trim(fgets(STDIN));

$objTeatro1 = new Teatro($nomActividad, $dire, $arrayFunciones);


$opcion=menuTeatro();
switch ($opcion) {
    case 1: echo "Ingrese la cantidad de funciones que desea:\n";
    $cantFunciones=trim(fgets(STDIN));
    
    for ($i = 0;$i<$cantFunciones;$i++){
        echo "Ingrese la actividad que desea realizar:\n
 1) Cine\n 2) Musical\n 3) Teatro\n";
        $FuncionElejida = trim(fgets(STDIN));
        echo"\nIngrese el nombre de la funcion\n ".$i." :\n";
        $nomFuncion = trim(fgets(STDIN));
        echo "su precio:\n";
        $precio=trim(fgets(STDIN));
        echo "La hora de inicio:\n";
        $horaInicio = trim(fgets(STDIN));
        echo "La duracion: \n";
        $duracion = trim(fgets(STDIN));
        if ($FuncionElejida == 1){
            echo "\nIngrese el genero de la pelicula:\n";
            $genero=trim(fgets(STDIN));
            echo "\nIngrese el pais de origen:\n";
            $pais=trim(fgets(STDIN));
            $objFuncion = new Cine($nomFuncion, $precio, $horaInicio, $duracion, $genero, $pais);
            array_push($arrayFunciones, $objFuncion);
        }else if ($FuncionElejida == 2) {
            echo "\nIngrese el Director:\n";
            $director=trim(fgets(STDIN));
            echo "\nIngresen la cantidad de personas en escena:\n";
            $cantPersonas=trim(fgets(STDIN));
            $objFuncion = new Musical($nomFuncion, $precio, $horaInicio, $duracion, $director, $cantPersonas);
            array_push($arrayFunciones, $objFuncion);
        }else if ($FuncionElejida == 3) {
            $objFuncion = new ObraTeatral($nomFuncion, $precio, $horaInicio, $duracion);
            array_push($arrayFunciones, $objFuncion);
        }
    }
    
    $objTeatro1->set_arregloFunciones($arrayFunciones);
    echo "\nResultado final: \n".$objTeatro1->__toString();
}

