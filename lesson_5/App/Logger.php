<?php

namespace App;

// задание 5
class Logger
{
    public function getLog(\Exception $ex)
    {
        if (file_exists(__DIR__ . '/../log.txt') & is_readable(__DIR__ . '/../log.txt')) {
            $res = file(__DIR__ . '/../log.txt', FILE_IGNORE_NEW_LINES);
        }
        $res[] = ' | Ошибка: ' . $ex->getMessage() . ' | дата: ' . date('Y-m-d') . ' | время: ' . date('G:i:s');
        $str = implode("\n", $res);
        file_put_contents(__DIR__ . '/../log.txt', $str);
    }
}