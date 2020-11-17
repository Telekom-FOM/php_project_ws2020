<?php
    
    function db_connect() {
        //$pass = getenv("db_pass");
        //echo $pass;
        //pass will be an env var in container
        $mysqli = new mysqli("localhost", "app", "pass", "webshop");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        return $mysqli;
    }
    
    function db_select(){
        $mysqli->real_query("Select * from users");
        $res = $mysqli->use_result();

        while ($row = $res->fetch_assoc()) {
            echo $row['email'], "\n";
        }
    }

    function db_get_all_user() {
        $mysqli = db_connect();
        $mysqli->real_query("Select * from users");
        $res = $mysqli->use_result();
        $users = array();
        while ($row = $res->fetch_assoc()) {
            $users[] = $row['email'];
        }
        $mysqli->close();
        print_r($users);
    }

    function db_check_if_user($email) {
        $mysqli = db_connect();
        $query = ("Select email from users where email=?");
        $res = $mysqli->prepare($query);
        $res->bind_param("s", $email);
        $res->execute();
        $res = $res->get_result();
        $res = $res->num_rows;
        
        if ($res == 1) {
            return True;
        }
        else {
            return False;
        }
    }

    function db_create_user($email, $password) {
        $mysql = db_connect();

        if (!db_check_if_user($email)) {
            $sql = "INSERT INTO users (email, password) VALUES (?,MD5(?))";
            $con = $mysql->prepare($sql);
            $con->bind_param("ss", $email, $password);
            if ($con->execute() === TRUE) {
                echo "Klappt";
            }
            else {
                echo $con->error;
            }
        }
    }

    function db_check_login($email, $password) {
        $mysqli = db_connect();
        if (db_check_if_user($email)){
            $sql = "SELECT * FROM users where email=? and password=MD5(?)";
            $con = $mysqli->prepare($sql);
            $con->bind_param("ss", $email, $password);
            $con->execute();
           if ($con->get_result()->num_rows == 1) {
               echo "Login richtig";
           }
           else {
               echo "Login falsch";
           }
        }
    }

?>