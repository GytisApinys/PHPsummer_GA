<?php
$Clean_syllable = "trans";
$givenWord = "translatetranstranstransssstrans";

                preg_match_all("/".$Clean_syllable."/i", $givenWord, $possitionArray, PREG_OFFSET_CAPTURE);
                for ($i=0; $i < count($possitionArray[0]) ;$i++) {
                    echo $possitionArray[0][$i][1];
  
                }
?>