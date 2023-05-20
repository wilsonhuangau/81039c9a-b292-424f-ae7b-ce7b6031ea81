<?php

namespace Wilson\ReportingSystemDemo\Report\Printer;

class ConsolePinter extends Printer
{
    public function print(String $content):void
    {
        echo $content;
    }
}
