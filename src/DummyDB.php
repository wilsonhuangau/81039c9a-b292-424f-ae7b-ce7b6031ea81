<?php

namespace Wilson\ReportingSystemDemo;
use Jajo\JSONDB;
class DummyDB
{
    private static $_instance;
    private static $db;
    private function __construct()
    {}
    private function __clone()
    {}
    public static function getDB():JSONDB
    {
        if(!(self::$_instance instanceof self)){
            self::$db = new JSONDB(__DIR__.'\data');
            self::$_instance = new self;
        }
        return self::$db;
    }
}