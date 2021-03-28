<?php
include_once 'Cafetera.php';



function menu(){
    echo "Menu cafetera \n";
    echo "1 - Llenar la cafetera \n";
    echo "2 - Servir taza \n";
    echo "3 - Vaciar cafetera \n";
    echo "4 - Agregar cafe \n";
    echo "5 - Salir o terminar programa \n";
    $opcion=trim(fgets(STDIN));
    
    return $opcion;
}


function main(){
    
    $I= 700;
    $Z= 1000;
    
    $cafe = new Cafetera($Z, $I);
    $respuesta=menu();
    $resp= $cafe->llenarCafetera($Z,$I);
    if($respuesta == 1 && $resp==true){
        echo " Se completo la cafetera\n";
        
    }
    elseif($respuesta == 2 && $cafe->servirTaza($I)==true){
        echo " Se lleno la taza correctamente\n";
    }
    elseif($respuesta == 2 && $cafe->servirTaza($I)==false){
        echo" No se pudo llenar la taza correctamente\n";
    }
    elseif($respuesta == 3){
        $resp=$cafe->vaciarCafetera();
      if ($resp) {
          echo "La cafetera se vacio correctamente\n";
      }else{
          echo "la cafetera ya estaba vacia";
      }
    }
    elseif($respuesta == 4){
        $cafe->agregarCafe(50);
        echo "Se completo la taza \n";
    }elseif ($respuesta == 5){
        echo "----HASTA LUEGO----";
    }
    
}

main();
?>
