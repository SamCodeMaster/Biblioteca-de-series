<?php

class idiomas {

    private $id;
    private $nombre;
    private $ISO_code;


    public function __construct($pId, $pNombre, $pISO_code)
    {
        $this->id = $pId;
        $this->nombre = $pNombre;
        $this->ISO_code = $pISO_code;
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
    public function getISO_code()
    {
        return $this->ISO_code;
    }

    /**
     * Set the value of slogan
     *
     * @return  self
     */ 
    public function setISO_code($ISO_code)
    {
        $this->ISO_code = $ISO_code;

        return $this;
    }
}

?>