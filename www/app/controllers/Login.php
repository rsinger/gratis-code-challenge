<?php

namespace App\Controllers;

use App\Services\Users;

class Login extends BaseController
{
    public function showLoginForm()
    {
        echo "Displaying login form.";
    }

    public function checkCredentials()
    {
        $users = new Users($this->db);
        $user = $users->getUserByEmailAndPassword($_POST['email'], $_POST['password']);
        if ($user) {
            $_SESSION['userId'] = $user->getId();
            $_SESSION['message'] = "Login successful.";
            header('Location: /');
            exit();
        } else {
            $this->messages[] = "Invalid email or password.";
            $this->render('login.latte');
        }
    }

    public function createAccount()
    {
        if ($_POST['password'] !== $_POST['passwordConfirmation']) {
            $this->messages[] = "Passwords do not match.";
            $this->render('create_user.latte');
            return;
        }
        $users = new Users($this->db);
        $users->createUser($_POST['email'], $_POST['password'], (int)$_POST['locationId']);
        $_SESSION['message'] = "Account created successfully. Please log in.";
        header('Location: /login');
        exit();
    }

    public static function handleRequest()
    {
        $controller = new self();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller->showLoginForm();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            switch ($_SERVER['REQUEST_URI']) {
                case '/login':
                    $controller->checkCredentials();
                    break;
                case '/login/create-account':
                    $controller->createAccount();
                    break;
                default:
                    http_response_code(404);
                    echo "404 Not Found";
                    break;
            }
        } else {
            http_response_code(405);
            echo "405 Method Not Allowed";
        }
    }
}