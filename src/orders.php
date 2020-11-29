<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_cart.php");

echo "<title>Das ist ein Shop</title>";
echo "<pre>";
print_r(db_get_orders(unserialize($_SESSION["user"])->kd_nr));
