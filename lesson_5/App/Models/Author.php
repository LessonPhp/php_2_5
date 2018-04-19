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

    // убрала все ненужные методы
}