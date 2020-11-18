<?php
include("php_include/db_user.php");

//Returns category ids
function db_get_categories() {
    $mysqli = db_connect();
    $mysqli->real_query("SELECT * FROM article_category");
    $res = $mysqli->use_result();
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
                $articles[$i]['article_nr'] = $row['article_nr'];
                $articles[$i]['name'] = $row['name'];
                $articles[$i]['price'] = $row['price'];
                $i++;
            }
    }
    return $articles;
}

print_r(db_get_categories());
?>