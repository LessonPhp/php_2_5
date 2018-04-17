<?php

namespace App\Models;

use App\Db;
use App\Error404;
use App\Exceptions\Exception404;
use App\Model;

class Author extends Model
{
    public const TABLE = 'authors';

    public $name;

    /**
     * @return array
     */

    public static function findAllAuthor()
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE. ' ORDER BY id DESC LIMIT 3';
        return $db->query($sql,
            [],
            static::class);
    }

    /**
     * @param $id
     * @return bool
     */

    public static function findByAuthorId($id)
    {
        $db = new Db();

        // для исключения, задание 3
        //$sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';

        try {
            $result = $db->query($sql,
                [':id' => $id],
                static::class);
            // исправила ошибку с прошлого урока
            return $result ? $result[0] : null;
        } catch(Exception404 $ex) {
            // записывает в лог "Ошибка в запросе"
            \App\Logger::getLog($ex);
            die('Автор не найден');
        }

    }


}