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

    if(isset($_REQUEST['create']))
    {
        //will need to check to see if these are filled, will do later
        $user = htmlspecialchars($_REQUEST['userNameBox']);
        $pass = htmlspecialchars($_REQUEST['passwordBox']);
        $display = htmlspecialchars($_REQUEST['displayBox']);
        
        $stmt = $db->prepare('INSERT INTO users(username, password, display_name) VALUES (:user, :pass, :display)');
        $stmt->bindValue(':user', $user, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindValue(':display', $display, PDO::PARAM_STR);
        $stmt->execute();
        
        header('Location: ./budgetHomePage.php');
        die();
    }
?>