<?php

namespace Model;

use Jajo\JSONDB;
use PHPUnit\Framework\TestCase;
use Wilson\ReportingSystemDemo\Model\Questions;

class QuestionsTest extends TestCase
{
    protected JSONDB $db;

    protected Questions $questionsModel;

    protected function setUp(): void
    {
        $this->db = new JSONDB(__DIR__ . '/../data');
        $this->questionsModel = new Questions($this->db);
    }

    public function testGetAllReturnsArray()
    {
        $result = $this->questionsModel->getAll();
        $this->assertIsArray($result);
    }

    public function testGetQuestionsByIdsReturnsArray()
    {
        $ids = ['numeracy1'];
        $result = $this->questionsModel->getQuestionsByIds($ids);
        $this->assertIsArray($result);
    }

    public function testGetQuestionsByIdsReturnsEmptyArrayWhenIdsAreNotFound()
    {
        $ids = ['testId'];
        $result = $this->questionsModel->getQuestionsByIds($ids);
        $this->assertEmpty($result);
    }

    public function testGetQuestionsByIdsReturnsCorrectAmountOfQuestions()
    {
        $ids = ['numeracy1', 'numeracy2'];
        $result = $this->questionsModel->getQuestionsByIds($ids);
        $this->assertCount(2, $result);
    }

    public function testGetQuestionsByIdsWithSameId()
    {
        $ids = ['numeracy1', 'numeracy1', 'numeracy1'];
        $result = $this->questionsModel->getQuestionsByIds($ids);
        $this->assertCount(1, $result);
    }

    public function testGetQuestionsByIdsReturnsEmptyArrayWhenIdsIsEmpty()
    {
        $result = $this->questionsModel->getQuestionsByIds([]);
        $this->assertEmpty($result);
    }
}
