<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/23/2018
 * Time: 11:09 AM
 */

namespace SyllableApplication\tests;

use SyllableApplication\Methods\Word;

require __DIR__ . "/../Methods/Word.php";

class WordTest extends \PHPUnit\Framework\TestCase
{

    private $wordClass;

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->wordClass = new Word('mistranslate');
    }

    public function testSpaceSyllable()
    {
        $expected = [
            ".mis1" => [0],
            "a2n" => [5], "2is" => [1], "5mi" => [0],
            "m2is" => [0], "s1l2" => [7], "s3lat" => [7],
            "2st" => [2], "st4r" => [2],
            "4te." => [10], "1tra" => [3], "n2sl" => [6]
        ];
        $mockData = [
            ".mis1", "a2n", "2is", "5mi",
            "m2is", "n2sl", "s1l2", "s3lat",
            "2st", "st4r", "4te.", "1tra",
            "dab2", "ttt2", "r3dr"
        ];
        $output = $this->wordClass->findMatch($mockData);
        self::assertEquals($expected, $output);
    }

    public function testCombineStrings()
    {
        $mockData = ["2", 0, "1", "4", 0, "2", "2", "3", "2", "4", 0, 0];
        $expected = "mis-trans-late";
        $output = $this->wordClass->combineStrings($mockData);
        self::assertEquals($output, $expected);
    }
}
