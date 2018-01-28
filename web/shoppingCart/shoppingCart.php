<?php
    include_once('cartLogic.php');
    session_start();
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
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

    <title>Shopping Page</title>

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
                <li class="nav-item active">
                    <a class="nav-link" href="#">Shopping</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./viewCart.php">Shopping Cart</a>
                </li>
            </ul>
               <button class="btn btn-outline-success my-2 my-sm-0" id="cartButton" type="button" onclick="location.href='./viewCart.php'"><img src="images/box.svg" alt="Shopping Cart"><div id="cartNum">0</div></button>
        </div>
    </nav>

    <main role="main" class="container">

        <div class="starter-template">
            <h1>Pick A Widget!</h1>
            <p>There are many like them but this one could be yours!<br></p>
        </div>
        <div class="table-responsive">
            <table class="table">
                <?php
                    $rows = 2;
                    $columns = 4;
                    $itemNumber = 1;
                    $itemTypes = array( 1 => "Standard Widget", 2 => "Ye Olde Widget", 3 => "Rich Man's Widget", 4 => "Poor Man's Widget",
                                        5 => "Sparky Widget", 6 => "Pointy Widget", 7 => "Melty Widget", 8 => "Midnight Samba Widget");
                    for ($i = 0; $i < $rows; $i++) {
                        echo "<tr>";
                        for ($j = 0; $j < $columns; $j++) {
                            echo "<td><img class=\"itemImage\" src=\"images/wid".$itemNumber.".png\" alt=\"item number".$itemNumber."\"><br/>";
                            echo "<p>".$itemTypes[$itemNumber]."</p>";
                            echo "<input type=\"number\" name=\"item".$itemNumber."\" value=\"0\" id=\"item".$itemNumber."\"><button onclick=\"addToCart(".$itemNumber.", document.getElementById('item".$itemNumber."').value";
                            echo ")\" class=\"btn btn-outline-success my-2 my-sm-0\" type=\"submit\"><img src=\"images/shoppingCart.svg\" alt=\"Shopping Cart\"></button>";
                            $itemNumber++;
                            echo "</td>";
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
    
    <script type="text/javascript" src="shopping.js"></script>

</body>
</html>