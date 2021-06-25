<?php
namespace TPFINALINTENTOTRES;

include_once 'Teatro.php';
include_once 'Funciones.php';
include_once 'BaseDatos.php';
include_once 'Obra.php';
include_once 'Musical.php';
include_once 'Cine.php';



do{
    
    echo "\n---------MENU---------";
    echo "\n 1)-Crear una instancia Teatro";
    echo "\n 2)-Modificar nombre y direccion de Teatro";
    echo "\n 3)-Eliminar Informacion de teatro";
    echo "\n 4)-Mostrar actividades de un teatro";
    echo "\n 5)-Modificar Actividad";
    echo "\n 6)-Ingresar Actividad";
    echo "\n 7)-Eliminar Actividad";
    echo "\n 8)-Dar costo total de un teatro";
    $opcion=trim(fgets(STDIN));
    
    
    /*4. Implementar dentro de la clase TestTeatro una operacion que permita ingresar,
     modificar y eliminar la informacion de un teatro*/
    
    switch ($opcion) {
        case 1:
            
            echo "\n---CREAR TEATRO---";
            echo "\nIngresar nombre:\n";
            $nombre= trim(fgets(STDIN));
            echo "\nIngresar direccion\n";
            $dire= trim(fgets(STDIN));
            
            $ObjTeatro= new Teatro();
            
            $ObjTeatro->cargar(null, $nombre, $dire);
            $insertado=$ObjTeatro->insertar();
            
            if($insertado){
                echo "\nSu teatro ha sido ingresado";
                echo $ObjTeatro;
            }else{
                echo "\nNo se pudo ingresar teatro\n";
            }
            break;
            
        case 2:
            
            echo "\n---MODIFICAR NOMBRE Y DIRECCION---";
            echo "\nIngrese id de teatro: \n";
            $id= trim(fgets(STDIN));
            $teatro= new Teatro();
            $existe= $teatro->Buscar($id);
            if($existe){
                echo "\nIngrese nuevo nombre del teatro\n";
                $nuevoNombre=trim(fgets(STDIN));
                $teatro->setNombre($nuevoNombre);
                echo "\nIngrese nueva direccion del teatro\n";
                $nuevaDireccion=trim(fgets(STDIN));
                $teatro->setDireccion($nuevaDireccion);
                
                $ver= $teatro-> modificar();
                
                if($ver){
                    
                    echo $teatro."\n";
                }else{
                    echo "\nNo se pudo uwu\n";
                }
            }
            break;
            
        case 3:
            echo "\n---ELIMINAR TEATRO---";
            echo "\nIngrese id de teatro:\n";
            $id= trim(fgets(STDIN));
            $teatro= new Teatro();
            $existe= $teatro->Buscar($id);
            if($existe){
                $teatro->setIdTeatro($id);
                $teatro->eliminar();
                echo "Teatro eliminado\n";
            }else{
                echo "No se ha encontrado ese indice\n";
            }
            break;
            
        case 4:
            echo "---MOSTRAR ACTIVIDADES DE UN TEATRO---";
            echo "\nIngrese id de teatro:\n";
            $id= trim(fgets(STDIN));
            $fun = new Funciones();
            $cond= "idTeatro=$id";
            $ver= $fun->listar($cond);
            echo "\n";
            $cadena="";
            foreach ($ver as $indice){
                $cadena= $cadena. $indice;
            }
            echo $cadena;
            
            break;
            
            /*5. 5. Implementar dentro de la clase TestTeatro una operación que permita ingresar, modificar y
             * eliminar la información de una actividad del teatro, teniendo en cuenta las particularidades expuestas
             * en el dominio a lo largo del cuatrimestre. */
            
        case 5:
            echo "---MODIFICAR ACTIVIDAD---";
            echo "\nIngresar el indice de funcion a modificar:\n";
            $id=trim(fgets(STDIN));
            $fun = new Funciones();
            $ver= $fun->Buscar($id);
            
            if($ver){
                $a= "";
                echo "\nIngresar nuevo nombre:\n";
                $nombre=trim(fgets(STDIN));
                $fun->setNombre($nombre);
                echo "\nIngresar nuevo precio:\n";
                $precio=trim(fgets(STDIN));
                $fun->setPrecio($precio);
                
                $a= $fun->modificar();
                if($a){
                    echo "Funcion cambiada con exito\n";
                    echo $fun;
                }else{
                    echo "Algo salio mal\n";
                }
            }else{
                echo "No existe\n";
            }
            
            break;
            
        case 6:
            $objTeatro = new Teatro();
            echo "---INGRESAR UNA NUEVA ACTIVIDAD---\n";

            echo "Ingresar nombre\n";
            $nombre= trim(fgets(STDIN));
            echo "Ingresar precio:\n";
            $precio= trim(fgets(STDIN));
            echo "Ingresar inicio:\n";
            $inicio= trim(fgets(STDIN));
            echo "Ingresar duracion:\n";
            $duracion= trim(fgets(STDIN));
            $ArregloDatos = [
                'idfuncion' => null,
                'nombre' => $nombre,
                'precio' => $precio,
                'inicio' => $inicio,
                'duracion' => $duracion,
                'idTeatro' => null,
                'genero' => null,
                'nacionalidad' => null,
                'director' => null,
                'actores' => null,
                'autor' => null
    ];
            echo "Ingrese teatro al cual desea agregar la funcion:\n";
            $teatroId= trim(fgets(STDIN));
            $res= $objTeatro->Buscar($teatroId);
            if ($res) {
                echo "\nTipo de actividad: \n1)obra\n2)Cine\n3)Musical\n";
                $tipo= trim(fgets(STDIN));
                if($tipo=="cine"){
                    echo "Ingrese genero: \n";
                    $genero= trim(fgets(STDIN));
                    echo "Ingrese nacionalidad: \n";
                    $nacionalidad= trim(fgets(STDIN));
                    $ArregloDatos['genero'] = $genero;
                    $ArregloDatos['nacionalidad']=$nacionalidad;
                    
                }elseif($tipo=="musical"){
                    
                    echo "Ingrese director:\n";
                    $director= trim(fgets(STDIN));
                    echo "Ingrese actores:\n";
                    $actores= trim(fgets(STDIN));
                    $ArregloDatos['director'] = $director;
                    $ArregloDatos['actores']=$actores;
                    
                }elseif($tipo=="obra"){
                    
                    echo "Ingrese autor:\n";
                    $autor= trim(fgets(STDIN));
                    $ArregloDatos['autor']=$autor;
                    
                }
                $ArregloDatos['idTeatro']=$objTeatro;
                $rta= $objTeatro->agregarFuncion($ArregloDatos, $tipo, $teatroId);
                if($rta){
                    echo "\nFuncion ingresada";
                }else{
                    echo "\nNo se ha podido ingreasar la funcion";
                }
            }else {
                echo "\nEl Teatro no existe\n";
            }
            
            break;
            
        case 7:
            echo "\n---ELIMINAR FUNCION---";
            echo "\nIngrese id de la Funcion:\n";
            $id= trim(fgets(STDIN));
            //busco un funcion con ese id
            $funcion= new Funciones();
            $existe= $funcion->Buscar($id);
            if($existe){
                $funcion->setIdFuncion($id);
                $funcion->eliminar($id);
                echo "Funcion ELIMINADA\n";
            }else{
                echo "No se pudo encontrar\n";
            }
            
            break;
            
            /*9. Volver a implementar el método darCostos, pero ahora, tomar los datos de la base de datos.
             * Tener en cuenta que ahora puede existir mas de 1 teatro, por lo que se debe solicitar el
             * teatro del cual se necesita verificar los costos. */
            
        case 8:
            
            echo "\n---DAR COSTO DE UN TEATRO---";
            echo "\nIngresar el indice del teatro:\n";
            $ind= trim(fgets(STDIN));
            $t = new Teatro();
            
            $t->setIdTeatro($ind);
            $costo= $t->darCostoTotal($ind);
            echo $costo;
            
            break;
            
        default:
            ;
            break;
    }
    
    
}while($opcion!=0);
echo "\n-----HASTA LUEGO-----";
