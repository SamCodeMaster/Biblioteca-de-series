<?php

class Director {

    private $id;
    private $nombre;
    private $apellidos;
    private $dni;
    private $fechaNac;
    private $nacionalidad;


    public function __construct($dId, $dNombre, $dApellidos, $dDni, $dFecha, $dNacionalidad)
    {
        $this->id = $dId;
        $this->nombre = $dNombre;
        $this->apellidos = $dApellidos;
        $this->dni = $dDni;
        $this->fechaNac = $dFecha;
        $this->nacionalidad = $dNacionalidad;
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getDni(){
        return $this->dni;
    }

    public function setDni($dni){
        $this->dni = $dni;
        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of slogan
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of slogan
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getFechaNac(){
        return $this->fechaNac;
    }

    public function setFechaNac($fechaNac){
        $this->fechaNac = $fechaNac;
        return $this;
    }

    public function getNacionalidad(){
        return $this->nacionalidad;
    }

    public function setNacionalidad($nacionalidad){
        $this->nacionalidad = $nacionalidad;
        return $this;
    }
}

?>