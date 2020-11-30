<?php
require_once("php_include/basic_includes.php");
require_once('php_include/db_user.php');
require_once('php_include/db_article.php');

echo "<title>Das ist ein Shop</title>";
if (!isset($_SESSION['user']) || (unserialize($_SESSION['user'])->is_admin == "0")) {
    header("Location: /");
}

//Print logs for debugging
if (isset($_SESSION['log']) && $_GET["log"] == "access" | $_GET["log"] == "error") {
    if ($_GET["log"] == "access") {
        $log = fopen("/var/log/apache2/access.log", "r");
    }
    else {
        $log = fopen("/var/log/apache2/error.log", "r");
    }
    echo "<table border = 1>";
    while (($line = fgets($log)) !== false) {
        echo "<tr><td>$line</td></tr>";
    }
    fclose($log);
}

$users = db_get_all_user();

echo "<table border = 1><tr><th>Kundennummer</th><th>Email</th><th>Vorname</th><th>Nachname</th><th>Straße</th><th>PLZ</th><th>Stadt</th><th>Land</th><th>Telefon</th><tr>";
foreach($users as $user) {
    echo "<tr><td>", $user->kd_nr, "</td><td>", $user->email, "</td><td>" , $user->firstname, "</td><td>" , $user->lastname , "</td><td>", $user->street, "</td><td>", $user->zip, "</td><td>", $user->city, "</td><td>", $user->country, "</td><td>", $user->phone,"</td></tr>";
}
echo "</table>";
echo "<br><pre>";
print_r(db_get_all_article());

//Print categories
$categories = db_get_categories();
echo "<table border=1><tr><th>ID</th><th>Name</th></tr>";
foreach($categories as $category) {
    echo "<tr><td><form action='/change_category.php' method='get'><input type='text' name ='id' value='" . $category->id . "' readonly></td><td><input type='text' value='" . $category->name . "' name='name'></td><td><input type='submit' name='action' value='change'><td><input type='submit' name='action' value='delete'></td></form></tr>"; 
}
echo "<tr><td><form action='/change_category.php' method='get'><input type='text' name ='id' value='auto_increment' readonly></td><td><input type='text' value='' placeholer='Kategoriename' name='name'></td><td><input type='submit' name='action' value='add'></form></tr>";
