<?php

namespace Wilson\ReportingSystemDemo\Model;

use Jajo\JSONDB;
use Wilson\ReportingSystemDemo\DummyDB;

abstract class Model
{
    protected JSONDB $db;
    protected string $table;

    public function __construct()
    {
        $this->db = DummyDB::getDB();
    }


    public function getById(String $id) {
        return $this->db->select('*')
            ->from($this->table)
            ->where(['id' => $id])
            ->get();
    }

    public function getAll() {
        return $this->db->select('*')
            ->from($this->table)
            ->get();
    }

}