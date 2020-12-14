<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_cart.php");

echo "<title>Kasse</title>";

//If POST on the site, order is being executed and user is redirected to orders.php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    db_order(unserialize($_SESSION["user"]));
    header("Location: /orders.php?source=cart");
}
//else, user is shown cart if exists
else {
    echo "<p>Die Bestellung wird an folgende Adresse gesendet:<br>";
    echo unserialize($_SESSION["user"])->street . "<br>";
    echo unserialize($_SESSION["user"])->zip . " " . unserialize($_SESSION["user"])->city . "<br>";
    echo unserialize($_SESSION["user"])->country;
    $cart = db_show_cart(unserialize($_SESSION["user"])->kd_nr);
    if ($cart) {
        $sum = 0;
        echo "<table class='styled-table' border=1><tr><th>ID</th><th>Name</th><th>Anzahl</th><th>Einzelpreis in €</th><th>Gesamtpreis</th></tr>";
        foreach ($cart as $content) {
            echo "<tr>
        <td>" . $content["fk_article"] . "</td>
        <td><a href='/detail.php?id=" . $content["fk_article"] . "'>" . $content["name"] . "</a></td>
        <td>" . $content["amount"] . "</td>
        <td>" . $content["price"] . " €</td>
        <td>" . $content["price"] * $content["amount"] . " €</td></tr>";
        $sum += $content["price"] * $content["amount"];
        }
        echo "<tr><td></td><td></td><td></td><td></td><td>$sum €</td></tr></table>";
        echo "<form method='POST'>
        <input type='submit' name='order' class='form__field' value='kostenpflichtig bestellen'>
        </form>";

    }
    //else, user gets redirected to index
    else {
        header("Location: /");
    }
}