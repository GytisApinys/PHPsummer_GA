<?php

namespace SyllableApplication\Methods;

class Word
{
    private $givenWord;

    public function __construct($word)
    {
        $this->givenWord = $word;
    }

    public function modifyWord($pattern): string
    {
        $matchingPatterns = $this->findMatch($pattern);
        $wordSpacing = $this->spaceSyllable($matchingPatterns);
        $modifiedWord = $this->combineStrings($wordSpacing);

        return $modifiedWord;
    }

    public function findMatch(array $patterns): array
    {
        foreach ($patterns as $syllable) {
            $cleanSyllable = preg_replace("/[\d\s.]+/", "", $syllable);
            if (preg_match('/^[.]/', $syllable) != null) {
                $position = stripos($this->givenWord, $cleanSyllable);
                if ($position !== false &&
                    substr($this->givenWord, 0, strlen($cleanSyllable)) === $cleanSyllable) {
                    $foundPatterns[trim($syllable)][] = $position;
                }
            } elseif (preg_match('/[.]$/', $syllable) != null) {
                $position = stripos($this->givenWord, $cleanSyllable);
                if ($position !== false &&
                    substr_compare($this->givenWord, $cleanSyllable, -strlen($cleanSyllable)) === 0) {
                    $foundPatterns[trim($syllable)][] = $position;
                }
            } elseif (preg_match("/$cleanSyllable/i", $this->givenWord) != null) {
                preg_match_all("/$cleanSyllable/i", $this->givenWord, $positionArray, PREG_OFFSET_CAPTURE);
                for ($i = 0; $i < count($positionArray[0]); $i++) {
                    $foundPatterns[trim($syllable)][] = $positionArray[0][$i][1];
                }
            }
        }
        if (empty($foundPatterns)) {
            $foundPatterns = [];
        }

        return $foundPatterns;
    }

    private function spaceSyllable($matchingPatterns): array
    {
        $wordSpaces = array_fill(0, strlen($this->givenWord), 0);
        if (!empty($matchingPatterns)) {
            foreach ($matchingPatterns as $key => $values) {
                $keyLng = strlen($key);
                if ($key[0] == '.') {
                    $keyLng--;
                    $key = substr($key, 1);
                }
                if ($key[$keyLng - 1] == '.') {
                    $keyLng--;
                    $key = substr($key, 0, -1);
                }
                $key = str_split($key);

                foreach ($values as $value) {
                    if (($value - 1) < 0) {
                        $letterNumber = 0;
                    } else {
                        $letterNumber = $value - 1;
                    }
                    for ($i = (($value - 1) < 0) ? 1 : 0; $i < $keyLng; $i++) {
                        if (is_numeric($key[$i])) {
                            if ($wordSpaces[$letterNumber] < $key[$i]) {
                                $wordSpaces[$letterNumber] = $key[$i];
                            }
                        } else {
                            $letterNumber++;
                        }
                    }
                }
            }
        }
        return $wordSpaces;
    }

    public function combineStrings($spacing): string
    {

        $formattedWord = '';
        $wordLng = strlen($this->givenWord);
        $word = str_split($this->givenWord);
        $spacingCount = count($spacing);

        for ($i = 0; $i < $wordLng; $i++) {
            $temp1 = $word[$i];
            if ($spacingCount !== $i) {
                $temp2 = $spacing[$i];
                $temp2 = (float)$temp2;
                if ($temp2 % 2 !== 0) {
                    $temp2 = '-';
                } else {
                    $temp2 = '';
                };
                $formattedWord = $formattedWord . $temp1 . $temp2;
            } else {
                $formattedWord = $formattedWord . $temp1;
            }
        }
        $lastPosCheck = $formattedWord[strlen($formattedWord) - 1];
        if ($lastPosCheck == '-') {
            $formattedWord = substr($formattedWord, 0, -1);
        }
        return $formattedWord;
    }
}
