<?php
include("php_include/basic_includes.php");
include("php_include/db_article.php");

if(isset($_SESSION["user"]) && unserialize($_SESSION["user"])->is_admin == "1") {
    if ($_GET["action"] == "change") {
        db_change_article($_GET["id"], $_GET["name"], $_GET["price"], $_GET["category"]);
}
elseif ($_GET["action"] == "delete") {
    db_delete_article($_GET["id"]);
}
elseif ($_GET["action"] == "add") {
    db_add_article($_GET["name"], $_GET["price"], $_GET["category"]);
}
}

header("Location: /admin.php");