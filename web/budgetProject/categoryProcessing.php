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
        $budid = $_REQUEST['budgetid'];
 
        $wk1 = htmlspecialchars($_REQUEST['wk1']);
        $wk2 = htmlspecialchars($_REQUEST['wk2']);
        $wk3 = htmlspecialchars($_REQUEST['wk3']);
        $wk4 = htmlspecialchars($_REQUEST['wk4']);
        $name = htmlspecialchars($_REQUEST['name']);

        $stmt = $db->prepare('INSERT INTO categories(categoryname, budgetid) VALUES (:name, :budid)');
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':budid', $budid, PDO::PARAM_INT);
        $stmt->execute();
        
        $catid = $db->lastInsertId("categories_id_seq");
        
        $weeksstmt = $db->prepare('INSERT INTO public.goals(goalFunds, goalWeek, categoryID, budgetId) VALUES(:wk1, 1, :catid, :budid),(:wk2, 2, :catid, :budid),(:wk3, 3, :catid, :budid),(:wk4, 4, :catid, :budid)');
        $weeksstmt->bindValue(':wk1', $wk1, PDO::PARAM_STR);
        $weeksstmt->bindValue(':wk2', $wk2, PDO::PARAM_STR);
        $weeksstmt->bindValue(':wk3', $wk3, PDO::PARAM_STR);
        $weeksstmt->bindValue(':wk4', $wk4, PDO::PARAM_STR);
        $weeksstmt->bindValue(':catid', $catid, PDO::PARAM_STR);
        $weeksstmt->bindValue(':budid', $budid, PDO::PARAM_INT);
        
        $weeksstmt->execute();
        header('Location: ./budgetHomePage.php');
        die();
    }
?>