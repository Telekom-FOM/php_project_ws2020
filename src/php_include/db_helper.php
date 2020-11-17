<?php
    
    function db_connect() {
        $pass = getenv("db_pass");
        echo $pass;
        //pass will be an env var in container
        $mysqli = new mysqli("localhost", "app", "pass", "webshop");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
    }
    
    function db_select(){
        $mysqli->real_query("Select * from users");
        $res = $mysqli->use_result();

        while ($row = $res->fetch_assoc()) {
            echo $row['email'], "\n";
        }
    }
?>