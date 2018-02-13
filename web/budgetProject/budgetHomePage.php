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
                    echo var_dump($rows);
                    $userName = $rows['display_name'];
                } else {
                    $user = "UnNamed";
                    $userName = "UnKnown";
                }
                
                echo "<h1>$userName's Budgets</h1>";
            ?>
        </div>
        
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle pull-right" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Budgets</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <?php
                    foreach ($db->query('SELECT name FROM public.budgets WHERE userId=1') as $row)
                    {
                         echo "<button class='dropdown-item' type='button'>".$row['name']."</button>";
                    }
                ?>
            </div>
        </div>
        <br/>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td></td>
                    <?php
                        foreach ($db->query('SELECT categoryname FROM public.categories WHERE budgetId=1') as $row)
                        {
                            echo '<td>';
                            echo $row['categoryname'];
                            echo '</td>';
                        }
                    ?>
                </tr>
                <tr>
                    <td>Week 1</td>
                    <?php
                        foreach ($db->query('SELECT goalfunds FROM public.goals WHERE categoryID=1 AND goalweek=1') as $row)
                        {
                            echo '<td>';
                            echo $row['goalfunds'];
                            echo '</td>';
                        }
                    ?>
                </tr>
                <tr>
                    <td>Week 2</td>
                    <?php
                        foreach ($db->query('SELECT goalfunds FROM public.goals WHERE categoryID=1 AND goalweek=2') as $row)
                        {
                            echo '<td>';
                            echo $row['goalfunds'];
                            echo '</td>';
                        }
                    ?>
                </tr>
                <tr>
                    <td>Week 3</td>
                    <?php
                        foreach ($db->query('SELECT goalfunds FROM public.goals WHERE categoryID=1 AND goalweek=3') as $row)
                        {
                            echo '<td>';
                            echo $row['goalfunds'];
                            echo '</td>';
                        }
                    ?>
                </tr>
                <tr>
                    <td>Week 4</td>
                    <?php
                        foreach ($db->query('SELECT goalfunds FROM public.goals WHERE categoryID=1 AND goalweek=4') as $row)
                        {
                            echo '<td>';
                            echo $row['goalfunds'];
                            echo '</td>';
                        }
                    ?>
                </tr>
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