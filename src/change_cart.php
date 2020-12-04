<?php
include("php_include/basic_includes.php");
include("php_include/db_cart.php");

//Check if user is logged in
if (isset($_SESSION["user"]) && unserialize($_SESSION["user"])) {
    db_add_to_cart(unserialize($_SESSION['user'])->kd_nr, $_GET['id'], $_GET['amount']);
    header("Location: /cart.php");
    //else, force login
    
} else {
    $_SESSION["temp_cart"] = array(
        "id" => $_GET["id"],
        "amount" => $_GET["amount"]
    );
    header("Location: /login.php?source=cart");
    exit();
}

//if change -> cart-article change
if (isset($_GET["action"])) {
    if ($_GET["action"] == "Ändern") {
        if ($_GET["amount"] > 0) {
            db_change_cart_content($_GET["id"], $_GET["amount"], $_GET["article"]);
            //if article-amount set below 1 --> delete from cart
            
        } else {
            db_delete_cart_content($_GET["id"], $_GET["article"]);
        }
        //if delete -> cart-article delete
        
    } elseif ($_GET["action"] == "Löschen") {
        db_delete_cart_content($_GET["id"], $_GET["article"]);
    }
}
header("Location: /cart.php");