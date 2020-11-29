<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_article.php");

echo "<title>Das ist ein Shop</title>";

$articles = db_get_all_article();
echo "<table border = 1><tr><th>Artikelnummer</th><th>Name</th><th>Preis</th><tr>";
foreach($articles as $article) {
    echo "<tr><td><a href='/detail.php?id=", $article["article_nr"], "'> " . $article["article_nr"] . "</a></td><td>", $article["name"], "</td><td>" , $article["price"], "</td></tr>";
}