<?php
require_once("php_include/basic_includes.php");
require_once("php_include/db_article.php");

echo "<title>Jupiter-Store</title>";

//if temp_cart exists, add article to cart
if (isset($_SESSION["temp_cart"])) {
    require_once("php_include/db_cart.php");
    db_add_to_cart(unserialize($_SESSION["user"])->kd_nr, $_SESSION["temp_cart"]["id"], $_SESSION["temp_cart"]["amount"]);
    header("Location: /cart.php");
}

//get categories
$categories = db_get_categories();

//show box for each category
foreach ($categories as $category) {
    echo "<a class='stealth__a' href='category.php?id=" . $category->id . "&category=" . $category->name . "'>
        <div class='box'><center>" . $category->name . "</center></div></a>";
}