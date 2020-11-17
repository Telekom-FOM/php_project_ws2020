<?php
    
    //Returns DB-Connection
    function db_connect() {
        //$pass = getenv("db_pass");
        //echo $pass;
        //pass will be an env var in container
        $mysql = new mysqli("localhost", "app", "pass", "webshop");
        if ($mysql->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysql->connect_errno . ") " . $mysql->connect_error;
            exit("Fehler DB-Connect");
        }
        return $mysql;
    }
    
    function db_select(){
        $mysqli->real_query("SELECT * FROM user");
        $res = $mysqli->use_result();

        while ($row = $res->fetch_assoc()) {
            echo $row['email'], "\n";
        }
    }

?>