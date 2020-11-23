<?php
include("html_include/base.html");
echo "<title>Das ist ein Shop</title>";
include("php_include/session.php");
include("html_include/header.php");
?>
<html>
    <body>
        <form method="POST">
            <input type="email" name="email" placeholder="email" requiered>
            <input type="password" name="password" placeholder="password" required>
            <input type="submit">
</form>

<?php
include("php_include/db_user.php");

if (isset($_POST["email"])){
    if(db_check_login($_POST["email"], $_POST["password"])) {
        echo "logged in!";
        session_create($_POST["email"]);
    }
    else {
        echo "Invalid credentials!";
    }
}