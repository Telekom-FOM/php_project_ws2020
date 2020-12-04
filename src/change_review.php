<?php
include("php_include/basic_includes.php");
include("php_include/db_review.php");

if (isset($_GET["art_id"])) {
    if (isset($_GET["art_id"],$_GET["user_id"],$_GET["stars"],$_GET["message"])) {
        db_add_review($_GET["art_id"],$_GET["user_id"],$_GET["stars"],$_GET["message"]);
    }
    elseif (isset($_GET["art_id"],$_GET["user_id"],$_GET["message"],$_GET["id"])){
        echo $_GET["art_id"],$_GET["user_id"],$_GET["message"],$_GET["id"];
        db_add_response($_GET["art_id"],$_GET["user_id"],$_GET["message"],$_GET["id"]);
    }
    elseif ($_GET["id"]) {
        db_delete_review($_GET["id"]);
    }
    header("Location: /detail.php?id=" . $_GET["art_id"]);
}
else {
    header("Location: /");
}

