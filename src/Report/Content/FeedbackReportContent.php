<?php

namespace Wilson\ReportingSystemDemo\Report\Content;

class FeedbackReportContent extends ReportContent
{
    public function getReportContent(string $studentId): string
    {
        return 'Feedback Report' . $studentId;
    }
}
