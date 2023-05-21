<?php

namespace Wilson\ReportingSystemDemo\Report\Content;

use Wilson\ReportingSystemDemo\Model\Assessments;
use Wilson\ReportingSystemDemo\Model\Questions;
use Wilson\ReportingSystemDemo\Model\StudentResponses;
use Wilson\ReportingSystemDemo\Model\Students;

class FeedbackReportContent extends ReportContent
{
    protected string $templateName = 'feedbackReportTemplate.txt';

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
        $studentLatestResponse['completed'] = $this->convertTime($studentLatestResponse['completed']);
        $assessment = (new Assessments())->getById($studentLatestResponse['assessmentId']);
        $questions = (new Questions())->getQuestionsByIds(array_column($studentLatestResponse['responses'], 'questionId'));
        $feedbackDetails = $this->getFeedbackDetails($questions, $studentLatestResponse['responses']);
        return [
            'student' => reset($student),
            'response' => $studentLatestResponse,
            'assessment' => reset($assessment),
            'questions' => $questions,
            'feedbackDetails' => $feedbackDetails,
        ];
    }

    protected function getFeedbackDetails(array $questions, array $responses): array
    {
        $result = [];

        foreach ($responses as $response) {
            $question = $this->getItemByKeyValue($questions, 'id', $response['questionId']);
            if ($response['response'] !== $question['config']['key']) {
                $result[$question['id']]['stem'] = $question['stem'];
                $result[$question['id']]['responseAnswer'] = $this->getItemByKeyValue($question['config']['options'], 'id', $response['response']);
                $result[$question['id']]['rightAnswer'] = $this->getItemByKeyValue($question['config']['options'], 'id', $question['config']['key']);
                $result[$question['id']]['hint'] = $question['config']['hint'];
            }
        }
        return $result;
    }
}
