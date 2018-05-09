<?php

namespace App;

use App\Exceptions\Error404Exception;
use App\Exceptions\MultiException;
use App\Models\Article;

abstract class Model
{
    public const TABLE = '';
    public $id;

    /**
     * @return array|bool
     * @throws Error404Exception
     */
    public static function findAll()
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE;
        $result =  $db->query($sql,
            [],
            static::class);

        // задание 3
        if(empty($result)) {
            throw new Error404Exception('Новости не найдены');
        }
        return $result;
    }

    /**
     * @param $id
     * @return null
     * @throws Error404Exception
     */
    public static function findById($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';
        $result = $db->query($sql,
            [':id' => $id],
            static::class
        );

        // задание 3
        if(empty($result)) {
            throw new Error404Exception('Запрашиваемая вами новость не найдена');
        }

        return $result ? $result[0] : null;
    }

    // задание 4
    /**
     * @param array $data
     * @throws MultiException
     */
    public function fill(array $data)
    {
        $errors = new MultiException();

        foreach($data as $key => $value) {
            $this->$key = $value;
        }

        if(isset($errors)) {
            $errors->add(new \Exception('Пароль слишком короткий'));
        }

        if(isset($errors)) {
            $errors->add(new \Exception('Пароль содержит +'));
        }

        if(!$errors->empty()) {
            throw $errors;
        }

    }

    public function insert()
    {
        $fields = get_object_vars($this);
        $cols = [];
        $data = [];

        foreach ($fields as $name => $value) {
            if ('id' == $name) {
                continue;
            }

            $cols[] = $name;
            $data[':' . $name] = $value;
        }

        $sql = '
        INSERT INTO ' . static::TABLE . '
        (' . implode(', ', $cols) . ')
         VALUES 
         (' . implode(', ', array_keys($data)) . ')
         ';

        $db = new Db();
        $db->execute($sql, $data);
        $this->id = $db->getLastId();
    }

    public function update()
    {
        $fields = get_object_vars($this);
        $cols = [];
        $data = [];

        foreach ($fields as $name => $value) {
            $data[':' . $name] = $value;
            if ('id' == $name) {
                continue;
            }
            $cols[] = $name . '=:' . $name;
        }

        $sql = '
        UPDATE ' . static::TABLE . '
        SET ' . implode(', ', $cols) . '
        WHERE id=:id';


        $db = new Db();
        $db->execute($sql, $data);
    }


    public function save()
    {
        if(!isset($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id=:id';
        $db = new Db();
        $db->execute($sql,[':id' => $this->id]);
    }

}