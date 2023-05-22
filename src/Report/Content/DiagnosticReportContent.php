<?php

namespace Wilson\ReportingSystemDemo\Report\Content;

use Wilson\ReportingSystemDemo\Model\Assessments;
use Wilson\ReportingSystemDemo\Model\Questions;
use Wilson\ReportingSystemDemo\Model\StudentResponses;
use Wilson\ReportingSystemDemo\Model\Students;

class DiagnosticReportContent extends ReportContent
{
    protected string $templateName = 'diagnosticReportTemplate.txt';

    protected function generateContext(string $studentId): array
    {
        $student = (new Students())->getById($studentId);
        if (empty($student)) {
            return [
                'error' => 'Student not found',
            ];
        }
        $studentLatestResponse = (new StudentResponses())->getLatestResponseByStudentId($studentId);
        if (empty($studentLatestResponse)) {
            return [
                'error' => 'Responses not found',
            ];
        }
        $studentLatestResponse['completed'] = convertTime($studentLatestResponse['completed']);
        $assessment = (new Assessments())->getById($studentLatestResponse['assessmentId']);
        $questions = (new Questions())->getQuestionsByIds(array_column($studentLatestResponse['responses'], 'questionId'));

        $strandDetails = $this->getStrandDetails($questions, $studentLatestResponse['responses']);
        return [
            'student' => reset($student),
            'response' => $studentLatestResponse,
            'assessment' => reset($assessment),
            'questions' => $questions,
            'strandDetails' => $strandDetails,
        ];
    }

    protected function getStrandDetails(array $questions, array $responses): array
    {
        $result = [];

        foreach ($responses as $response) {
            $question = getItemByKeyValue($questions, 'id', $response['questionId']);
            if (! array_key_exists($question['strand'], $result)) {
                $result[$question['strand']] = [];
            }
            if (! array_key_exists('total', $result[$question['strand']])) {
                $result[$question['strand']]['total'] = 0;
            }
            if (! array_key_exists('correct', $result[$question['strand']])) {
                $result[$question['strand']]['correct'] = 0;
            }
            ++$result[$question['strand']]['total'];
            if ($response['response'] === $question['config']['key']) {
                ++$result[$question['strand']]['correct'];
            }
        }
        return $result;
    }
}
