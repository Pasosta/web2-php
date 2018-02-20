<?php
    session_start();
    if(isset($_REQUEST['logIn']))
    {
        $user = htmlspecialchars($_POST['userNameBox']);
        $pass = htmlspecialchars($_POST['passwordBox']);
        if(!isset($_SESSION['user']))
        {
            $_SESSION['user'] = $user;
        }
        header('Location: ./budgetHomePage.php');
        die();
    }
?>
 