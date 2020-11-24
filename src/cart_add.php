<?php

require_once("php_include/session.php");
require_once("php_include/db_cart.php");

db_add_to_cart($_SESSION['user'],$_GET['id'], $_GET['amount']);
header("Location: /cart.php");

