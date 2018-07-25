<?php

namespace SyllableApplication\Methods;


class ApplicationCli
{
    public function execute(): void
    {
        ConsoleMsgOutput::workTypeMsg();
        $this->sourceOption();
    }

    public function sourceOption(): void
    {
        $action = trim(fgets(STDIN));
        switch ($action) {
            case 1:
                $usingDB = new WorkWithDB();
                $usingDB->executeDBMode();
                break;
            case 2:
                $usingFile = new WorkWithFile();
                $usingFile->executeFileMode();
                break;
            default:
                echo "Wrong input.";
        }
    }
}
