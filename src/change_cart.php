<?php
include("php_include/basic_includes.php");
include("php_include/db_cart.php");
    if ($_GET["action"] == "change") {
        if ($_GET["amount"] > 0) {
            db_change_cart_content($_GET["id"], $_GET["amount"], $_GET["article"]);
        }
        else {
        db_delete_cart_content($_GET["id"], $_GET["article"]);
        }
}
elseif ($_GET["action"] == "delete") {
    db_delete_cart_content($_GET["id"], $_GET["article"]);
}

header("Location: /cart.php");