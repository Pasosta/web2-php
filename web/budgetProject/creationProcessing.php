<?php
    session_start();
    if(isset($_REQUEST['create']))
    {
        $user = htmlspecialchars($_REQUEST['userNameBox']);
        $pass = htmlspecialchars($_REQUEST['passwordBox']);
        if(!isset($_SESSION['user']))
        {
            $_SESSION['user'] = $user;
        }
        header('Location: ./budgetHomePage.php');
    }
?>