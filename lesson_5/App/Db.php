<?php

namespace App;


use App\Exceptions\DbException;
use App\Exceptions\Exception404;

class Db
{
    protected $dbh;

    public function __construct()
    {
/*
        $config = (include __DIR__ . '/../config.php')['db'];

        $this->dbh = new \PDO(
            'mysql:host=' .$config['host'] . ';dbname=' . $config['dbname'],
            $config['user'],
            $config['password']);
*/
        $config = new \App\Config();
        //echo $config->data['db']['host'];
        //echo $config->data['db']['dbname'];
        //echo $config->data['db']['user'];
        //echo $config->data['db']['password'];

        // исклюсчение к 1 заданию
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