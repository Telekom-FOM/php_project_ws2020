<?php
include("html_include/base.html");
echo "<title>Das ist ein Shop</title>";
include("html_include/header.html");
include('php_include/db_user.php');
include('php_include/db_article.php');
session_start();
echo $_SESSION["user"], '<br>';

$users = db_get_all_user();

echo "<table border = 1><tr><th>Kundennummer</th><th>Email</th><th>Vorname</th><th>Nachname</th><th>Straße</th><th>PLZ</th><th>Stadt</th><th>Land</th><th>Telefon</th><tr>";
foreach($users as $user) {
    echo "<tr><td>", $user["kd_nr"], "</td><td>", $user["email"], "</td><td>" , $user["firstname"], "</td><td>" , $user["lastname"] , "</td><td>", $user["street"], "</td><td>", $user["zip"], "</td><td>", $user["city"], "</td><td>", $user["country"], "</td><td>", $user["phone"],"</td></tr>";
}
echo "</table>";
echo "<br><pre>";
print_r(db_get_all_article());