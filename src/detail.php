<?php
require_once("php_include/basic_includes.php");
require_once('php_include/db_article.php');

echo "<title>Das ist ein Shop</title>";
?>
>

<?php
if (isset($_GET['id'])) {
    $article = db_get_article_from_id($_GET['id']);
    if ($article) {
        print_r($article);
        echo '<form action=/cart_add.php method="get">
        <button type="submit" name="id" value= ' . $_GET["id"] .'>Add</button>
        <input type="number" name="amount" value="1" required></input>
        </form>';
    }
    else {
        echo "Artikelnummer ", $_GET['id'], " unbekannt";
    }
}
else {
    header('Location: /');
}