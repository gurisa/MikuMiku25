<?php

  class MikuMiku25 {

    private $plainText = '';
	private $chiperText = '';
	private $dictionary;
    private $key;

    public function __construct() {
		$dictionary = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
		$this->setDictionary($dictionary);
    }

    public function encrypt() {
		$plainText = str_split($this->plainText);
		if (count($plainText) > 0) {
			$result = '';
			foreach ($plainText as $key => $value) {
				$index = array_search($value, $this->dictionary, true);
				if ($index !== false) {
					$index = ($index === count($this->dictionary) - 1) ? 1 : $index + 1;
					$result .= $this->dictionary[$index];
				}
				else {
					$result .= $value;
				}
			}
			$this->setChiperText($result);
		}
		return $this;
    }
  
    public function decrypt() {
		$chiperText = str_split($this->chiperText);
		if (count($chiperText) > 0) {
			$result = '';
			foreach ($chiperText as $key => $value) {
				$index = array_search($value, $this->dictionary, true);
				if ($index !== false) {
					$index = ($index === 0) ? count($this->dictionary) - 1 : $index - 1;
					$result .= $this->dictionary[$index];
				}
				else {
					$result .= $value;
				}
			}
			$this->setPlainText($result);
		}
      	return $this;
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

	/**
	 * Get the value of dictionary
	 */ 
	public function getDictionary()
	{
		return $this->dictionary;
	}

	/**
	 * Set the value of dictionary
	 *
	 * @return  self
	 */ 
	public function setDictionary($dictionary)
	{
		$this->dictionary = $dictionary;

		return $this;
	}
  }


?>