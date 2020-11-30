<?php
require_once("php_include/db_basic.php");
//********************************************CATEGORIES ***************************************************************/
//Returns category ids
function db_get_categories() {
    $mysqli = db_connect();
    $sql = "SELECT * FROM article_category";
    $res = $mysqli->query($sql);
    if ($res->num_rows > 0) {
    $categorys = array();
    $i = 0;
    while ($row = $res->fetch_assoc()) {
        $categorys[$i] = new Category();
        $categorys[$i]->id = $row['id'];
        $categorys[$i]->name = $row['name'];
        $i++;
    }
    return $categorys;
}
else {
    return FALSE;
}
}

function db_add_category($new_name) {
    $mysqli = db_connect();
    $sql = "INSERT INTO article_category (name) VALUES (?)";
    $con = $mysqli->prepare($sql);
    $amount += $in_cart;
    $con->bind_param("sx", $new_name);
    if ($con->execute() === TRUE) {
        return TRUE;
    }
    else {
        return FALSE;
    }
} 


function db_change_category($id, $new_name) {
    $mysqli = db_connect();
    $sql = "UPDATE article_category SET name = ? where id = ?";
    $con = $mysqli->prepare($sql);
    $amount += $in_cart;
    $con->bind_param("si", $new_name, $id);
    if ($con->execute() === TRUE) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}  

function db_delete_category($id) {
    $mysqli = db_connect();
    $sql = "DELETE FROM article_category where id = ?";
    $con = $mysqli->prepare($sql);
    $amount += $in_cart;
    $con->bind_param("i", $id);
    if ($con->execute() === TRUE) {
        return TRUE;
    }
    else {
        return FALSE;
    }
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
//********************************************END CATEGORIES ***************************************************************/

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
            while ($row = $res->fetch_assoc()) {
                $article = new Article();
                $article->id = $row['article_nr'];
                $article->name = $row['name'];
                $article->price = $row['price'];
                $article->category = $row['category'];
            }
    }
    return $article;
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