<?php

namespace Wilson\ReportingSystemDemo\Report\Content;

abstract class ReportContent
{
    abstract public function getReportContent(string $studentId):string;
}
