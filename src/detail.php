<?php
require_once("php_include/basic_includes.php");
require_once('php_include/db_article.php');

//Check if article is selected
if (isset($_GET['id'])) {
    //get article
    $article = db_get_article_from_id($_GET['id']);
    //if article-id in database, show
    if ($article) {
        echo "<title>" . $article->name . "</title>";
        echo "<h1>" . $article->name . "</h1>";
        echo "<img src=/static/products/" . $article->id . ".jpg><br>";
        echo $article->price . "€";
        echo '<form action=/change_cart.php method="get">
        <button type="submit" name="id" value= ' . $_GET["id"] . '>Zum Einkaufswagen hinzufügen</button>
        <input type="number" name="amount" value="1" required></input>
        </form>';
    }
    //if article id not found in database, show error
    else {
        echo "<title>Nicht gefunden</title>";
        echo "Artikelnummer ", $_GET['id'], " unbekannt";
    }
}
// if no article is selected, redirect to index.php
else {
    header('Location: /');
}