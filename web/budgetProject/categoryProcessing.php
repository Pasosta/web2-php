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
        $budid = $_GET['budgetid'];
        var_dump($budid);
        $wk1 = htmlspecialchars($_REQUEST['wk1']);
        $wk2 = htmlspecialchars($_REQUEST['wk2']);
        $wk3 = htmlspecialchars($_REQUEST['wk3']);
        $wk4 = htmlspecialchars($_REQUEST['wk4']);
        $name = htmlspecialchars($_REQUEST['name']);
        var_dump($name);
        $stmt = $db->prepare('INSERT INTO categories(categoryname, budgetid) VALUES (:name, :budid)');
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':budid', $budid, PDO::PARAM_INT);
        $stmt->execute();
        
        //header('Location: ./budgetHomePage.php');
        //die();
    }
?>