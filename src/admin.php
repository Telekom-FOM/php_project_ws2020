<?php
include("html_include/base.html");
echo "<title>Das ist ein Shop</title>";
include("html_include/header.html");
include('php_include/db_user.php');
include('php_include/db_article.php');
print_r(db_get_all_user());
echo "<br><pre>";
print_r(db_get_all_article());