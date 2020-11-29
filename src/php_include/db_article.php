<?php
require_once("php_include/db_basic.php");
//Returns category ids
function db_get_categories() {
    $mysqli = db_connect();
    $sql = "SELECT * FROM article_category";
    $res = $mysqli->query($sql);
    $categorys = array();
    while ($row = $res->fetch_assoc()) {
        $categorys[] = $row['name'];
    }
    return $categorys;
} 

//Returns articles from category or FALSE if no articles
function db_get_articles_from_category($cat_id) {
    $mysqli = db_connect();
    $sql = "SELECT * FROM article where category=?";
    $con = $mysqli->prepare($sql);
    $con->bind_param("i", $cat_id);
    $con->execute();
    $res = $con->get_result();
    if ($res->num_rows == 0) {
        return FALSE;
    }
    else {
            $articles = array();
            $i = 0;
            while ($row = $res->fetch_assoc()) {
                $articles[$i] = new Article();
                $articles[$i]->id = $row['article_nr'];
                $articles[$i]->name = $row['name'];
                $articles[$i]->price = $row['price'];
                $articles[$i]->category = $row['category'];
                $i++;
            }
    }
    return $articles;
}

function db_get_article_from_id($art_id) {
    $mysqli = db_connect();
    $sql = "SELECT * FROM article where article_nr=?";
    $con = $mysqli->prepare($sql);
    $con->bind_param("i", $art_id);
    $con->execute();
    $res = $con->get_result();
    if ($res->num_rows == 0) {
        return FALSE;
    }
    else {
            $articles = array();
            $i = 0;
            while ($row = $res->fetch_assoc()) {
                $articles[$i] = new Article();
                $articles[$i]->id = $row['article_nr'];
                $articles[$i]->name = $row['name'];
                $articles[$i]->price = $row['price'];
                $articles[$i]->category = $row['category'];
                $i++;
            }
    }
    return $articles;
}

function db_get_all_article() {
    $mysqli = db_connect();
    $sql = "SELECT * FROM article";
    $res = $mysqli->query($sql);
    if ($res->num_rows == 0) {
        return FALSE;
    }
    else {
            $articles = array();
            $i = 0;
            while ($row = $res->fetch_assoc()) {
                $articles[$i] = new Article();
                $articles[$i]->id = $row['article_nr'];
                $articles[$i]->name = $row['name'];
                $articles[$i]->price = $row['price'];
                $articles[$i]->category = $row['category'];
                $i++;
            }
    }
    return $articles;
}
?>