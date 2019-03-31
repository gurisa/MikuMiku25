<?php

  class MikuMiku25 {

    private $plainText;
    private $chiperText;
    private $key;

    public function __construct($plainText, $key = null) {
      $this->plainText = $plainText;
      $this->key = $key;
    }

    public function encrypt() {
      return $this->plainText;
    }
  
    public function decrypt() {
      return $this->chiperText;
    }

  }


?>