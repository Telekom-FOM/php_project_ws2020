<?php
require_once("php_include/db_basic.php");
//******************************************************************CATEGORIES******************************************************************/
/**
 * db_get_categories()
 * db_add_category($new_name)
 * db_change_category($id, $new_name)
 * db_delete_category($id)
 * db_get_articles_from_category($cat_id)
 */
//Returns category ids or false if none in db
function db_get_categories()
{
    $mysqli = db_connect();
    $sql    = "SELECT * FROM article_category";
    $res    = $mysqli->query($sql);
    if ($res->num_rows > 0) {
        $categorys = array();
        $i         = 0;
        while ($row = $res->fetch_assoc()) {
            $categorys[$i]       = new Category();
            $categorys[$i]->id   = $row["id"];
            $categorys[$i]->name = $row["name"];
            $i++;
        }
        return $categorys;
    } else {
        return false;
    }
}

//adds category to db. Returns true if success, false if error
function db_add_category($new_name)
{
    $mysqli = db_connect();
    $sql    = "INSERT INTO article_category (name) VALUES (?)";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("s", $new_name);
    if ($con->execute() === true) {
        return true;
    } else {
        return false;
    }
}

//changes category in db. Returns true if success, false if error
function db_change_category($id, $new_name)
{
    $mysqli = db_connect();
    $sql    = "UPDATE article_category SET name = ? where id = ?";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("si", $new_name, $id);
    if ($con->execute() === true) {
        return true;
    } else {
        return false;
    }
}

//deletes category. Returns true if success, false if error
function db_delete_category($id)
{
    $mysqli = db_connect();
    $sql    = "DELETE FROM article_category where id = ?";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("i", $id);
    if ($con->execute() === true) {
        return true;
    } else {
        return false;
    }
}

//Returns articles from category or FALSE if no articles
function db_get_articles_from_category($cat_id)
{
    $mysqli = db_connect();
    $sql    = "SELECT * FROM article WHERE category=?";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("i", $cat_id);
    $con->execute();
    $res = $con->get_result();
    if ($res->num_rows == 0) {
        return false;
    } else {
        $articles = array();
        $i        = 0;
        while ($row = $res->fetch_assoc()) {
            $articles[$i]           = new Article();
            $articles[$i]->id       = $row["article_nr"];
            $articles[$i]->name     = $row["name"];
            $articles[$i]->price    = $row["price"];
            $articles[$i]->category = $row["category"];
            $i++;
        }
    }
    return $articles;
}
//******************************************************************END CATEGORIES ******************************************************************/
//******************************************************************ARTICLES******************************************************************/
/**
 * db_get_article_from_id($art_id)
 * db_get_all_article()
 * db_add_article($name, $price, $category)
 * db_add_article($name, $price, $category)
 * db_change_article($id, $new_name, $new_price, $new_category)
 * db_delete_article($id)
 */
//Returns article objects or false if article_id not in db
function db_get_article_from_id($art_id)
{
    $mysqli = db_connect();
    $sql    = "SELECT article_nr, article.name AS art_name, price, category, article_category.name AS category_name FROM article 
            JOIN article_category on category=article_category.id where article_nr=?";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("i", $art_id);
    $con->execute();
    $res = $con->get_result();
    if ($res->num_rows == 0) {
        return false;
    } else {
        while ($row = $res->fetch_assoc()) {
            $article                = new Article();
            $article->id            = $row["article_nr"];
            $article->name          = $row["art_name"];
            $article->price         = $row["price"];
            $article->category_id   = $row["category"];
            $article->category_name = $row["category_name"];
        }
    }
    return $article;
}

//Returns array of article objects or false if none in db
function db_get_all_article()
{
    $mysqli = db_connect();
    $sql    = "SELECT article_nr, article.name AS art_name, price, category, article_category.name AS cat_name FROM article 
            JOIN article_category on category=article_category.id";
    $res    = $mysqli->query($sql);
    if ($res->num_rows == 0) {
        return false;
    } else {
        $articles = array();
        $i        = 0;
        while ($row = $res->fetch_assoc()) {
            $articles[$i]                = new Article();
            $articles[$i]->id            = $row["article_nr"];
            $articles[$i]->name          = $row["art_name"];
            $articles[$i]->price         = $row["price"];
            $articles[$i]->category_id   = $row["category"];
            $articles[$i]->category_name = $row["cat_name"];
            $i++;
        }
    }
    return $articles;
}

//adds article to db. Returns true if success, false if error
function db_add_article($name, $price, $category)
{
    $mysqli = db_connect();
    $sql    = "INSERT INTO article (name, price, category) VALUES (?,?,?)";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("sss", $name, $price, $category);
    if ($con->execute() === true) {
        return true;
    } else {
        return false;
    }
}

//changes article to db. Returns true if success, false if error
function db_change_article($id, $new_name, $new_price, $new_category)
{
    $mysqli = db_connect();
    $sql    = "UPDATE article SET name = ?, price = ?, category = ? WHERE article_nr = ?";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("ssss", $new_name, $new_price, $new_category, $id);
    if ($con->execute() === true) {
        return true;
    } else {
        return false;
    }
}

//deletes article to db. Returns true if success, false if error
function db_delete_article($id)
{
    $mysqli = db_connect();
    $sql    = "DELETE FROM article where article_nr = ?";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("i", $id);
    if ($con->execute() === true) {
        return true;
    } else {
        return false;
    }
}
?>