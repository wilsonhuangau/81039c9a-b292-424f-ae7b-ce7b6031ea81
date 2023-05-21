<?php

use Jajo\JSONDB;
use PHPUnit\Framework\TestCase;

class ReportTest extends TestCase
{
    private $db;

    protected function setUp(): void
    {
        $this->db = new JSONDB(__DIR__ . '/data');
    }
}
