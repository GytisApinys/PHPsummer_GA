<?php
date_default_timezone_set('Europe/Vilnius');
// locale_set_default('de-DE');
echo locale_get_default();
$file = new SplFileObject("C:\Users\Gytis.Apinys\Desktop\VISMA_practice_TASK\Task1\Task1_algorith.txt");
while (!$file->eof()) {
    $patterns[] = $file->fgets();
}

echo "\nEnter word you wanna split by syllables:";
$word = trim(fgets(STDIN));
// $time_start = microtime(true);
$data = new DateTime();
echo $data->format("l Y-m-d H:i:s \n");
// $time_start = $data ->getTimestamp();


foreach($patterns as $syllable){
    $Clean_syllable = remove_numbers_and_dot($syllable);
    $patternlen = strlen(trim($syllable))-1;
    $lastPos = 0;
    $position = 0;

    if ($syllable[0] == '.')
    {
        $position = stripos ($word, $Clean_syllable);
        if ($position !== false && substr($word, 0, strlen($Clean_syllable)) === $Clean_syllable) 
        {
            $found_patterns[trim($syllable)][] = $position;
        }   
    } else if ($syllable[$patternlen] == '.') 
    {
        $position = stripos ($word, $Clean_syllable);

        if ($position !== false && substr_compare( $word, $Clean_syllable, -strlen( $Clean_syllable ) ) === 0)
        {
            $found_patterns[trim($syllable)][] = $position;

        }   
    } else if (stripos ($word, $Clean_syllable) !== false) 
        {
            while (($lastPos = stripos ($word, $Clean_syllable, $lastPos))!== false) {
                $found_patterns[trim($syllable)][] = $lastPos;
                $lastPos = $lastPos + strlen($Clean_syllable);
                
            }
        }   
}

  $word_spaces = array_fill(0,strlen($word),0);
// var_dump($found_patterns);
// if no found pattern
if(!empty($found_patterns))
{
    foreach($found_patterns as $key => $values)
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
// var_dump($word_spaces);

$formated_word = '';
$word_lng = strlen($word);
$word = str_split($word);
$word_spaces_count = count($word_spaces);

//  var_dump($word_spaces);

for($i =0; $i<$word_lng;$i++)
{
    $temp1 = $word[$i];
    if($word_spaces_count !== $i) 
    {
        $temp2 = $word_spaces[$i];
        $temp2 = (float)$temp2;
        if($temp2 % 2 !== 0) {$temp2 = '-';} else {$temp2 = ' ';};
        $formated_word = $formated_word . $temp1 .$temp2;
    }else {
        $formated_word = $formated_word . $temp1;
    }
}


echo "Your changed word is:\n";
echo "$formated_word\n";

    // $time_end = microtime(true);


   
    $data2 = new DateTime();
    $time = $data->diff($data2);

    // $time = $time_end - $time_start;
    echo $time->format("%fμs"); // 012345
    // echo "\nProcess Time: $time";



function remove_numbers_and_dot($string) {
    $num = array(0,1,2,3,4,5,6,7,8,9,'.',"\n","\r");
    return str_replace($num, null, $string);
}
