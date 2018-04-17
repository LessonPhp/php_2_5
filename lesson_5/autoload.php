<?php

function __autoload($class)
{
    if(is_readable(__DIR__ . '/admin/Controllers/' . $class . '.php')) {
        require __DIR__ . '/admin/Controllers/' . $class . '.php';
    } elseif (is_readable(__DIR__ . '/admin/Models/' . $class . '.php')) {
        require __DIR__ . '/admin/Models/' . $class . '.php';
    } else {
        require __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    }
}