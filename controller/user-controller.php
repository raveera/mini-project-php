<?php
    require '../check-session.php';
    require '../model/user-model.php';

    $page = $_GET['page'];

    if (!$page) {
        header('location: ' . USER_CONTROLLER_PATH . '?page=login');
    }

    if ($_SESSION['user_id']) {
        header('location: ' . RECORD_CONTROLLER_PATH);
    }

    class UserContronller
    {
        private $userModel;

        function __construct()
        {
            $this->userModel = new UserModel;
        }

        public function register($username, $password, $name)
        {
            $userId = $this->userModel->getUser($username, $password);

            if ($userId) {
                $err = 'Username Exists';

                return $err;
            }

            $lastUserId = $this->userModel->createUser($username, $password, $name);
            $_SESSION['user_id'] = $lastUserId;
            header('location: ' . RECORD_CONTROLLER_PATH);
        }

        public function login($username, $password)
        {
            $userId = $this->userModel->getUser($username, $password);

            if (!$userId) {
                $err = 'Username or Password incorrect';

                return $err;
            }

            $_SESSION['user_id'] = $userId;
            header('location: ' . RECORD_CONTROLLER_PATH);
        }

        public function logout()
        {
            unset($_SESSION['user_id']);
            header('location: ' . USER_CONTROLLER_PATH);
        }
    }

    $userController = new UserContronller;
    $isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
     
    switch ($page) {
        case 'login':
            if ($isPost) {
                $err = $userController->login($username, $password);
            }

            include '../view/login-page.php';
            break;
        case 'logout':
            $userController->logout();
            break;
        case 'register':
            if ($isPost) {
                $err = $userController->register($username, $password, $name);
            }
            
            include '../view/register-page.php';
            break;
        case 'record-list':
            header('location: ' . RECORD_CONTROLLER_PATH);
            break;
        default:
            echo '404 Page not found';
            break;
    }
