<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_cart.php");

echo "<title>Das ist ein Shop</title>";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    echo "danke für die bestellung. Sie werden weitergeleitet";
    db_order(unserialize($_SESSION["user"])->kd_nr);
    header("Location: /orders.php");
}
else {
    $cart = db_show_cart(unserialize($_SESSION["user"])->kd_nr);
    if ($cart) {
        echo "<pre>";
        print_r($cart);
        echo "<form method='POST'>
        <input type='submit' name='order' value='bestellen'>
        </form>";
    }
    else {
        echo "Sie haben nichts im Einkaufswagen!";
    }
}
?>

