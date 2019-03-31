<?php

  class MikuMiku25 {

    private $plainText;
    private $chiperText;
    private $key;

    public function __construct() {

    }

    public function encrypt() {
      return $this->plainText;
    }
  
    public function decrypt() {
      return $this->chiperText;
    }


    /**
     * Get the value of plainText
     */ 
    public function getPlainText()
    {
        return $this->plainText;
    }

    /**
     * Set the value of plainText
     *
     * @return  self
     */ 
    public function setPlainText($plainText)
    {
        $this->plainText = $plainText;

        return $this;
    }

    /**
     * Get the value of chiperText
     */ 
    public function getChiperText()
    {
        return $this->chiperText;
    }

    /**
     * Set the value of chiperText
     *
     * @return  self
     */ 
    public function setChiperText($chiperText)
    {
        $this->chiperText = $chiperText;

        return $this;
    }

    /**
     * Get the value of key
     */ 
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the value of key
     *
     * @return  self
     */ 
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }
  }


?>