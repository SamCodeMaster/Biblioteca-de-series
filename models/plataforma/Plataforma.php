<?php

class Plataforma {

    private $id;
    private $nombre;
    private $slogan;


    public function __construct($pId, $pNombre, $pSlogan)
    {
        $this->id = $pId;
        $this->nombre = $pNombre;
        $this->slogan = $pSlogan;
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
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * Set the value of slogan
     *
     * @return  self
     */ 
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;

        return $this;
    }
}

?>