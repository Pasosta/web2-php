<?php
    session_start();
    if(isset($_REQUEST['logIn']))
    {
        $user = htmlspecialchars($_REQUEST['userNameBox']);
        $inputpass = htmlspecialchars($_REQUEST['passwordBox']);
        
        
        $useridStmt = $db->prepare('SELECT password FROM users WHERE username = :username');
       // $useridStmt->bindValue(':username', $user, PDO::PARAM_STR);
      //  $useridStmt->execute();
//        
//        $dbpass = $useridStmt->fetch(PDO::FETCH_ASSOC);
//        
//        if (password_verify($inputpass, $dbpass)) {
//            if(!isset($_SESSION['user']))
//            {
//                $_SESSION['user'] = $user;
//            }
//            header('Location: ./budgetHomePage.php');
//            die();
//        } else {
//            header('Location: ./login.php');
//            die();
//        }
        
    }
?>
 