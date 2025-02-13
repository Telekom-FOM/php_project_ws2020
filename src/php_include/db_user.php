<?php
require_once("php_include/db_basic.php");
require_once("php_include/classes.php");
/**
 * db_get_all_user()
 * db_check_if_user($email)
 * db_create_user($email, $password, $firstname, $lastname, $street, $zip, $city, $country, $phone)
 * db_delete_user($email)
 * db_check_login($email, $password)
 * db_get_kdNr($email)
 * db_get_user($email)
 */

//Returns array of with all user-emails
function db_get_all_user()
{
    $mysqli = db_connect();
    $sql    = "SELECT * FROM user";
    $res    = $mysqli->query($sql);
    $users  = array();
    $i      = 0;
    while ($row = $res->fetch_assoc()) {
        $users[$i]            = new User;
        $users[$i]->kd_nr     = $row['kd_nr'];
        $users[$i]->email     = $row['email'];
        $users[$i]->firstname = $row['firstname'];
        $users[$i]->lastname  = $row['lastname'];
        $users[$i]->street    = $row['street'];
        $users[$i]->zip       = $row['zip'];
        $users[$i]->city      = $row['city'];
        $users[$i]->country   = $row['country'];
        $users[$i]->phone     = $row['phone'];
        $i++;
    }
    return $users;
}

//Returns TRUE or FALSE if user (not) exists
function db_check_if_user($email)
{
    $mysqli = db_connect();
    $query  = ("SELECT email from user where email=?");
    $res    = $mysqli->prepare($query);
    $res->bind_param("s", $email);
    $res->execute();
    $res = $res->get_result();
    $res = $res->num_rows;
    
    if ($res == 1) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//Returns TRUE or FALSE if user (not) created
function db_create_user($email, $password, $firstname, $lastname, $street, $zip, $city, $country, $phone)
{
    $mysql = db_connect();
    
    if (!db_check_if_user($email)) {
        $sql = "INSERT INTO user (email, password, firstname, lastname, street, zip, city, country, phone) VALUES (?,MD5(?),?,?,?,?,?,?,?)";
        $con = $mysql->prepare($sql);
        $con->bind_param("sssssssss", $email, $password, $firstname, $lastname, $street, $zip, $city, $country, $phone);
        if ($con->execute() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

//Returns TRUE or FALSE if user (not) deleted
function db_delete_user($email)
{
    $mysqli = db_connect();
    
    if (!db_check_if_user($email)) {
        $sql = "DELETE FROM user (email) VALUES (?)";
        $con = $mysql->prepare($sql);
        $con->bind_param("s", $email);
        if ($con->execute() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

//Returns TRUE or FALSE if login was (not) correct    
function db_check_login($email, $password)
{
    $mysqli = db_connect();
    if (db_check_if_user($email)) {
        $sql = "SELECT * FROM user where email=? and password=MD5(?)";
        $con = $mysqli->prepare($sql);
        $con->bind_param("ss", $email, $password);
        $con->execute();
        if ($con->get_result()->num_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}
function db_get_kdNr($email)
{
    $mysqli = db_connect();
    $sql    = "SELECT kd_nr FROM user where email=?";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("s", $email);
    $con->execute();
    $res = $con->get_result();
    return $res->fetch_assoc()["kd_nr"];
}

function db_get_user($email)
{
    $mysqli = db_connect();
    $sql    = "SELECT * FROM user where email=?";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("s", $email);
    $con->execute();
    $res = $con->get_result();
    while ($row = $res->fetch_assoc()) {
        $user            = new User;
        $user->kd_nr     = $row['kd_nr'];
        $user->email     = $row['email'];
        $user->firstname = $row['firstname'];
        $user->lastname  = $row['lastname'];
        $user->street    = $row['street'];
        $user->zip       = $row['zip'];
        $user->city      = $row['city'];
        $user->country   = $row['country'];
        $user->phone     = $row['phone'];
        $user->is_admin  = $row['is_admin'];
    }
    return $user;
    
}
?>