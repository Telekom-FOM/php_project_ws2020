<?php
require_once("php_include/session.php");
require_once("php_include/db_cart.php");

if (isset($_SESSION['user'])) {
db_add_to_cart(unserialize($_SESSION['user'])->kd_nr,$_GET['id'], $_GET['amount']);
}

else {
    $_SESSION["temp_cart"] = array("id"=>$_GET["id"],"amount"=>$_GET["amount"]);
    header("Location: /login.php?source=cart");
}
//header("Location: /cart.php");

