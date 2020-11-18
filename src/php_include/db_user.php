<?php
include("./php_include/db_basic.php");
    //Returns array of with all user-emails
    function db_get_all_user() {
        $mysqli = db_connect();
        $mysqli->real_query("SELECT * FROM user");
        $res = $mysqli->use_result();
        $users = array();
        while ($row = $res->fetch_assoc()) {
            $users[] = $row['email'];
        }
        return $users;
    }

    //Returns TRUE or FALSE if user (not) exists
    function db_check_if_user($email) {
        $mysqli = db_connect();
        $query = ("SELECT email from user where email=?");
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
    function db_create_user($email, $password, $firstname, $lastname, $street, $zip, $city, $country, $phone) {
        $mysqli = db_connect();

        if (!db_check_if_user($email)) {
            $sql = "INSERT INTO user (email, password, firstname, lastname, street, zip, city, country, phone) VALUES (?,MD5(?),?,?,?,?,?,?,?)";
            $con = $mysql->prepare($sql);
            $con->bind_param("sssssssss", $email, $password, $firstname, $lastname, $street, $zip, $city, $country, $phone);
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
   
    //Returns TRUE or FALSE if user (not) deleted
    function db_delete_user($email) {
        $mysqli = db_connect();

        if (!db_check_if_user($email)) {
            $sql = "DELETE FROM user (email) VALUES (?)";
            $con = $mysql->prepare($sql);
            $con->bind_param("s", $email);
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
            $sql = "SELECT * FROM user where email=? and password=MD5(?)";
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