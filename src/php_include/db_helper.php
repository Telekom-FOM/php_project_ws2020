<?php
    
    //Returns DB-Connection
    function db_connect() {
        //$pass = getenv("db_pass");
        //echo $pass;
        //pass will be an env var in container
        $mysqli = new mysqli("localhost", "app", "pass", "webshop");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            exit("Fehler DB-Connect");
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

    //Returns array of with all user-emails
    function db_get_all_user() {
        $mysqli = db_connect();
        $mysqli->real_query("Select * from users");
        $res = $mysqli->use_result();
        $users = array();
        while ($row = $res->fetch_assoc()) {
            $users[] = $row['email'];
        }
        $mysqli->close();
        return $users;
    }

    //Returns true or false if user (not) exists
    function db_check_if_user($email) {
        $mysqli = db_connect();
        $query = ("Select email from users where email=?");
        $res = $mysqli->prepare($query);
        $res->bind_param("s", $email);
        $res->execute();
        $res = $res->get_result();
        $res = $res->num_rows;
        
        if ($res == 1) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    //Returns TRUE or FALSE if user (not) created
    function db_create_user($email, $password) {
        $mysql = db_connect();

        if (!db_check_if_user($email)) {
            $sql = "INSERT INTO users (email, password) VALUES (?,MD5(?))";
            $con = $mysql->prepare($sql);
            $con->bind_param("ss", $email, $password);
            if ($con->execute() === TRUE) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        else {
        return FALSE;
        }
    }
    
    //Returns TRUE or FALSE if login was (not) correct    
    function db_check_login($email, $password) {
        $mysqli = db_connect();
        if (db_check_if_user($email)){
            $sql = "SELECT * FROM users where email=? and password=MD5(?)";
            $con = $mysqli->prepare($sql);
            $con->bind_param("ss", $email, $password);
            $con->execute();
           if ($con->get_result()->num_rows == 1) {
               return TRUE;
           }
           else {
               return FALSE;
           }
        }
        else {
            return FALSE;
        }
    }

?>