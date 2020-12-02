<?php
require_once("php_include/session.php");

//deletes session with all contents, redirects to index.php
session_unset();
header("Location: /");
?>