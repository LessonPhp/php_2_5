<?php

namespace App;


use App\Exceptions\DbException;
use App\Exceptions\Exception404;

class Db
{
    protected $dbh;

    public function __construct()
    {
        $config = new \App\Config();
        // исключение к 1 заданию
        try {
            $this->dbh = new \PDO(
                'mysql:host='. $config->data['db']['host'] . ';dbname=' . $config->data['db']['dbname'],
                $config->data['db']['user'],
                $config->data['db']['password']);
        } catch (\PDOException $ex) {
            $ex = new DbException('Нет соединения с базой данных');
            throw $ex;
        }
    }

    public function query($sql, $data=[], $class)
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($data);
        if(empty($res)) {
            throw new Exception404('Ошибка в запросе');
        }
        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function execute($query, $params=[])
    {
        $sth = $this->dbh->prepare($query);
        if(true == $sth->execute($params)) {
            return true;
        } else {
            return false;
        }
    }

    public function getLastId()
    {
        return $this->dbh->lastInsertId();
    }
}