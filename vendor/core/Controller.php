<?php

namespace vendor\core;

abstract class Controller
{
    public $route = [];
    public $view = '';
    public $layout = '';
    public $vars = [];
    public $getParams = [];
    public $postParams = [];
    public $isAjax;
    protected $users;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = empty($this->view) ? $route['action'] : $this->view;
        $this->getParams = $_GET;
        $this->postParams = $_POST;
        $this->isAjax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') ? true : false;
        $this->setUsers();
    }

    public function getView()
    {
        if (!$this->isAjax && $this->layout !== false) {
            $vObj = new View($this->route, $this->layout, $this->view);
            $vObj->render($this->vars);
        } elseif ($this->isAjax && $this->layout !== false) {
            $vObj = new View($this->route, $this->layout, $this->view);
            $vObj->renderAjax($this->vars);
        } else {
            echo json_encode($this->vars);
        }
    }

    public function set($vars)
    {
        $this->vars = $vars;
    }

    protected function setUsers()
    {
        if (empty($this->users)) {
            for ($i = 1; $i <= 10; $i++) {
                $this->users[] = [
                    'id' => $i,
                    'name' => "Test{$i}",
                    'email' => "test{$i}@test.com",
                    'password' => '111'
                ];
            }
        }

        session_start();

        if (!empty($_SESSION['user'])) {
            $this->users[] = $_SESSION['user'];
        }
    }
}
