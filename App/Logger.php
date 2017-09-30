<?php

namespace App;

class Logger
{
    public static function add(\Exception $e) {
        $file = fopen(__DIR__ . '/../logs/errors.txt', 'a+');
        fwrite($file, date('y-m-d G:i:s') . ' ' . get_class($e) . ' ' . $e->getMessage() . PHP_EOL);
        fclose($file);
    }
}