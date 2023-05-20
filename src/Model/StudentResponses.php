<?php

namespace Wilson\ReportingSystemDemo\Model;

use Jajo\JSONDB;

class StudentResponses extends Model
{
    protected string $table = 'student-responses.json';

    public function getByStudentId(string $studentId):array
    {
        $response =  $this->db->select('*')
            ->from($this->table)
            ->get();
//responses may does not have completed date
        $response = array_filter($response, static function($value, $key) use ($studentId){
            return array_key_exists('completed', $value) && $value['student']['id'] === $studentId;
        },ARRAY_FILTER_USE_BOTH);
//order response by completed date
        usort($response, static function($a, $b) {
            return $a['completed'] <=> $b['completed']; // compare the values of the specified column
        });

        return $response;
    }

    public function getLatestResponseByStudentId(string $studentId):array
    {   $responses = $this->getByStudentId($studentId);
        if (!empty($responses)) {
            return end($responses);
        }
        return [];

    }
}