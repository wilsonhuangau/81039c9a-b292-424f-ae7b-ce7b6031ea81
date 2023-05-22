<?php

namespace Model;

use Jajo\JSONDB;
use PHPUnit\Framework\TestCase;
use Wilson\ReportingSystemDemo\Model\StudentResponses;

class StudentResponsesTest extends TestCase
{
    protected JSONDB $db;

    protected StudentResponses $StudentResponsesModel;

    protected function setUp(): void
    {
        $this->db = new JSONDB(__DIR__ . '/../data');
        $this->StudentResponsesModel = new StudentResponses($this->db);
    }

    public function testGetByStudentId(): void
    {
        $response = $this->StudentResponsesModel->getByStudentId('student1');
        $this->assertIsArray($response);
        $this->assertCount(3, $response);
    }

    public function testGetByStudentIdEmpty(): void
    {
        $response = $this->StudentResponsesModel->getByStudentId('');
        $this->assertEmpty($response);
    }

    public function testGetLatestResponseByStudentId(): void
    {
        $response = $this->StudentResponsesModel->getLatestResponseByStudentId('student1');
        $this->assertIsArray($response);
        $this->assertEquals('16/12/2021 10:46:00', $response['completed']);
    }

    public function testGetLatestResponseByStudentIdEmpty(): void
    {
        $response = $this->StudentResponsesModel->getLatestResponseByStudentId('');
        $this->assertEmpty($response);
    }
}
