<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_cart.php");

echo "<title>Das ist ein Shop</title>";

if (!isset($_SESSION["user"])){
    header("Location: /");
}
$orders = db_get_orders(unserialize($_SESSION["user"])->kd_nr);
if ($orders){
    echo "<pre>";
    print_r($orders);
}
else {
    echo "Sie haben bisher keine Bestellungen getätigt!";
}
