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

    $user = $_SESSION['user'];
    $idfetch = $db->prepare('SELECT id FROM users WHERE username=:user');
    $idfetch->bindValue(':user', $user, PDO::PARAM_STR);
    $idfetch->execute();
                    
    $userId = $idfetch->fetch(PDO::FETCH_ASSOC);
    $uId = $userId['id'];

    if(isset($_GET['budgetname'])) {
        $bName = $_GET['budgetname'];
        $stmt = $db->prepare('SELECT id FROM budgets WHERE name=:name');
        $stmt->bindValue(':name', $bName, PDO::PARAM_STR);
        $stmt->execute();
        $fetchedBudId = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($fetchedBudId);
        $bId = $fetchedBudId['id'];
    } else {
        $stmt = $db->prepare('SELECT id FROM budgets WHERE userId=:user');
        $stmt->bindValue(':user', $uId, PDO::PARAM_STR);
        $stmt->execute();
        $budId = $stmt->fetch(PDO::FETCH_ASSOC);
        $bId = $budId['id'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Budget Page</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="homepageStyle.css">
</head>

    
<body>

    <nav class="navbar navbar-expand-md navbar-light navColor fixed-top">
        <a class="navbar-brand" href="../index.html"><img class="logo" src="../ocean.png" alt="Ocean Picture"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.html">Home<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <button class="btn btn-outline-success my-2 my-sm-0" id="logOut" type="button" onclick="location.href='./logOut.php'">Log Out</button>
        </div>
    </nav>

    <main role="main" class="container">

        <div class="starter-template">
            <?php
                if(isset($_SESSION['user'])) {
                    $user = $_SESSION['user'];
                    $stmt = $db->prepare('SELECT display_name FROM public.users WHERE username=:user');
                    $stmt->bindValue(':user', $user, PDO::PARAM_STR);
                    $stmt->execute();
                    
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $userName = $rows[0]['display_name'];
                } else {
                    $user = "UnNamed";
                    $userName = "UnKnown";
                }
                
                echo "<h1>$userName's Budgets</h1>";
            ?>
        </div>
        
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle pull-right" type="button" id="budgetDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Budgets</button>
            <a href="createCategory.php?budgetid=<?php echo $bId; ?>"><button class="btn btn-success pull-right" type="button" id="addCategoryBtn">Add Category</button></a>
            <div class="dropdown-menu" aria-labelledby="budgetDropdown">
                <?php
                    foreach ($db->query("SELECT name FROM public.budgets WHERE userId=$uId") as $row)
                    {
                         echo "<button class='dropdown-item' type='button' onclick='location.href =\"budgetHomePage.php?budgetname=".$row['name'].";\"'>".$row['name']."</button>";
                    }
                    echo "<a class='dropdown-item' type='button' href='createBudget.php'>Add Budget</a>";
                ?>
            </div>
        </div>
        <br/>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td></td>
                    <?php
                        foreach ($db->query("SELECT categoryname FROM public.categories WHERE budgetId=$bId") as $row)
                        {
                            echo '<td>';
                            echo $row['categoryname'];
                            echo '</td>';
                        }
                    ?>
                </tr>
                    <?php
                        for ($i = 1; $i <= 4; $i++) {
                            echo "<tr><td>Week ".$i."</td>";
                            foreach ($db->query("SELECT goalfunds FROM public.goals WHERE categoryID=1 AND goalweek=$i") as $row)
                            {
                                echo '<td>';
                                echo $row['goalfunds'];
                                echo '</td>';
                            }
                            echo "</tr>";
                        }
                    ?>
            </table>
        </div>
    </main>
    <!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>