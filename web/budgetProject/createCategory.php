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

    <title>Category Creation</title>

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
        </div>
    </nav>

    <main role="main" class="container">

        <div class="starter-template">
            <h1>Category Creation</h1>
            <form action="./categoryProcessing.php" method="post">
                <input type="text" name="name" placeholder="Category Name" required><br/><br/>
                <input type="hidden" name="budgetid" value="<?php echo $_GET['budgetid']; ?>"/>
                Week 1: <input type="number" min="1" step="any" name="wk1" required><br/><br/>
                Week 2: <input type="number" min="1" step="any" name="wk2" required><br/><br/>
                Week 3: <input type="number" min="1" step="any" name="wk3" required><br/><br/>
                Week 4: <input type="number" min="1" step="any" name="wk4" required><br/><br/>
                <input type="submit" name="create" class="btn btn-primary btn-md" value="Create">
            </form>
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