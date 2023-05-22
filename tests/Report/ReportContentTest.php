<?php

namespace Report;

use PHPUnit\Framework\TestCase;
use Wilson\ReportingSystemDemo\Report\Content\DiagnosticReportContent;
use Wilson\ReportingSystemDemo\Report\Content\FeedbackReportContent;
use Wilson\ReportingSystemDemo\Report\Content\ProgressReportContent;

class ReportContentTest extends TestCase
{
    private DiagnosticReportContent $diagnosticReportContent;

    private FeedbackReportContent $feedbackReportContent;

    private ProgressReportContent $progressReportContent;

    protected function setUp(): void
    {
        $this->diagnosticReportContent = new DiagnosticReportContent();
        $this->feedbackReportContent = new FeedbackReportContent();
        $this->progressReportContent = new ProgressReportContent();
    }

    protected function removeNewLine(String $string): string
    {
        return str_replace(["\r", "\n"], '', $string);
    }

    public function testGetDiagnosticReportContent(): void
    {
        $expected = <<<REPORT
                    Tony Stark recently completed Numeracy assessment on 16th December 2021 10:46 AM
                    He got 15 questions right out of 16. Details by strand given below:
                    Number and Algebra: 5 out of 5 correct
                    Measurement and Geometry: 7 out of 7 correct
                    Statistics and Probability: 3 out of 4 correct
                    REPORT;
        $result = $this->diagnosticReportContent->getReportContent('student1');
        $this->assertEquals($this->removeNewLine($expected), $this->removeNewLine($result));
    }

    public function testGetDiagnosticReportContentWithWrongStudentId(): void
    {
        $expected = <<<REPORT
                    Student not found
                    REPORT;
        $result = $this->diagnosticReportContent->getReportContent('student10');
        $this->assertEquals($this->removeNewLine($expected), $this->removeNewLine($result));
    }

    public function testGetFeedbackReportContent(): void
    {
        $expected = <<<REPORT
                    Tony Stark recently completed Numeracy assessment on 16th December 2021 10:46 AM
                    He got 15 questions right out of 16. 
                    Feedback for wrong answers given below
                    Question: What is the 'median' of the following group of numbers 5, 21, 7, 18, 9?
                    Your answer: A with value 7
                    Right answer: B with value 9
                    Hint: You must first arrange the numbers in ascending order. The median is the middle term, which in this case is 9
                    REPORT;
        $result = $this->feedbackReportContent->getReportContent('student1');
        $this->assertEquals($this->removeNewLine($expected), $this->removeNewLine($result));
    }

    public function testGetFeedbackReportContentWithWrongStudentId(): void
    {
        $expected = <<<REPORT
                    Student not found
                    REPORT;
        $result = $this->feedbackReportContent->getReportContent('student10');
        $this->assertEquals($this->removeNewLine($expected), $this->removeNewLine($result));
    }

    public function testGetProgressReportContent(): void
    {
        $expected = <<<REPORT
                    Tony Stark has completed Numeracy assessment 3 times in total. Date and raw score given below:
                    Date: 16th December 2019 10:46 AM, Raw Score: 6 out of 16
                    Date: 16th December 2020 10:46 AM, Raw Score: 10 out of 16
                    Date: 16th December 2021 10:46 AM, Raw Score: 15 out of 16
                    Tony Stark got 9 more correct in the recent completed assessment than the oldest
                    REPORT;
        $result = $this->progressReportContent->getReportContent('student1');
        $this->assertEquals($this->removeNewLine($expected), $this->removeNewLine($result));
    }

    public function testGetProgressReportContentWithWrongStudentId(): void
    {
        $expected = <<<REPORT
                    Student not found
                    REPORT;
        $result = $this->progressReportContent->getReportContent('student10');
        $this->assertEquals($this->removeNewLine($expected), $this->removeNewLine($result));
    }
}
