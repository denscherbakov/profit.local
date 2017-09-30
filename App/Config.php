<?php

namespace App;

class Config
{
    public $data = [];
    protected static $instance;

    protected function __construct()
    {
        $this->data = require __DIR__ . '/db_config.php';
    }

    public static function instance()
    {
        if (null === self::$instance) {
            return self::$instance = new self();
        }
        return self::$instance;
    }
}