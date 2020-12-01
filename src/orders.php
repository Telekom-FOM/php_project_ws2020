<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_cart.php");

echo "<title>Das ist ein Shop</title>";

if (!isset($_SESSION["user"])){
    header("Location: /");
}
else {
    if (isset($_GET["source"]) && $_GET["source"] == "cart") {
        echo "Vielen Dank für Ihre Bestellung!";
    }
    $orders = db_get_orders(unserialize($_SESSION["user"])->kd_nr);
    if ($orders){
        echo "<table border=1><tr><th>ID</th><th>Name</th><th>Anzahl</th><th>Einzelpreis in €</th><th>Gesamtpreis in €</th><th>Datum</th></tr>";
            foreach($orders as $content) {
                echo "<tr><td>" . $content["id"] . "</td><td>". $content["name"] . "</td><td>" . $content["amount"] . "</td><td>" . $content["price"] . "</td><td>" . $content["price"]*$content["amount"] . "</td>    <td>". date("d.M.Y", strtotime($content["date"])) . "</td></tr>";
            }
            echo "</table>";

    }
    else {
        echo "Sie haben bisher keine Bestellungen getätigt!";
    }
}
