<?php

namespace App\Model;

use App\Model;
use App\Db;

class Article extends Model
{
    public static $table = 'news';

    public $title;
    public $text;
    public $author_id;

    public static function findLast($limit = null)
    {
        $db = new Db();
        $data = $db->query('SELECT * FROM ' . static::$table . ' ORDER BY id DESC LIMIT ' . $limit,
            [],
            static::class);
        return $data;
    }

    public function __get($key)
    {
        if ($key == 'author'){
            return Author::findById($this->author_id);
        }
    }

    public function __isset($key)
    {
        if ($key == 'author' && !empty($this->author_id)){
            return true;
        }
    }
}