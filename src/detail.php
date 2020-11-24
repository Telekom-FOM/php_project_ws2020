<?php
include("html_include/base.html");
echo "<title>Das ist ein Shop</title>";
include("php_include/session.php");
include("html_include/header.php");
?>
>

<?php
if (isset($_GET['id'])) {
    include('php_include/db_article.php');
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