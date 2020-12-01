<?php
require_once("php_include/basic_includes.php");
require_once('php_include/db_article.php');



if (isset($_GET['id'])) {
    $article = db_get_article_from_id($_GET['id']);
    if ($article) {
        echo "<title>" . $article->name . "</title>";
        echo "<h1>" . $article->name . "</h1>";
        echo "<img src=/static/products/" . $article->id .".jpg><br>";
        echo $article->price . "€";
        echo '<form action=/cart_add.php method="get">
        <button type="submit" name="id" value= ' . $_GET["id"] .'>Zum Einkaufswagen hinzufügen</button>
        <input type="number" name="amount" value="1" required></input>
        </form>';
    }
    else {
        echo "<title>Nicht gefunden</title>";
        echo "Artikelnummer ", $_GET['id'], " unbekannt";
    }
}
else {
    header('Location: /');
}