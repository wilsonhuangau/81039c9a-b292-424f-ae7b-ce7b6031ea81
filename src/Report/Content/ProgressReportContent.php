<?php

namespace Wilson\ReportingSystemDemo\Report\Content;

use Wilson\ReportingSystemDemo\Model\Assessments;
use Wilson\ReportingSystemDemo\Model\StudentResponses;
use Wilson\ReportingSystemDemo\Model\Students;

class ProgressReportContent extends ReportContent
{
    protected string $templateName = 'progressReportTemplate.txt';

    protected function generateContext(string $studentId): array
    {
        $student = (new Students())->getById($studentId);
        if (empty($student)) {
            return [
                'error' => 'Student not found',
            ];
        }
        $responses = (new StudentResponses())->getByStudentId($studentId);
        if (empty($responses)) {
            return [
                'error' => 'Responses not found',
            ];
        }
        foreach ($responses as $key => $response) {
            $responses[$key]['completed'] = $this->convertTime($response['completed']);
        }

        $progress = $this->getProgress($responses);
        $assessment = (new Assessments())->getById(reset($responses)['assessmentId']);

        return [
            'student' => reset($student),
            'responses' => $responses,
            'assessment' => reset($assessment),
            'progress' => $progress,
        ];
        ;
    }

    protected function getProgress(array $responses): int
    {
        if (count($responses) > 1) {
            $oldest = reset($responses);
            $latest = end($responses);
            return $latest["results"]["rawScore"] - $oldest["results"]["rawScore"];
        }
        return 0;
    }
}
