<?php
function menuTeatro() {
    $obtenerOp = false;
    echo "\n¿que operacion desea realizar?\n";
    echo "\n1) Ingrese varias funciones para su Teatro:\n";
    echo "\n2) Ingresar varias Funciones\nPara un nuevo Teatro:\n";
    echo "\n3) Modificar una Funcion que ya existe:\n";
    echo "\n4) Verificar si hay solapamiento:\n";
    echo "\n5) Salir del menu\n";
    do{
        echo"\nIngrese una opcion valida:\n";
        $opcion=trim(fgets(STDIN));
        if(($opcion>8)||($opcion<1)){
            echo "Opcion invalida, intentelo de nuevo:  \n";
        }else{
            $obtenerOp=true;
        }
    }while(!$obtenerOp);
    return $opcion;
}

//cargo las clases que implemente
include 'Teatro.php';
include 'Funciones.php';

//cargo el arreglo asociativo de funciones
$colFunciones=array();
$colFunciones[0]=array("nombre"=>"El Triangulo","precio"=>250, "hora inicio"=>"18:00", "duracion"=>2);
$colFunciones[1]=array("nombre"=>"Brujas","precio"=>950,"hora inicio"=>"21:00", "duracion"=>1);
$colFunciones[2]=array("nombre"=>"Operacion Mazcarada","precio"=>584,"hora inicio"=>"23:30", "duracion"=>2);
$colFunciones[3]=array("nombre"=>"Yule","precio"=>230,"hora inicio"=>"16:30","duracion"=>1);

//creo los objetos Teatro y Funciones
$objfuncion = new Funciones("El triangulo",250,"18:00",2);
$objTeatro = new Teatro("Teatro FaI","Buenos Aires 1400",$colFunciones);

//Modificar el nombre del teatro
echo "Ingrese nombre del teatro\n";
$nomTeatro=trim(fgets(STDIN));
$objTeatro->set_nombreTeatro($nomTeatro);

//Modificar direccion del teatro
echo "Ingrese direccion del teatro\n";
$dire=trim(fgets(STDIN));
$objTeatro->set_direccion($dire);
$cadena=$objTeatro->__toString();
echo $cadena."\n";
do{
    $opcion=menuTeatro();
    switch ($opcion) {
        case 1://Ingrese varias funciones para su Teatro:
            echo "Ingrese la cantidad de funciones que desea:\n";
            $cantFunciones=trim(fgets(STDIN));
            for ($i = 0;$i<$cantFunciones;$i++){
                echo"\nIngrese el nombre de la funcion\n ".$i." :\n";
                $nomFuncion = trim(fgets(STDIN));
                echo "su precio:\n";
                $precio=trim(fgets(STDIN));
                echo "La hora de inicio:\n";
                $horaInicio = trim(fgets(STDIN));
                echo "La duracion: \n";
                $duracion = trim(fgets(STDIN));
                $colFunciones[$i]["nombre"]=$nomFuncion;
                $colFunciones[$i]["precio"]=$precio;
                $colFunciones[$i]["hora inicio"]=$horaInicio;
                $colFunciones[$i]["duracion"]=$duracion;
            }
            $objTeatro->set_arregloFunciones($colFunciones);
            $cadena=$objTeatro->__toString();
            echo $cadena."\n";
            break;
            
        case 2://Ingresar varias Funciones para un nuevo Teatro:
            echo "Ingrese la cantidad de funciones que desea:\n";
            $cantFunciones=trim(fgets(STDIN));
            for ($i = 0;$i<$cantFunciones;$i++){
                echo"\nIngrese el nombre de la funcion\n ".$i." :\n";
                $nomFuncion = trim(fgets(STDIN));
                echo "su precio:\n";
                $precio=trim(fgets(STDIN));
                echo "La hora de inicio:\n";
                $horaInicio = trim(fgets(STDIN));
                echo "La duracion: \n";
                $duracion = trim(fgets(STDIN));
                $colFunciones[$i]["nombre"]=$nomFuncion;
                $colFunciones[$i]["precio"]=$precio;
                $colFunciones[$i]["hora inicio"]=$horaInicio;
                $colFunciones[$i]["duracion"]=$duracion;
            }
            echo"Ingrese el nombre del teatro donde desea guardar las funciones:\n";
            $nomTeatroNuevo=trim(fgets(STDIN));
            echo "ingrese la direccion del mismo:\n";
            $nuevaDireccion=trim(fgets(STDIN));
            $objTeatro1= new Teatro($nomTeatroNuevo, $nuevaDireccion, $colFunciones);
            $cadena=$objTeatro1->__toString();
            echo $cadena."\n";
            break;
        case 3://Modificar una Funcion que ya existe:
            echo "Ingrese el nombre de la funcion que quiere modificar \n";
            $nomFun=trim(fgets(STDIN));
            echo "Ingrese el nuevo nombre de la funcion \n";
            $nomNuevo=trim(fgets(STDIN));
            echo "Ingrese el nuevo precio de la funcion \n";
            $precioNuevo=trim(fgets(STDIN));
            echo "Ingrese la nueva hora de inicio:\n";
            $horaInicio = trim(fgets(STDIN));
            echo "Ingrese la nueva duracion: \n";
            $duracion = trim(fgets(STDIN));
            $modifico=$objTeatro->modificaFuncion($nomFun,$nomNuevo,$precioNuevo,$horaInicio,$duracion);
            $resultado = ($modifico?"Se modificaron los datos exitosamente. ":"Los datos no se puedieron modificar. ");
            echo $resultado;
            
            $cadena=$objTeatro->__toString();
            echo $cadena."\n";
            break;
        case 4://Verificar si hay solapamiento
            $arregloHora = array();
            $colFunciones=$objTeatro->get_arregloFunciones();
            foreach($colFunciones as $horaInicio=>$valorhoraInicio){
                $arregloHora[$horaInicio]=$horaInicio;
            }
            $solapamiento = false;
            foreach($arregloHora as $horaInicio => $valorhoraInicio){
                foreach ($arregloHora as $horaInicio => $valorhoraInicio1){
                    if($valorhoraInicio != $valorhoraInicio1){
                        if($valorhoraInicio == $valorhoraInicio1){
                            $solapamiento= true;
                        }
                    }
                }
            }
            if($solapamiento){
                echo"Hay solapamiento entre las funciones";
            }else{
                echo "Las funciones del teatro, se guardaron correctamente ";
            }
            
            break;
        default:
            echo "\n>>>>>>>>>>>>>>>>>>>>Hasta luego<<<<<<<<<<<<<<<<<<<<<<<\n";
            break;
    }
}while($opcion =! 5);
