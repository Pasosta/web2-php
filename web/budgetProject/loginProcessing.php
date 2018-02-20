<?php
    session_start();

    $dbUrl = getenv('DATABASE_URL');
    $dbopts = parse_url($dbUrl);

    $dbHost = $dbopts["host"];
    $dbPort = $dbopts["port"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    if(isset($_REQUEST['logIn']))
    {
        $user = htmlspecialchars($_REQUEST['userNameBox']);
        $inputpass = htmlspecialchars($_REQUEST['passwordBox']);
        
        
        $useridStmt = $db->prepare('SELECT password FROM users WHERE username = :username');
        $useridStmt->bindValue(':username', $user, PDO::PARAM_STR);
        $useridStmt->execute();
        
        $dbpass = $useridStmt->fetch(PDO::FETCH_ASSOC);
        
        
        if (password_verify($inputpass, $dbpass["password"])) {
            if(!isset($_SESSION['user']))
            {
                $_SESSION['user'] = $user;
            }
            header('Location: ./budgetHomePage.php');
            die();
        } else {
            header('Location: ./login.php');
            die();
        }
        
    }
?>
 