<?php

namespace App;

abstract class Controller
{
    protected $view;
    protected $action;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action($action)
    {
        if (false === $this->access()){
            echo 'Доступ закрыт';
            exit;
        }
        return 'action' . $action;
    }

    protected function access()
    {
        return true;
    }
}