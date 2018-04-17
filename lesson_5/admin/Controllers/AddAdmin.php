<?php

use App\View;

class AddAdmin extends AdminController
{
    //public function actionAddAdmin()
    public function handle()
    {
        echo $this->view->display(__DIR__ . '/../Models/add.php');
        echo $this->view->display(__DIR__ . '/../templates/add.php');
    }
}