<?php
//basic db connection

//Returns DB-Connection
function db_connect()
{
    //mysql-connection details has to be defined here
    $mysqli = new mysqli("localhost", "app", "pass", "webshop");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        exit("Fehler DB-Connect");
    }
    return $mysqli;
}
?>