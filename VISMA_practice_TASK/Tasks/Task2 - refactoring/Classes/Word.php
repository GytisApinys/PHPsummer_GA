<?php
namespace task\two;

class Word
{
    private $given_word;
    public function __construct($word){
        $this->given_word = $word;
    }
    public function modifyWord($pattern)
    {
        $matchingPatterns = $this->findMatch($pattern);
        $wordSpacing = $this->spaceSyllable($matchingPatterns);
        $modifiedWord = $this->combineStrings($wordSpacing);
        return $modifiedWord;
    }
    private function findMatch($patterns)
    {
        foreach($patterns as $syllable){
            $Clean_syllable = $this->removeSpaceNum($syllable);
            $patternlen = strlen(trim($syllable))-1;
            $lastPos = 0;
            $position = 0;
        
            if ($syllable[0] == '.')
            {
                $position = stripos ($this->given_word, $Clean_syllable);
                if ($position !== false && substr($this->given_word, 0, strlen($Clean_syllable)) === $Clean_syllable) 
                {
                    $found_patterns[trim($syllable)][] = $position;
                }   
            } else if ($syllable[$patternlen] == '.') 
            {
                $position = stripos ($this->given_word, $Clean_syllable);
        
                if ($position !== false && substr_compare( $this->given_word, $Clean_syllable, -strlen( $Clean_syllable ) ) === 0)
                {
                    $found_patterns[trim($syllable)][] = $position;
        
                }   
            } else if (stripos ($this->given_word, $Clean_syllable) !== false) 
                {
                    while (($lastPos = stripos ($this->given_word, $Clean_syllable, $lastPos))!== false) {
                        $found_patterns[trim($syllable)][] = $lastPos;
                        $lastPos = $lastPos + strlen($Clean_syllable);
                        
                    }
                }   
        }
        return $found_patterns;
    }
    private function spaceSyllable($matchingPatterns)
    {
        $word_spaces = array_fill(0,strlen($this->given_word),0);
        if(!empty($matchingPatterns))
        {
            foreach($matchingPatterns as $key => $values)
            {
        
                $key_lng = strlen($key);
                if($key[0] == '.') 
                {
                    $key_lng--;
                    $key = substr($key, 1);
                }
                if($key[$key_lng-1] == '.') 
                {
                    $key_lng--;
                    $key = substr($key,0, -1);
                }
                
                $key = str_split($key);
        
                foreach ($values as $value) {
                
                    if (($value-1)<0) {
                        $letterNumber=0;
                    }
                    else {
                        $letterNumber=$value-1;
                    }
                    for($i =(($value-1)<0) ? 1 : 0 ; $i < $key_lng;$i++)
                    {
                        if(is_numeric($key[$i]))
                        {
                            if($word_spaces[$letterNumber]<$key[$i]){
                                $word_spaces[$letterNumber] = $key[$i];
                            }
                        }else {
                            $letterNumber++;
                        }
                    }
        
                }
            }
        }
        return $word_spaces;
    }
    private function combineStrings($spacing)
    {
        $formated_word = '';
        $word_lng = strlen($this->given_word);
        $word = str_split($this->given_word);
        $spacing_count = count($spacing);

        for($i =0; $i<$word_lng;$i++)
        {
            $temp1 = $word[$i];
            if($spacing_count !== $i) 
            {
                $temp2 = $spacing[$i];
                $temp2 = (float)$temp2;
                if($temp2 % 2 !== 0) {$temp2 = '-';} else {$temp2 = ' ';};
                $formated_word = $formated_word . $temp1 .$temp2;
            }else {
                $formated_word = $formated_word . $temp1;
            }
        }
        $lastPosCheck = $formated_word[strlen($formated_word)-1];
        if ($lastPosCheck=='-')
        {
            $formated_word = substr($formated_word,0, -1);
        }
        return $formated_word;
    }
    private function removeSpaceNum($string) 
    {
        $num = array(0,1,2,3,4,5,6,7,8,9,'.',"\n","\r");
        return str_replace($num, null, $string);
    }


}