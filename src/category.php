<?php

require_once("php_include/basic_includes.php");
require_once("php_include/db_article.php");

if ($_GET["category"]) {
    echo "<title>" . $_GET["category"] . "</title>";
}
else {
    header("Location: /");
}
$articles = db_get_articles_from_category($_GET["id"]);
if ($articles){
    foreach($articles as $article) {
        echo "<a class='stealth__a' href='detail.php?id=" . $article->id . "'><div class='box'><center>" . $article->name . "<br>"
        . number_format($article->price,2) . "€</center></div>";
    }
}
else {
    echo "<h2>Zu dieser Kategorie haben wir derzeit leider keine Produkte!</h2>";
    echo "<form action=''/>
    <input type='submit' value='Zurück zur Übersicht'>
    </form>";
}