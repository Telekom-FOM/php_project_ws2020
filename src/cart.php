<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_cart.php");

echo "<title>Warenkorb</title>";

//Deletes existing temporary cart
if (isset($_SESSION["temp_cart"])) {
    unset($_SESSION["temp_cart"]);
}

//If POST on the site, order is being executed and user is redirected to orders.php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    echo "danke für die bestellung. Sie werden weitergeleitet";
    db_order(unserialize($_SESSION["user"]));
    header("Location: /orders.php?source=cart");
}
//else, user is shown cart if exists
else {
    $cart = db_show_cart(unserialize($_SESSION["user"])->kd_nr);
    if ($cart) {
        echo "<table class='styled-table' border=1><tr><th>ID</th><th>Name</th><th>Anzahl</th><th>Einzelpreis in €</th><th>Gesamtpreis in €</th></tr>";
        foreach ($cart as $content) {
            echo "<tr><form action='/change_cart.php' id='" . $content["fk_article"] . "' method='get'>
        <input type='hidden' class='form__field' form='" . $content["fk_article"] . "' name ='id' value='" . $content["id"] . "' readonly>
        <input type='hidden' value='" . $content["fk_article"] . "' name='article' readonly>
        <td>" . $content["fk_article"] . "</td>
        <td>" . $content["name"] . "</td>
        <td><input type='number' class='form__field' form='" . $content["fk_article"] . "'value='" . $content["amount"] . "' name='amount' required></td>
        <td>" . $content["price"] . "</td>
        <td>" . $content["price"] * $content["amount"] . "</td>
        <td><input type='submit' class='form__field' form='" . $content["fk_article"] . "'name='action' value='change'></td>
        <td><input type='submit' class='form__field' form='" . $content["fk_article"] . "' name='action' value='delete'></td></tr></form>";
        }
        echo "<form method='POST'>
        <input type='submit' name='order' value='bestellen'>
        </form>";
    }
    //else, user is getting info that no cart belongs to him
    else {
        echo "Sie haben nichts im Einkaufswagen!";
    }
}