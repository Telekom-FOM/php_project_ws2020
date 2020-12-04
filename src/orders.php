<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_cart.php");

echo "<title>Bestellungen</title>";

//check if user logged in else 
if (isset($_SESSION["user"])) {
    //if user made an order, show a confirmation
    if (isset($_GET["source"]) && $_GET["source"] == "cart") {
        echo "Vielen Dank für Ihre Bestellung! Sie Sehen nun Ihre getätigten Bestellungen";
    }
    //get orders
    $orders = db_get_orders(unserialize($_SESSION["user"])->kd_nr);
    
    //if user has any orders show them
    if ($orders) {
        echo "<table class='styled-table' border=1><tr><th>Bestellnummer</th><th>Name</th><th>Anzahl</th><th>Einzelpreis in €</th><th>Gesamtpreis in €</th><th>Datum</th></tr>";
        foreach ($orders as $content) {
            echo "<tr><td>" . $content["id"] . "</td><td><a href='/detail.php?id=" . $content["fk_article"] . "'>" . $content["name"] . "</a></td><td>" . $content["amount"] . "</td><td>" . $content["price"] . "</td><td>" . $content["price"] * $content["amount"] . "</td>    <td>" . date("d.M.Y", strtotime($content["date"])) . "</td></tr>";
        }
        echo "</table>";
        
    }
    //if no orders show message
    else {
        echo "Sie haben bisher keine Bestellungen getätigt!";
    }
}
//redirect to index.php
else {
    header("Location: /");
}