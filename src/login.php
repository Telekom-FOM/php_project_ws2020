<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_user.php");

echo "<title>Login</title>";

if (isset($_GET["source"]) && $_GET["source"] == "cart") {
    echo "Bitte loggen Sie sich ein um den Warenkorb zu nutzen!";
}
?>
<html>
    <body>
        <form method="POST">
            <input type="email" name="email" placeholder="email" requiered>
            <input type="password" name="password" placeholder="password" required>
            <input type="submit" value="Login">
</form><br>
<form action="/register.php">
<input type="submit" value="Konto erstellen!">
</form>

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
