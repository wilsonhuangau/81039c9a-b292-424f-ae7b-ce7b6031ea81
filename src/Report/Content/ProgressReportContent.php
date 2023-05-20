<?php

namespace Wilson\ReportingSystemDemo\Report\Content;

class ProgressReportContent extends ReportContent
{
    public function getReportContent(string $studentId): string
    {
        return 'Progress Report' . $studentId;
    }
}
