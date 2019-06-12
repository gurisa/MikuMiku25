<?php

  class Miku123 {

    private $plainText = '';
    private $chiperText = '';
	private $dictionary;
	private $substitution;
	private $vocal;
    private $key;
    private $step = [];

	// $japanese = [
	// 	'぀',  'ぁ', 'あ',  'ぃ',  'い',  'ぅ',  'う',  'ぇ',  'え', 'ぉ', 'お',  'か',  'が',  'き',  'ぎ',  'く', 
	// 	'ぐ',  'け', 'げ',  'こ',  'ご',  'さ',  'ざ',  'し',  'じ', 'す', 'ず',  'せ',  'ぜ',  'そ',  'ぞ',  'た', 
	// 	'だ',  'ち', 'ぢ',  'っ',  'つ',  'づ',  'て',  'で',  'と', 'ど', 'な',  'に',  'ぬ',  'ね',  'の',  'は', 
	// 	'ば',  'ぱ', 'ひ',  'び',  'ぴ',  'ふ',  'ぶ',  'ぷ',  'へ', 'べ', 'ぺ',  'ほ',  'ぼ',  'ぽ',  'ま',  'み', 

	// 	// 'む',  'め', 'も',  'ゃ',  'や',  'ゅ',  'ゆ',  'ょ',  'よ', 'ら', 'り',  'る',  'れ',  'ろ',  'ゎ',  'わ', 
	// 	// ゐ  ゑ  を  ん  ゔ  ゕ  ゖ  ゗  ゘  ゙  ゚  ゛  ゜  ゝ  ゞ  ゟ 
	// ];

    public function __construct() {
		$this->dictionary = array_merge(range('a', 'z'), range('A', 'Z'), ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '.', ',']);
		$this->substitution = range(12352, 12415);
        $this->vocal = ['a', 'i', 'u', 'e', 'o', 'A', 'I', 'U', 'E', 'O'];
        $this->step = [
            'vocal' => '',
            'alphabet' => '',
            'unicode' => '',
        ];
    }

    public function encrypt() {		
		$plainText = $this->plainText;		
		$plainText = str_split($plainText);
		if (count($plainText) > 0) {
			$result = '';
			foreach ($plainText as $key => $value) {
				$index = array_search($value, $this->vocal, true);
				if ($index !== false) {
					$index = ($index == count($this->vocal) - 1) ? 0 : $index + 1;
                    $value = $this->vocal[$index];
                    $this->step['vocal'] .= $value;
				}
				
				$index = array_search($value, $this->dictionary, true);
				if ($index !== false) {
					if ($index < count($this->dictionary) - 2) {
						$index = $index + 2;
					}
					else {
						$index = $index - (count($this->dictionary) - 2);
					}
                    $value = $this->dictionary[$index];
                    $this->step['alphabet'] .= $value;
				}

				$index = array_search($value, $this->dictionary, true);
				if ($index !== false) {
					if ($index < count($this->dictionary) - 3) {
						$index = $index + 3;
					}
					else {
						$index = $index - (count($this->dictionary) - 3);
					}
                    $value = mb_chr($this->substitution[$index], 'utf8');
                    $this->step['unicode'] .= $value;
				}

				$result .= $value;
			}			
			$this->setChiperText($result);
		}
		return $this;
	}
	
    public function decrypt() {
		$chiperText = $this->chiperText;
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
				$index = array_search($ord, $this->substitution, true);
				if ($index !== false) {
					if ($index > 2) {
						$index = $index - 3;
					}
					else {
						$index = $index + (count($this->dictionary) - 3);
					}
                    $value = $this->dictionary[$index];
                    $this->step['unicode'] .= $value;
				}

				$index = array_search($value, $this->dictionary, true);
				if ($index !== false) {
					if ($index > 1) {
						$index = $index - 2;
					}
					else {
						$index = $index + (count($this->dictionary) - 2);
					}
                    $value = $this->dictionary[$index];
                    $this->step['alphabet'] .= $value;
				}

				$index = array_search($value, $this->vocal, true);
				if ($index !== false) {
					$index = ($index > 0) ? $index - 1 : count($this->vocal) - 1;
                    $value = $this->vocal[$index];
                    $this->step['vocal'] .= $value;
				}

				$result .= $value;
			}
		}
		$this->setPlainText($result);
      	return $this;
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

    public function getStep() {
        return $this->step;
    }

    public function getVocalStep() {
        return $this->step['vocal'];
    }

    public function getAlphabetStep() {
        return $this->step['alphabet'];
    }

    public function getUnicodeStep() {
        return $this->step['unicode'];
    }

  }

	/* 
		https://stackoverflow.com/questions/38126940/php-str-split-and-utf8-polish-characters
		https://www.key-shortcut.com/en/writing-systems/%E3%81%B2%E3%82%89%E3%81%8C%E3%81%AA-japanese/
		http://www.rikai.com/library/kanjitables/kanji_codes.unicode.shtml
	*/
?>