<?php

namespace App\Models;

use App\Db;
use App\Error404;
use App\Exceptions\Exception404;
use App\Model;

class Article extends Model
{
    public const TABLE = 'news';

    public $title;
    public $content;
    public $author_id;

    /**
     * @param $name
     * @return bool|null
     */

    public function __get($name) {
        if(isset($this->author_id)) {
            $authors = Author::findByAuthorId($this->author_id);
            return $authors;
        }
        return null;
    }

    /**
     * @param $name
     * @return bool|null
     */

    public function __isset($name)
    {
        if(!empty($this->author_id)) {
            return Author::findByAuthorId($this->author_id);
        }
        return null;
    }

    /**
     * @return array|bool
     */

    public static function findAllNews()
    {
        $db = new Db();
        // для исключения, задание 3
        //$sql = 'SELECT * FROM' . self::TABLE . ' ORDER BY id DESC LIMIT 3';
        try {
            $sql = 'SELECT * FROM ' . self::TABLE . ' ORDER BY id DESC LIMIT 3';
        } catch(Exception404 $ex) {
            die('Новости не найдены');
        }

        return $db->query($sql,
            [],
            self::class);
    }

    /**
     * @param $id
     * @return null
     */
    public static function findByIdArticle($id)
    {
        $db = new Db();
        // для исключения, задание 3
        //$sql = 'SELECT * FROM ' . self::TABLE . ' WHERE id=:id';

        try {
            $sql = 'SELECT * FROM ' . self::TABLE . ' WHERE id=:id';
        } catch (Exception404 $ex) {
            die('Запрашиваемая вами новость не найдена');
        }

        $result = $db->query($sql,
            [':id' => $id],
            self::class
        );
        // исправила ошибку с прошлого урока
        return $result ? $result[0] : null;
    }

}