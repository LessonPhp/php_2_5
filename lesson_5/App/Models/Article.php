<?php

namespace App\Models;

use App\Db;
use App\Exceptions\MultiException;
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

    public function __get($name)
    {
        if ('author' === $name) {
            return Author::findById($this->author_id);
        } else {
            return null;
        }
    }

    /**
     * @param $name
     * @return bool
     */

    public function __isset($name)
    {
        if ('author' === $name) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param $data
     * @return MultiException
     */

    // задание 4
    public function check($data)
    {
        $errors = new MultiException();

        if (strlen($data['title']) < 3) {
            $errors->add(new \Exception('Заголовок слишком короткий'));
        }

        // этот пример ошибки - искусственный, для демонстрации метода fill
        if (false !== strpos($data['title'], '~')) {
            $errors->add(new \Exception('Заголовок содержит знак тильда'));
        }

        // и этот тоже
        if (false !== strpos($data['title'], '+')) {
            $errors->add(new \Exception('Заголовок содержит +'));
        }

        if (strlen($data['content']) < 5) {
            $errors->add(new \Exception('Текст слишком короткий'));
        }

        return $errors;
    }

}