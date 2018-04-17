<?php

namespace App;


abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function access() : bool
    {
        /*
        if (isset($_GET['ctrl']) && isset($_GET['action'])) {
            $ctrl = $_GET['ctrl'];
            $action = $_GET['action'];
            return true;
        } else {
            return false;
        }
*/
        return true;
    }

    public function action($action)
    {
        $method = 'action' . $action;

        if ($this->access()) {
            return $this->$method();
        } else {
            die('Доступ закрыт');
        }
    }

}
