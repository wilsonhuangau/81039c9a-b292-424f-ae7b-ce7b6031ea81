<?php

namespace Wilson\ReportingSystemDemo\Report;

use Wilson\ReportingSystemDemo\Report\Content\DiagnosticReportContent;
use Wilson\ReportingSystemDemo\Report\Content\FeedbackReportContent;
use Wilson\ReportingSystemDemo\Report\Content\ProgressReportContent;
use Wilson\ReportingSystemDemo\Report\Content\ReportContent;
use Wilson\ReportingSystemDemo\Report\Printer\ConsolePinter;
use Wilson\ReportingSystemDemo\Report\Printer\Printer;

class ReportBuilder
{
    private static $_instance;

    public const Report_Type = [
        1 => 'Diagnostic',
        2 => 'Progress',
        3 => 'Feedback',
    ];

    private static $printer = [
        'console' => ConsolePinter::class,
    ];

    private static $reportContent = [
        'Diagnostic' => DiagnosticReportContent::class,
        'Progress' => ProgressReportContent::class,
        'Feedback' => FeedbackReportContent::class,
    ];

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getReportBuilder(): ReportBuilder
    {
        if (! (self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getReport(string $studentId, int $reportType, string $printerType = 'console'): void
    {
        $printer = new self::$printer[$printerType]();

        if (array_key_exists($reportType, self::Report_Type)) {
            $reportContent = new self::$reportContent[self::Report_Type[$reportType]]();
            $content = $this->generateReport($reportContent, $studentId);
            $this->printReport($printer, $content);
        }
    }

    private function generateReport(ReportContent $reportContent, string $studentId): string
    {
        return $reportContent->getReportContent($studentId);
    }

    private function printReport(Printer $printer, String $content): void
    {
        $printer->print($content);
    }
}
