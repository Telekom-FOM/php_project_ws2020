<?php
//basic db connection

//Returns DB-Connection
function db_connect()
{
    //mysql-connection details has to be defined here
    $mysql_server = "127.0.0.1";
    $mysql_user = "app";
    $mysql_password = ";(=xc3*8Ce]j5g!Y:G;UMPFr!if/}sfG";
    $mysql_database = "webshop";
    
    $mysqli = new mysqli($mysql_server, $mysql_user, $mysql_password, $mysql_database);
    if ($mysqli->connect_errno) {
        //echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        exit("Datenbank derzeit nicht erreichbar. Wir arbeiten bereits an einer Lösung!");
    }
    return $mysqli;
}
?>