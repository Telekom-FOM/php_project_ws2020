<?php

if (isset($_GET['id'])) {
    include('php_include/db_article.php');
    print_r(db_get_article_from_id($_GET['id']));
}
else {
    header('Location: https://jupiter-store.de');
}