<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_article.php");

//if category is clicked at index.php, category-name is in title
if ($_GET["category"]) {
    echo "<title>" . $_GET["category"] . "</title>";
} else {
    header("Location: /");
}

//Get articles from category
$articles = db_get_articles_from_category($_GET["id"]);

//if articles of category, show them
if ($articles) {
    foreach ($articles as $article) {
        echo "<a class='stealth__a' href='detail.php?id=" . $article->id . "'><div class='box'><center>" . $article->name . "<br>" . number_format($article->price, 2) . "€</center></div>";
    }
}
//if no articles of category, show message
else {
    echo "<h2>Zu dieser Kategorie haben wir derzeit leider keine Produkte!</h2>";
    echo "<form action=''/>
    <input type='submit' value='Zurück zur Übersicht'>
    </form>";
}