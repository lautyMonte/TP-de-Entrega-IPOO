<?php
class Viaje{
    private $codigo;
    private $destino;
    private $cantMaxPasajeros;
    private $colPasajeros;
    private $responsableV;

    public function __construct($codigo,$destino,$cantMax,$colPasajeros,$responsableV){
        $this->codigo=$codigo;
        $this->destino=$destino;
        $this->cantMaxPasajeros=$cantMax;
        $this->colPasajeros=$colPasajeros;
        $this->responsableV=$responsableV;
    }

    //observadores
    public function getCodigo(){
        return $this->codigo;
    }

    public function getDestino(){
        return $this->destino;
    }

    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }

    public function getColPasajeros(){
        return $this->colPasajeros;
    }

    public function getResponsableV(){
        return $this->responsableV;
    }

    //modificadores
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

    public function setDestino($destino){
        $this->destino=$destino;
    }

    public function setCantMaxPasajeros($cantMax){
        $this->cantMaxPasajeros=$cantMax;
    }

    public function setColPasajeros($colPasajeros){
        $this->colPasajeros=$colPasajeros;
    }

    public function setResponsableV($responsableV){
        $this->responsableV=$responsableV;
    }

    //propias del tipo
    public function __toString(){
        $pasajeros=implode(";",$this->getColPasajeros());
        return "codigo del viaje: ".$this->getCodigo()."\nDestino: ".$this->getDestino()."\nCantidad maxima de pasajeros: ".$this->getCantMaxPasajeros().
        "\nresponsable del vuelo: ".$this->getResponsableV().
        "\n\nPasajeros que hacen el viaje:\n".$pasajeros;
    }


    /**
     * Busca en el viaje, si se encuentra el pasajero. Si no se encuentra devuelve false 
     * @param Pasajero
     * @return boolean
     */
    public function verificarViajaPasajero($unPasajero){
        $cumple=false;
        $i=0;
        $cantCol=count($this->getColPasajeros());
        $colPasajerosAux=$this->getColPasajeros();
        if($cantCol!=0){//es en el caso de que la coleccion de pasajeros en el vaije no se encuentre vacia
            while(!$cumple & $i<$cantCol){
                if($colPasajerosAux[$i]->getNumDocumento() == $unPasajero->getNumDocumento()){
                    $cumple=true;
                }
                $i++;
            }
        }
        return $cumple;
    }

    /**
     * Guarda al nuevo pasajero de un viaje en la coleccion de pasajeros
     * @param Pasajero 
     */
    public function agregarOtroPasajero($unPasajero){
        $cantCol=count($this->getColPasajeros())-1;
        $colPasajerosAux=$this->getColPasajeros();
        if(!$this->verificarViajaPasajero($unPasajero) & $cantCol<$this->getCantMaxPasajeros()){
            $colPasajerosAux[$cantCol+1]=$unPasajero;
            $this->setColPasajeros($colPasajerosAux);
        }
    }

    /**
     * Busca en el viaje, la posicion donde esta guardado el pasajero 
     * @param Pasajero
     * @return boolean
     */
    public function buscarPosPasajero($dniPasajero){
        $cumple=false;
        $i=0;
        $posPasajero=-1;
        $cantCol=count($this->getColPasajeros());
        $colPasajerosAux=$this->getColPasajeros();
        if($cantCol!=0){//es en el caso de que la coleccion de pasajeros en el vaije no se encuentre vacia
            while(!$cumple & $i<$cantCol){
                if($colPasajerosAux[$i]->getNumDocumento() == $dniPasajero){
                    $cumple=true;
                    $posPasajero=$i;
                }
                $i++;
            }
        }
        return $posPasajero;
    }

    /**
     * Cambia la informacion del pasajero asignado, segun la opcion que eligio
     * @param String
     * @param String
     * @param int
     * @return boolean
     */
    public function cambiarPasajero($opcionCambio,$otroDato,$dniPasajero){
        $cumple=false;
        $posPasajero=$this->buscarPosPasajero($dniPasajero);
        $auxPasajero=$this->getColPasajeros()[$posPasajero];
        $colPasajerosAux=$this->getColPasajeros();
        switch($opcionCambio){
            case "nombre":
                if($otroDato!=$auxPasajero->getNombre()){
                    $auxPasajero->setNombre($otroDato);
                    $colPasajerosAux[$posPasajero]=$auxPasajero;
                    $this->setColPasajeros($colPasajerosAux);
                    $cumple=true;
                };break;
            case "apellido":
                if($otroDato!=$auxPasajero->getApellido()){
                    $auxPasajero->setApellido($otroDato);
                    $colPasajerosAux[$posPasajero]=$auxPasajero;
                    $this->setColPasajeros($colPasajerosAux);
                    $cumple=true;
                };break;
            case "telefono":
                if($otroDato!=$auxPasajero->getNumTelefono()){
                    $auxPasajero->setNumTelefono($otroDato);
                    $colPasajerosAux[$posPasajero]=$auxPasajero;
                    $this->setColPasajeros($colPasajerosAux);
                    $cumple=true;
                };break;
        }
        return $cumple;
    }



    /**
     * Cambia la informacion del viaje segun la opcion que eligio
     * @param String
     * @param String
     * @return boolean
     */
    public function cambiarViaje($opcionCambio,$otroDato){
        $cumple=false;
        switch($opcionCambio){
            case "codigo":
                if($otroDato!=$this->getCodigo()){
                    $this->setCodigo($otroDato);
                    $cumple=true;
                };break;
            case "destino":
                if($otroDato!=$this->getDestino()){
                    $this->setDestino($otroDato);
                    $cumple=true;
                };break;
            case "maximo":
                if($otroDato!=$this->getCantMaxPasajeros()){
                    $this->setCantMaxPasajeros($otroDato);
                    $cumple=true;
                };break;
        }
        return $cumple;
    }



    /**
     * Cambia la informacion del responsable del vuelo segun la opcion que eligio
     * @param String
     * @param String
     */
    public function cambiarResponsableV($opcionCambio,$otroDato){
        switch($opcionCambio){
            case "numero":
                    $aux=$this->getResponsableV();
                    $aux->setNumEmpleado($otroDato);
                    $this->setResponsableV($aux);break;
            case "licencia":
                    $aux=$this->getResponsableV();
                    $aux->setNumLicencia($otroDato);
                    $this->setResponsableV($aux);break;
            case "nombre":
                    $aux=$this->getResponsableV();
                    $aux->setNombreEmpleado($otroDato);
                    $this->setResponsableV($aux);break;
        }
    }



}
?>