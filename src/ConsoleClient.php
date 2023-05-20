<?php

namespace Wilson\ReportingSystemDemo;

use Wilson\ReportingSystemDemo\Report\ReportBuilder;

class ConsoleClient
{
    private static $_instance;

    private function __construct()
    {}
    private function __clone()
    {}

    public static function getConsoleClient():ConsoleClient
    {
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    public function execute():void
    {
        $studentId = $this->getStudentId();
        $reportType = $this->getReportType();

        $reportBuilder = ReportBuilder::getReportBuilder();
        $reportBuilder->getReport($studentId, $reportType);
    }

    protected function getStudentId(): string
    {
        echo 'Please enter the following' . PHP_EOL;
        echo 'Student ID:';
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        fclose($handle);
        return trim($line);
    }

    protected function getReportType(): string
    {
        $reportType = ReportBuilder::Report_Type;
        echo 'Report to generate (1 for Diagnostic, 2 for Progress, 3 for Feedback):';
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        fclose($handle);
        return $line;
    }
}
