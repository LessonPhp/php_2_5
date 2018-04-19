<?php

namespace App;

use App\Exceptions\MultiException;
use App\Models\Article;

abstract class Model
{
    public const TABLE = '';
    public $id;

    /**
     * @return array|bool
     */
    public static function findAll()
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->query($sql,
            [],
            static::class);
    }

    /**
     * @param $id
     * @return null
     */
    public static function findById($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';
        $result = $db->query($sql,
            [':id' => $id],
            static::class
        );

        // исправила ошибку с прошлого урока
        return $result ? $result[0] : null;

    }

    /**
     * @param array $data
     * @throws MultiException
     */
    // задание 3
    public function fill(array $data)
    {
        $errors = new MultiException();
        foreach ($data as $key => $val) {
            try {
                $this->$key = $val;
            } catch (\Exception $e) {
                $errors->add($e);
            }
        }
        if (!$errors->empty()) {
            throw $errors;
        }
    }
    // сделали на уроке
    public function insert()
    {
        $fields = get_object_vars($this);
        //var_dump($fields);
        $cols = [];
        $data = [];

        foreach ($fields as $name => $value) {
            if ('id' == $name) {
                continue;
            }

            $cols[] = $name;
            $data[':' . $name] = $value;
        }
        //var_dump($cols);
        //var_dump($data);

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
        //die;

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