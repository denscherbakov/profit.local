<?php

namespace App;

abstract class Model
{
    public static $table;

    public $id;

    public static function findAll()
    {
        $db = new Db();
        $data = $db->query('SELECT * FROM ' . static::$table,
                            [],
                            static::class);
        return $data;
    }

    public static function findById($id)
    {
        $db = new Db();
        $data = $db->query('SELECT * FROM ' . static::$table . ' WHERE id=:id',
                            ['id' => $id],
                            static::class);
        return isset($data[0]) ? $data[0] : false;
    }

    public function isNew()
    {
        return empty($this->id);
    }

    public function insert()
    {
        if ($this->isNew()){
            $columns = [];
            $binds = [];
            $data = [];
            foreach ($this as $column => $value){
                if ('id' == $column){
                    continue;
                }
                $columns[] = $column;
                $binds[] = ':' . $column;
                $data[':' . $column] = $value;
            }
        }

        $sql = 'INSERT INTO ' . static::$table .
                ' (' . implode(', ', $columns) .
                ') VALUES (' .
                implode(', ', $binds) . ')';
        $db = new Db();
        $db->execute($sql, $data);
        $this->id = $db->lastInsertId();
    }

    public function update()
    {
        if (!$this->isNew()){
            $columns = [];
            $data = [];
            foreach ($this as $column => $value){
                if ('id' == $column){
                    continue;
                }
                $columns[] = $column . '=:' . $column;
                $data[':' . $column] = $value;
            }
        }
        $sql = 'UPDATE ' . static::$table .
            ' SET ' . implode(', ', $columns) .
            ' WHERE id=:id';
        $data[':id'] = $this->id;
        $db = new Db();
        $db->execute($sql, $data);
    }

    public function save()
    {
        return $this->isNew() ? $this->insert() : $this->update();
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id=:id';
        $data[':id'] = $this->id;
        $db = new Db();
        $db->execute($sql, $data);
    }

    public function fill(array $data)
    {
        $errors = new MultiException();
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            } else {
                $errors->add(new \Exception('Not exist: ' . $key));
            }
        }
        return $this;
    }
}