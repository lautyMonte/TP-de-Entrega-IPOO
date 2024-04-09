<?php
include 'Pasajeros.php';
include 'Viaje.php';
include 'ResponsableV.php';

function menu()
{
    echo "\nIngrese 1: Para ingresar un pasajero" . 
        "\nIngrese 2: Para modificar datos del pasajero".
        "\nIngrese 3: Para modificar datos del viaje".
        "\nIngrese 4: Para modificar datos del responsable en realizar el viaje".
        "\nIngrese 5: Para ver los datos del viaje\n";
}

echo "\nInformacion del viaje: \n";
echo "Ingrese el codigo\n";
$codigo = trim(fgets(STDIN));
echo "Ingrese el destino\n";
$destino = trim(fgets(STDIN));
echo "Ingrese la cantidad maxima de pasajeros\n";
$cantMaxPasajeros = trim(fgets(STDIN));
$colPasajero = array(); //la coleccion de pasajeros va a iniciar sin datos

echo "Informacion del responsable se ese viaje: \n";
echo "Ingrese el numero de empleado\n";
$numEmpleado= trim(fgets(STDIN));
echo "Ingrese el numero de licencia\n";
$numLicencia= trim(fgets(STDIN));
echo "Ingrese el nombre del empleado\n";
$nombreEmpleado= trim(fgets(STDIN));
echo "Ingrese el apellido del empleado\n";
$apellidoEmpleado= trim(fgets(STDIN));

$unResponsableV= new ResponsableV($numEmpleado,$numLicencia,$nombreEmpleado,$apellidoEmpleado);
$unViaje = new Viaje($codigo, $destino, $cantMaxPasajeros, $colPasajero,$unResponsableV);

$i=0;
do {
    echo "Bienvenidos a Viaje Feliz" . "\nQue desea hacer?";
    menu();
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1:
            if($i<$unViaje->getCantMaxPasajeros()){
                echo "ingrese el nombre del pasajero\n";
                $nombre = trim(fgets(STDIN));
                echo "ingrese el apellido del pasajero\n";
                $apellido = trim(fgets(STDIN));
                echo "ingrese el numero de documento del pasajero\n";
                $numDoc = trim(fgets(STDIN));
                echo "ingrese el numero de telefono del pasajero\n";
                $numTele=trim(fgets(STDIN));
                $unPasajero = new Pasajeros($nombre, $apellido, $numDoc,$numTele);

                $pasajeroEncontrado = $unViaje->verificarViajaPasajero($unPasajero);
                if ($pasajeroEncontrado) {
                    echo "Ya se encuentra en ese viaje";
                } else {
                    $unViaje->agregarOtroPasajero($unPasajero);
                    echo "Pasajero fue cargado en ese viaje";
                    $arrPasajeros[$i]=$unPasajero;
                    $i++;
                }
            }else{
                    echo "El cupo de pasajeros ya se encuentra lleno";
                }
            ;break;

        case 2:
            if(count($unViaje->getColPasajeros())==0){
                echo "no se ingresaron ningun pasajero";
            }else{
                echo "ingrese el documento del pasajero a cambiar\n";
                $dniPasajero=trim(fgets(STDIN));
                echo "que quiere cambiar?\n";
                echo "Ingrese (nombre): Para cambiar el nombre del pasajero" .
                     "\nIngrese (apellido): Para cambiar el apellido del pasajero" .
                     "\nIngrese (telefono): Para cambiar el telefono del pasajero".
                     "\nIngrese (todo): Para cambiar toda la informacion de un pasajero\n";
                $opcionCambio = trim(fgets(STDIN));
                $posPasajero=$unViaje->buscarPosPasajero($dniPasajero);

                if($posPasajero!=-1){
                    $estado=false;
                    switch($opcionCambio){
                        case "nombre":
                            do{
                                echo "ingrese otro nombre\n";
                                $otroDato=trim(fgets(STDIN));
                                $cumple=$unViaje->cambiarPasajero($opcionCambio,$otroDato,$dniPasajero);
                                if($cumple){
                                    echo "nombre cambiado";
                                    $estado=true;
                                }else{
                                    echo "el nombre tiene que ser diferente\n";
                                }
                            }while(!$estado);
                            ;break;
                        
                        case "apellido":
                            do {
                                echo "ingrese otro apellido\n";
                                $otroDato = trim(fgets(STDIN));
                                if ($unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero)) {
                                    echo "apellido cambiado";
                                    $estado = true;
                                } else {
                                    echo "el apellido tiene que ser diferente\n";
                                }
                            } while (!$estado);
                            break;
                        
                        case "telefono":
                            do {
                                echo "ingrese otro telefono\n";
                                $otroDato = trim(fgets(STDIN));
                                if ($unViaje->cambiarPasajero($opcionCambio, $otroDato, $dniPasajero)) {
                                    echo "telefono cambiado";
                                    $estado = true;
                                } else {
                                    echo "el telefono tiene que ser diferente\n";
                                }
                            } while (!$estado);;
                            break;
                            
                        case "todo":
                            echo "ingrese el nombre del pasajero\n";
                            $nombre = trim(fgets(STDIN));
                            echo "ingrese el apellido del pasajero\n";
                            $apellido = trim(fgets(STDIN));
                            echo "ingrese el numero de telefono del pasajero\n";
                            $numTele=trim(fgets(STDIN));
                            $unPasajero = new Pasajeros($nombre, $apellido, $dniPasajero,$numTele);
                            $arrPasajeros[$posPasajero]=$unPasajero;
                            $unViaje->setColPasajeros($arrPasajeros);
                            ;break;
                    }
                }else{
                    echo "no existe ese pasajero";
                }
            };break;

        case 3:
            echo "que quiere cambiar?\n";
            echo "Ingrese (codigo): Para cambiar el codigo del viaje" .
            "\nIngrese (destino): Para cambiar el destino del viaje" .
            "\nIngrese (maximo): Para cambiar la capacidad maxima de pasajeros" .
            "\nIngrese (todo): Para cambiar toda la informacion del viaje\n";
            $opcionCambio = trim(fgets(STDIN));
            $estado=false;
            switch($opcionCambio){
                case 'codigo':
                    do{
                        echo "ingrese otro codigo\n";
                        $otroDato=trim(fgets(STDIN));
                        if($unViaje->cambiarViaje($opcionCambio,$otroDato)){
                            echo "valor cambiado";
                            $estado=true;
                        }else{
                            echo "No se puede cambiar por el mismo valor\n";
                        }
                    }while(!$estado);break;
                
                case "destino":
                        do{
                            echo "ingrese otro destino\n";
                            $otroDato=trim(fgets(STDIN));
                            if($unViaje->cambiarViaje($opcionCambio,$otroDato)){
                                echo "valor cambiado";
                                $estado=true;
                            }else{
                                echo "No se puede cambiar por el mismo valor\n";
                            }
                        }while(!$estado);break;

                case "maximo";
                    do{
                        echo "ingrese otra capacidad maxima de pasajeros\n";
                        $otroDato=trim(fgets(STDIN));
                        if($unViaje->cambiarViaje($opcionCambio,$otroDato)){
                            echo "valor cambiado";
                            $estado=true;
                        }else{
                            echo "No se puede cambiar por el mismo valor\n";
                        }
                    }while(!$estado);break;

                case "todo":
                    echo "Ingrese otro codigo\n";
                    $codigo = trim(fgets(STDIN));
                    echo "Ingrese otro destino\n";
                    $destino = trim(fgets(STDIN));
                    echo "Ingrese otra cantidad maxima de pasajeros\n";
                    $cantMaxPasajeros = trim(fgets(STDIN));
                    $colPasajero = $arrPasajeros;
                    $unViaje = new Viaje($codigo, $destino, $cantMaxPasajeros, $colPasajero,$unResponsableV);
                    ;break;
            }            
            ;break;
        case 4:
            echo "que quiere cambiar?\n";
            echo "Ingrese (numero): Para cambiar el numero del empleado" .
            "\nIngrese (licencia): Para cambiar la licencia del empleado" .
            "\nIngrese (nombre): Para cambiar el nombre del empleado" .
            "\nIngrese (todo): Para cambiar toda la informacion del empleado\n";
            $opcionCambio = trim(fgets(STDIN));
            switch($opcionCambio){
                case "numero":
                    echo "ingrese otro numero\n";
                    $otroDato=trim(fgets(STDIN));
                    $unViaje->cambiarResponsableV($opcionCambio,$otroDato);break;
                case "licencia":
                    echo "ingrese otro numero\n";
                    $otroDato=trim(fgets(STDIN));
                    $unViaje->cambiarResponsableV($opcionCambio,$otroDato);break;
                case "nombre":
                    echo "ingrese otro nombre\n";
                    $otroDato=trim(fgets(STDIN));
                    $unViaje->cambiarResponsableV($opcionCambio,$otroDato);break;
                case "todo":

            }            
            ;break;
        case 5:
            echo "Datos del viaje: \n";
            echo $unViaje->__toString()
            ;break;
    }
    echo "\nDesea hacer otra cosa? s/n\n";
    $desicion = trim(fgets(STDIN));
} while ($desicion == 's');
