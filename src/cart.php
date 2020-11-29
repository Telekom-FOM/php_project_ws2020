<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_cart.php");

echo "<title>Das ist ein Shop</title>";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    echo "danke für die bestellung. Sie werden weitergeleitet";
    db_order(unserialize($_SESSION["user"]));
    header("Location: /orders.php?source=cart");
}
else {
    $cart = db_show_cart(unserialize($_SESSION["user"])->kd_nr);
    if ($cart) {
        echo "<table border=1><tr><th>ID</th><th>Name</th><th>Anzahl</th><th>Einzelpreis</th><th>Gesamtpreis</th></tr>";
        foreach($cart as $content) {
            echo "<tr><td>" . $content["id"] . "</td><td>". $content["name"] . "</td><td>" . $content["amount"] . "</td><td>" . $content["price"] . "</td><td>" . $content["price"]*$content["amount"] . "</td></tr>";
        }
        echo "</table>";
        echo "<form method='POST'>
        <input type='submit' name='order' value='bestellen'>
        </form>";
    }
    else {
        echo "Sie haben nichts im Einkaufswagen!";
    }
}
?>

