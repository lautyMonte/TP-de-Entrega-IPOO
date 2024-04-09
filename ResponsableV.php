<?php
class ResponsableV{
    private $numEmpleado;
    private $numLicencia;
    private $nombreEmpleado;
    private $apellidoEmpleado;

    public function __construct($numEmpleado,$numLicencia,$nombre,$apellido){
        $this->numEmpleado=$numEmpleado;
        $this->numLicencia=$numLicencia;
        $this->nombreEmpleado=$nombre;
        $this->apellidoEmpleado=$apellido;
    }

    //observadores
    public function getNumEmpleado(){
        return $this->numEmpleado;
    }

    public function getNumLicencia(){
        return $this->numLicencia;
    }

    public function getNombreEmpleado(){
        return $this->nombreEmpleado;
    }

    public function getApellidoEmpleado(){
        return $this->apellidoEmpleado;
    }

    //modificadores
    public function setNumEmpleado($numEmpleado){
        $this->numEmpleado=$numEmpleado;
    }

    public function setNumLicencia($numLicencia){
        $this->numLicencia=$numLicencia;
    }

    public function setNombreEmpleado($nombre){
        $this->nombreEmpleado=$nombre;
    }

    public function setApellidoEmpleado($apellido){
        $this->apellidoEmpleado=$apellido;
    }

    //propias del tipo
    public function __toString(){
        return "\nnumero empleado: ".$this->getNumEmpleado().
        "\nnumero de licencia: ".$this->getNumLicencia()."\nnombre: ".$this->getNombreEmpleado().
        "\napellido: ".$this->getApellidoEmpleado();
    }
}
?>