<?php
require_once("php_include/basic_includes.php");
require_once('php_include/db_user.php');
require_once('php_include/db_article.php');

echo "<title>Admin</title>";

//Check if user is an Admin. Redirects back to index.php if not so
if (!isset($_SESSION['user']) || (unserialize($_SESSION['user'])->is_admin == "0")) {
    header("Location: /");
}

//get categories
$categories = db_get_categories();

//Print categories-table with the ability to add, change or remove categories
echo "<table class='styled-table' border=1><tr><th>ID</th><th>Name</th><th></th><th></th></tr>";
foreach ($categories as $category) {
    echo "<tr><form action='/change_category.php' id='" . $category->id . "' method='get'>
        <input type='hidden' class='form__field' form='" . $category->id . "' name ='id' value='" . $category->id . "' readonly>
        <td>" . $category->id . "</td>
        <td><input type='text' class='form__field' form='" . $category->id . "'value='" . $category->name . "' name='name' required></td>
        <td><input type='submit' class='form__field' form='" . $category->id . "'name='action' value='change'>
        <td><input type='submit' class='form__field' form='" . $category->id . "' name='action' value='delete'></td></form></tr>";
}
echo "<tr><form action='/change_category.php' id='new_cat' method='get'>
    <td>automatisch</td>
    <td><input type='text' class='form__field' form='new_cat' value='' placeholer='Kategoriename' name='name' required></td>
    <td><input type='submit' class='form__field' form='new_cat' name='action' value='add'></tr>";
echo "</form></table><br>";

//get article
$articles = db_get_all_article();

//Print articles-table with the ability to add, change or remove articles
echo "<table class='styled-table' border=1><tr><th>ID</th><th>Name</th><th>Preis in €</th><th>Kategorie</th><th></th><th></th></tr>";
foreach ($articles as $article) {
    echo "<tr><form action='/change_article.php' id='" . $article->id . "' method='get'>
    <input type='hidden' class='form__field' name ='id' value='" . $article->id . "' readonly>
        <td>" . $article->id . "</td>
        <td><input type='text' class='form__field' form='" . $article->id . "' value='" . $article->name . "' name='name' required></td>
        <td><input type='number' class='form__field' form='" . $article->id . "' min=0 step=0.01 value='" . $article->price . "' name='price' required></td>
        <td><select form='" . $article->id . "' name='category'>";
    foreach ($categories as $category) {
        if ($article->category_id == $category->id) {
            echo "<option selected value='" . $category->id . "'>" . $category->name . "</option>";
        } else
            echo "<option value='" . $category->id . "'>" . $category->name . "</option>";
    }
    echo "<td><input type='submit' class='form__field' form='" . $article->id . "' name='action' value='change'>
            <td><input type='submit' class='form__field' form='" . $article->id . "' name='action' value='delete'></td></form></tr>";
}
echo "<tr><form action='/change_article.php' id='new_art' method='get'>
    <input type='hidden' class='form__field' form='new_art' name='id' value='auto_increment' readonly>
    <td>automatisch</td>
    <td><input type='text' class='form__field' form='new_art' value='' placeholer='Artikelname' name='name' required></td>
    <td><input type='number' pattern='[0-9]+([.][0-9]+)?' step='0.01' class='form__field' form='new_art' value='' placeholer='Preis' name='price' required></td>
    <td><select name='category' form='new_art'>";
foreach ($categories as $category) {
    echo "<option value='" . $category->id . "'>" . $category->name . "</option>";
}
echo "</td><td><input type='submit' class='form__field' form='new_art' name='action' value='add'></tr></form></table>";