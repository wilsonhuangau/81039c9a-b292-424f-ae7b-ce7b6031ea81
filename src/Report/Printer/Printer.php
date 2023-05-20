<?php

namespace Wilson\ReportingSystemDemo\Report\Printer;

abstract class Printer
{
    abstract public function print(String $content);
}
