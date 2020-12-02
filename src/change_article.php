<?php
include("php_include/basic_includes.php");
include("php_include/db_article.php");

//Check if user is an admin (permited to make changes)
if (isset($_SESSION["user"]) && unserialize($_SESSION["user"])->is_admin == "1") {
    //if change -> article change
    if ($_GET["action"] == "change") {
        db_change_article($_GET["id"], $_GET["name"], $_GET["price"], $_GET["category"]);
    }
    //if delete -> article delete
    elseif ($_GET["action"] == "delete") {
        db_delete_article($_GET["id"]);
    }
    //if add -> article add
    elseif ($_GET["action"] == "add") {
        db_add_article($_GET["name"], $_GET["price"], $_GET["category"]);
    }
}

header("Location: /admin.php");