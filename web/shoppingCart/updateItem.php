<?php
    session_start();
    $howMany = $_REQUEST["quantity"];
    settype($howMany, "integer");
    $_SESSION["cart"][$_REQUEST["item"] - 1]["quantity"] = $howMany;
?>