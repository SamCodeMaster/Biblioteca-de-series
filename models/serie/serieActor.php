<?php

class SerieActor {

    private $id;
    private $serie;
    private $actor;


    function __construct($pId, $pSerie, $pActor)
    {
        $this->id = $pId;
        $this->serie = $pSerie;
        $this->actor = $pActor;
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
     * Get the value of actor
     */ 
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * Set the value of actor
     *
     * @return  self
     */ 
    public function setActor($actor)
    {
        $this->actor = $actor;

        return $this;
    }
}

?>