<?php
include("html_include/base.html");
echo "<title>Das ist ein Shop</title>";
include("html_include/header.html");
if (isset($_GET['id'])) {
    include('php_include/db_article.php');
    $article = db_get_article_from_id($_GET['id']);
    if ($article) {
        print_r($article);
    }
    else {
        echo "Artikelnummer ", $_GET['id'], " unbekannt";
    }
}
else {
    header('Location: /');
}