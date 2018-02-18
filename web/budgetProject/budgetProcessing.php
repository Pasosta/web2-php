<?php
    session_start();

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    $dbUrl = getenv('DATABASE_URL');
    console_log("1");
    $dbopts = parse_url($dbUrl);

    $dbHost = $dbopts["host"];
    $dbPort = $dbopts["port"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    if(isset($_REQUEST['create']))
    {
        console_log("2");
        //will need to check to see if these are filled, will do later
        $name = htmlspecialchars($_REQUEST['name']);
        $username = $_SESSION['user'];
        $useridStmt = $db->prepare('SELECT id FROM users WHERE username = :username');
        $useridStmt->bindValue(':username', $username, PDO::PARAM_STR);
        $useridStmt->execute();
        $userid = $useridStmt->fetch(PDO::FETCH_ASSOC);
        console_log("3");
        $stmt = $db->prepare('INSERT INTO budgets(name, userid) VALUES (:name, :userid)');
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
        $stmt->execute();
        console_log("4");
        $newBudId = $db->lastInsertId("budgets_id_seq");
        header("Location: ./createCategory.php?budgetid=$newBudId");
        die();
    }
?>