<?php
    session_start();
    require 'constant.php';

    class CheckSession 
    {
        function __construct()
        {
            if (!$_SESSION['user_id']) {
                header('location: ' . USER_CONTROLLER_PATH);
            }
        }
    }
