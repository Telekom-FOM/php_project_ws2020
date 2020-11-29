<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_user.php");

echo "<title>Das ist ein Shop</title>";
?>
<html>
    <body>
        <form method="POST">
            <label for="email"><b>Email</b></label>
            <input type="email" name="email" requiered><br>
            <label for="password"><b>Passwort</b></label>
            <input type="password" name="password" required><br>
            <label for="firstname"><b>Vorname</b></label>
            <input type="text" name="firstname" required><br>
            <label for="lastname"><b>Nachname</b></label>
            <input type="text" name="lastname" required><br>
            <label for="street"><b>Straße</b></label>
            <input type="text" name="street" required><br>
            <label for="zip"><b>PLZ</b></label>
            <input type="text" name="zip" required><br>
            <label for="city"><b>Stadt</b></label>
            <input type="text" name="city" required><br>
            <label for="country"><b>Land</b></label>
            <input type="text" name="country" required><br>
            <label for="phone"><b>Telefon</b></label>
            <input type="text" name="phone" required>
            <input type="submit">
</form>

<?php


if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["street"]) && isset($_POST["zip"]) && isset($_POST["city"]) && isset($_POST["phone"])){
    if(!db_check_if_user($_POST["email"])) {
        db_create_user($_POST["email"], $_POST["password"], $_POST["firstname"], $_POST["lastname"], $_POST["street"], $_POST["zip"], $_POST["city"], $_POST["country"], $_POST["phone"]);
    }
    else {
        echo "email schon vorhanden";
    }
}
