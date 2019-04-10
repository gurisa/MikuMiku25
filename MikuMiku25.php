<?php

  class MikuMiku25 {

    private $plainText = '';
    private $chiperText = '';
	private $dictionary;
	private $substitution;
    private $key;

	// $japanese = [
	// 	'぀',  'ぁ', 'あ',  'ぃ',  'い',  'ぅ',  'う',  'ぇ',  'え', 'ぉ', 'お',  'か',  'が',  'き',  'ぎ',  'く', 
	// 	'ぐ',  'け', 'げ',  'こ',  'ご',  'さ',  'ざ',  'し',  'じ', 'す', 'ず',  'せ',  'ぜ',  'そ',  'ぞ',  'た', 
	// 	'だ',  'ち', 'ぢ',  'っ',  'つ',  'づ',  'て',  'で',  'と', 'ど', 'な',  'に',  'ぬ',  'ね',  'の',  'は', 
	// 	'ば',  'ぱ', 'ひ',  'び',  'ぴ',  'ふ',  'ぶ',  'ぷ',  'へ', 'べ', 'ぺ',  'ほ',  'ぼ',  'ぽ',  //'ま',  'み', 
	// 	// 'む',  'め', 'も',  'ゃ',  'や',  'ゅ',  'ゆ',  'ょ',  'よ', 'ら', 'り',  'る',  'れ',  'ろ',  'ゎ',  'わ', 
	// 	// ゐ  ゑ  を  ん  ゔ  ゕ  ゖ  ゗  ゘  ゙  ゚  ゛  ゜  ゝ  ゞ  ゟ 
	// ];

    public function __construct() {
		$dictionary = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
		$substitution = range(12352, 12413);
		$this->setDictionary($dictionary);
		$this->setSubstitution($substitution);
    }

    public function encrypt() {		
		$plainText = $this->plainText;		
		$plainText = str_split($plainText);
		if (count($plainText) > 0) {
			$result = $this->substitute($plainText);
			// foreach ($plainText as $key => $value) {
			// 	$index = array_search($value, $this->dictionary, true);
			// 	if ($index !== false) {
			// 		$index = ($index === count($this->dictionary) - 1) ? 1 : $index + 1;
			// 		// $result .= $this->dictionary[$index];
			// 		$result .= mb_chr($this->substitution[$index], 'utf8');
			// 	}
			// 	else {
			// 		$result .= $value;
			// 	}
			// }
			// $result = base64_encode($result);
			if ($this->key && strlen($this->key) > 0) {
				$key = $this->key;
				$key = str_split($key);
				$key = $this->substitute($key);

				// $result = $this->getRandomString(strlen($this->key)) . '$' . $result . '$' . $this->key;
				$result = $key . '@%' . $result . '@%' . $key;
				// $result = base64_encode($result);
			}			
			$this->setChiperText($result);
		}
		return $this;
	}
	  
    public function decrypt() {
		$chiperText = $this->chiperText;
		
		if ($this->key && strlen($this->key) > 0) {
			// $chiperText = base64_decode($chiperText);

			// $chiperText = substr($chiperText, strlen($this->key) + 1);
			// $chiperText = substr($chiperText, 0, strlen($chiperText) - strlen($this->key) - 1);
			$chiperText = explode('@%', $chiperText);
			if (count($chiperText) == 3) {
				$chiperText = $chiperText[1];
			}
			else {
				$this->setPlainText('Gagal melakukan dekripsi');
				return $this;
			}
		}		
		// $chiperText = base64_decode($chiperText);
		// $chiperText = str_split($chiperText);
		$chiperLength = mb_strlen($chiperText, 'UTF-8');
		$result = [];
		for ($i = 0; $i < $chiperLength; $i++) {
			$result[] = mb_substr($chiperText, $i, 1, 'UTF-8');
		}
		$chiperText = $result;

		$result = '';
		if (count($chiperText) > 0) {
			foreach ($chiperText as $key => $value) {
				$ord = mb_ord($value, 'utf8');
				// $index = array_search($value, $this->dictionary, true);
				$index = array_search($ord, $this->substitution, true);
				
				if ($index !== false) {
					$index = ($index === 0) ? count($this->dictionary) - 1 : $index - 1;
					// $index = ($index === 0) ? count($this->substitution) - 1 : $index - 1;
					$result .= $this->dictionary[$index];
				}
				else {
					$result .= $value;
				}
			}
		}
		$this->setPlainText($result);
      	return $this;
    }

	public function substitute($data) {
		$result = '';
		foreach ($data as $key => $value) {
			$index = array_search($value, $this->dictionary, true);
			if ($index !== false) {
				$index = ($index === count($this->dictionary) - 1) ? 1 : $index + 1;
				$result .= mb_chr($this->substitution[$index], 'utf8');
			}
			else {
				$result .= $value;
			}
		}
		return $result;
	}

	public function getRandomString($length = 32) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
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

	/**
	 * Get the value of substitution
	 */ 
	public function getSubstitution()
	{
		return $this->substitution;
	}

	/**
	 * Set the value of substitution
	 *
	 * @return  self
	 */ 
	public function setSubstitution($substitution)
	{
		$this->substitution = $substitution;

		return $this;
	}
  }

	/* 
		https://stackoverflow.com/questions/38126940/php-str-split-and-utf8-polish-characters
		https://www.key-shortcut.com/en/writing-systems/%E3%81%B2%E3%82%89%E3%81%8C%E3%81%AA-japanese/
		http://www.rikai.com/library/kanjitables/kanji_codes.unicode.shtml
	*/
?>