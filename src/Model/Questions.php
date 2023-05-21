<?php

namespace Wilson\ReportingSystemDemo\Model;

class Questions extends Model
{
    protected string $table = 'questions.json';

    public function getQuestionsByIds(array $ids): array
    {
        $questions = $this->getAll();
        return array_filter($questions, static function ($question, $key) use ($ids) {
            return in_array($question['id'], $ids, true);
        }, ARRAY_FILTER_USE_BOTH);
    }
}
