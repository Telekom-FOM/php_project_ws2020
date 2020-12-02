<?php
include("php_include/basic_includes.php");
include("php_include/db_article.php");

//Check if user is an admin (permited to make changes)
if (isset($_SESSION["user"]) && unserialize($_SESSION["user"])->is_admin == "1") {
    //if change -> article change
    if ($_GET["action"] == "change") {
        db_change_category($_GET["id"], $_GET["name"]);
    } elseif ($_GET["action"] == "delete") {
        //if delete -> article delete
        db_delete_category($_GET["id"]);
    } elseif ($_GET["action"] == "add") {
        //if add -> article add
        db_add_category($_GET["name"]);
    }
}

header("Location: /admin.php");