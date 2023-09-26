<?php

namespace app\controllers;

use app\models\Main;

class MainController extends AppController
{
    public $error;
    public $view = 'index';
    protected $user;

    public function indexAction()
    {
        if (empty($_SESSION['user'])) {
            $this->view = 'add';
        } else {
            $data = $this->users;
            $this->set(compact('data'));

            session_unset();
            session_destroy();
        }
    }

    public function addAction()
    {
        $this->validateForm();

        if (empty($this->error)) {
            $this->layout = false;
            $this->addUsers();
            $_SESSION['user'] = $this->user;
        } else {
            $this->view = 'add';
            $dataForm = $this->postParams;
            $error = $this->error;
            $this->set(compact('dataForm', 'error'));
        }
    }

    private function validateForm()
    {
        if (!empty($this->postParams['email'])) {
            if (!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $this->postParams['email'])) {
                $this->error['email'] = 'Введіть коректну email адресу.';
            }
        } else {
            $this->error['email'] = 'Будь ласка заповніть email адресу.';
        }

        if (!empty($this->postParams['password'])) {
            if ($this->postParams['password'] !== $this->postParams['confirmPassword']) {
                $this->error['password'] = 'Пароль не співпадає з підтвердженням.';
            }
        } else {
            $this->error['password'] = 'Будь ласка заповніть password.';
        }
    }

    private function addUsers()
    {
        $id = 0;

        if (!empty($this->users)) {
            $id = $this->findId();
        }

        $this->user = [
            'id' => $id,
            'name' => ($this->postParams['lastName'] ?? '') . ' ' . ($this->postParams['firstName'] ?? ''),
            'email' => $this->postParams['email'] ?? '',
            'password' => $this->postParams['password'] ?? ''
        ];

        $this->logAccess();
    }

    private function findId()
    {
        $currentId = null;

        foreach ($this->users as $item) {
            $id = $item['id'];

            if ($currentId === null || $id === $currentId) {
                $currentId = $id + 1;
            } else {
                return $currentId;
            }
        }

        return $currentId;
    }

    private function logAccess()
    {
        $time = date('H:i:s') . " : ";
        $logContent = "$time Додано користувача - Ім'я: {$this->user['name']}, Email: {$this->user['email']}\n";

        foreach ($this->users as $item) {
            if ($this->user['email'] === $item['email']) {
                $logContent .= "$time \t Дубликат email - Ім'я: {$item['name']}, Email: {$item['email']}\n";
            }
        }

        $logFileName = ROOT . "/log/" . date("Y_m_d") . ".log";
        file_put_contents($logFileName, $logContent, FILE_APPEND);
    }
}
