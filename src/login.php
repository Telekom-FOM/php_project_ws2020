<?php
include("html_include/base.html");
echo "<title>Das ist ein Shop</title>";
include("html_include/header.html");
?>
<html>
    <body>
        <form method="POST">
            <input type="email" name="email" placeholder="email">
            <input type="submit">
</form>

<?php
include("php_include/db_user.php");
include("php_include/session.php");
if (isset($_POST["email"])){
    if(db_check_if_user($_POST["email"])) {
        echo "User exists!";
        session_create($_POST["email"]);
    }
    else {
        echo "User does not exist!";
    }
}