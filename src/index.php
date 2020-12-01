<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_article.php");


echo "<title>Jupiter-Store</title>";
if (isset($_SESSION["temp_cart"])) {
    require_once("php_include/db_cart.php");
    db_add_to_cart(unserialize($_SESSION["user"])->kd_nr, $_SESSION["temp_cart"]["id"], $_SESSION["temp_cart"]["amount"]);
    header("Location: /cart.php");
}
$articles = db_get_all_article();
echo "<table border = 1><tr><th>Artikelnummer</th><th>Name</th><th>Preis</th><tr>";
foreach($articles as $article) {
    echo "<tr><td><a href='/detail.php?id=", $article->id, "'> " . $article->id . "</a></td><td>", $article->name, "</td><td>" , $article->price    , "</td></tr>";
}