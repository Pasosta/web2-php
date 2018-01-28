<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>View Cart</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="homepageStyle.css">
</head>

    
<body>

    <nav class="navbar navbar-expand-md navbar-light navColor fixed-top">
        <a class="navbar-brand" href="#"><img class="logo" src="../ocean.png" alt="Ocean Picture"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.html">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./shoppingCart.php">Shopping</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Shopping Cart</a>
                </li>
            </ul>
        </div>
    </nav>

    <main role="main" class="container">

        <div class="starter-template">
            <h1>Shopping Cart</h1>
        </div>
        <div class="table-responsive">
            <table class="table">
                <?php
                    $rows = sizeof($_SESSION["cart"]);
                    $itemTypes = array( 1 => "Standard Widget", 2 => "Ye Olde Widget", 3 => "Rich Man's Widget", 4 => "Poor Man's Widget",
                                        5 => "Sparky Widget", 6 => "Pointy Widget", 7 => "Melty Widget", 8 => "Midnight Samba Widget");
                    for ($i = 0; $i <= 7; $i++) {
                        if(isset($_SESSION["cart"][$i]) && $_SESSION["cart"][$i]["quantity"] > 0) {
                            echo "<tr class=\"".($i + 1)."\"><td><img class=\"smItemImage\" src=\"images/wid".($i + 1).".png\" alt=\"item number".($i + 1)."\"></td>";
                            echo "<td>".$itemTypes[$i + 1]."</td><td>Quantity: <input type=\"number\" name=\"item".($i + 1)."\" value=\"".$_SESSION["cart"][$i]["quantity"]."\" id=\"item".($i + 1)."\"></td>";
                            echo "<td><button type=\"button\" class=\"btn btn-primary\" onclick=\"updateCart(".($i + 1).", document.getElementById('item".($i + 1)."').value";
                            echo ")\">Update</button></td>";
                            echo "<td><button type=\"button\" class=\"btn btn-danger\" onclick=\"removeItem(".($i + 1);
                            echo ")\">Remove</button></td></tr>";
                        }
                        if($rows == 0) {
                            echo "<div class=\"starter-template\"><h1>No Items To Display</h1></div>";
                        }
                    }
                ?>
            </table>
            <div class="center">
                <button type="button" class="btn btn-success" onclick="location.href='./checkout.php'">Check Out</button>
            </div>
        </div>

    </main>
    <!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript" src="shopping.js"></script>
</body>
</html>