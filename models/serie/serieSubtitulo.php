<?php

class SerieSubtitulo{

    private $id;
    private $serie;
    private $subtitulo;
    
    function __construct($pId, $pSerie, $pSubtitulos)
    {
        $this->id = $pId;
        $this->serie = $pSerie;
        $this->subtitulo = $pSubtitulos;
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
     * Get the value of serie
     */ 
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set the value of serie
     *
     * @return  self
     */ 
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get the value of subtitulo
     */ 
    public function getSubtitulo()
    {
        return $this->subtitulo;
    }

    /**
     * Set the value of subtitulo
     *
     * @return  self
     */ 
    public function setSubtitulo($subtitulo)
    {
        $this->subtitulo = $subtitulo;

        return $this;
    }
}

?>