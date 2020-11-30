<?php
include("php_include/basic_includes.php");
include("php_include/db_article.php");

if(isset($_SESSION["user"]) && unserialize($_SESSION["user"])->is_admin == "1") {
    if ($_GET["action"] == "change") {
        db_change_category($_GET["id"], $_GET["name"]);
}
elseif ($_GET["action"] == "delete") {
    db_delete_category($_GET["id"]);
}
elseif ($_GET["action"] == "add") {
    db_add_category($_GET["name"]);
}
}

header("Location: /admin.php");