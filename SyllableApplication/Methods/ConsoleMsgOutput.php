<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/20/2018
 * Time: 10:48 AM
 */

namespace SyllableApplication\Methods;


class ConsoleMsgOutput
{
    public static function workTypeMsg(): void
    {
        echo "\n|---------Word Syllabify---------|\n";
        echo "|                                 |\n";
        echo "|    Would you like to work       |\n";
        echo "|    with Database or file?       |\n";
        echo "|                                 |\n";
        echo "|   [1] - Database                |\n";
        echo "|   [2] - File                    |\n";
        echo "|---------------------------------|\n";
        echo "Enter choice: ";
    }
    public static function workBbMsg(): void
    {
        echo "\n";
        echo "|------------------------|\n";
        echo "|     Work with DB       |\n";
        echo "|     What to do?        |\n";
        echo "|   [1] Update DB        |\n";
        echo "|   [2] Write in         |\n";
        echo "|       Console          |\n";
        echo "|   [3] Check done words |\n";
        echo "|________________________|\n";
        echo "Enter choice:............\n";
    }
    public static function workFileMsg()
    {
        echo "\n";
        echo "|------------------------|\n";
        echo "|     Work with File     |\n";
        echo "|                        |\n";
        echo "|     Get words from :   |\n";
        echo "|     [1] File           |\n";
        echo "|     [2] Console        |\n";
        echo "|________________________|\n";
        echo "Enter choice:............\n";
    }


}