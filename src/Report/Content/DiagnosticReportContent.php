<?php

namespace Wilson\ReportingSystemDemo\Report\Content;

class DiagnosticReportContent extends ReportContent
{

    public function getReportContent(string $studentId): string
    {
        return 'Diagnostic Report' . $studentId;
    }
}
