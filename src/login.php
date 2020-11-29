<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_user.php");

echo "<title>Das ist ein Shop</title>";
?>
<html>
    <body>
        <form method="POST">
            <input type="email" name="email" placeholder="email" requiered>
            <input type="password" name="password" placeholder="password" required>
            <input type="submit">
</form>
<a href="/register.php">Konto erstellen!</a>

<?php


if (isset($_POST["email"])){
    if(db_check_login($_POST["email"], $_POST["password"])) {
        echo "logged in!";
        session_create(db_get_user($_POST["email"]));
	header("Location: /");
    }
    else {
        echo "Invalid credentials!";
    }
}
