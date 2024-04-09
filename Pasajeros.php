<?php
class Pasajeros{
    private $nombre;
    private $apellido;
    private $numDocumento;
    private $numTelefono;

    public function __construct($nombre,$apellido,$numDocumento,$numTelefono){
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->numDocumento=$numDocumento;
        $this->numTelefono=$numTelefono;
    }

    //observadores
    public function getNombre(){
        return $this->nombre;
    } 

    public function getApellido(){
        return $this->apellido;
    }

    public function getNumDocumento(){
        return $this->numDocumento;
    }

    public function getNumTelefono(){
        return $this->numTelefono;
    }

    //modificadores
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function setApellido($apellido){
        $this->apellido=$apellido;
    }

    public function setNumDocumento($numDocumento){
        $this->numDocumento=$numDocumento;
    }

    public function setNumTelefono($numTelefono){
        $this->numTelefono=$numTelefono;
    }

    //propias del tipo
    public function __toString(){
        return "Nombre: ".$this->getNombre().", Apellido: ".$this->getApellido().", nro de Documento: ".$this->getNumDocumento()." Telefono: ".$this->getNumTelefono()."\n";
    }
}
?>