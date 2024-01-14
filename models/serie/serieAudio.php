<?php

class SerieAudio{

    private $id;
    private $serie;
    private $audio;


    function __construct($pId, $pSerie, $pAudio)
    {
        $this->id = $pId;
        $this->serie = $pSerie;
        $this->audio = $pAudio;
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
     * Get the value of audio
     */ 
    public function getAudio()
    {
        return $this->audio;
    }

    /**
     * Set the value of audio
     *
     * @return  self
     */ 
    public function setAudio($audio)
    {
        $this->audio = $audio;

        return $this;
    }
}

?>