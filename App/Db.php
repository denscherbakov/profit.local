<?php

namespace App;

class Db
{
    protected $dbh;

    public function __construct()
    {
        try {
            $config = Config::instance();
            $this->dbh = new \PDO('mysql:host=' . $config->data['db']['host'] .
                ';dbname=' . $config->data['db']['dbname'],
                $config->data['db']['user'],
                $config->data['db']['pass']);
        } catch (\PDOException $e) {
            throw new \PDOException('Ошибка подключения к БД');
        }
    }

    public function execute($query, array $params = [])
    {
        $sth = $this->dbh->prepare($query);
        $result = $sth->execute($params);
        if (false === $result) {
            throw new \PDOException('Ошибка запроса к БД');
        }
        return true;
    }

    public function query($query, array $params = [], $class = null)
    {
        $sth = $this->dbh->prepare($query);
        $result = $sth->execute($params);
        if (false === $result){
            throw new \PDOException('Ошибка запроса к БД');
        }
        if (null === $class){
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}