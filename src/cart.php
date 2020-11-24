<?php
require_once("html_include/base.html");
echo "<title>Das ist ein Shop</title>";
require_once("php_include/session.php");
require_once("html_include/header.php");
require_once("php_include/db_cart.php");

echo "<pre>";
print_r(db_show_cart($_SESSION["user"]));
