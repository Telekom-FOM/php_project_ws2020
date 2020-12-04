<?php
require_once("php_include/db_basic.php");
require_once("php_include/classes.php");

function db_get_review_from_article_id($art_id)
{
    $mysqli = db_connect();
    $sql    = "SELECT * FROM review JOIN user on fk_user_id = kd_nr WHERE fk_article_id = ? AND response_id = 0";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("i", $art_id);
    $con->execute();
    $res = $con->get_result();
    if ($res->num_rows == 0) {
        return FALSE;
    } else {
        $reviews = array();
        $i        = 0;
        while ($row = $res->fetch_assoc()) {
            $reviews[$i]           = new Review();
            $reviews[$i]->id       = $row["id"];
            $reviews[$i]->user_id  = $row["fk_user_id"];
            $reviews[$i]->stars    = $row["stars"];
            $reviews[$i]->message  = $row["message"];
            $reviews[$i]->response_id = $row["response_id"];
            $reviews[$i]->name = $row["firstname"] . " " . $row["lastname"];
            $i++;
        }
    }
    return $reviews;
}
function db_get_response_from_review_id($review_id)
{
    $mysqli = db_connect();
    $sql    = "SELECT * FROM review JOIN user on fk_user_id = kd_nr WHERE response_id = ?";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("i", $review_id);
    $con->execute();
    $res = $con->get_result();
    if ($res->num_rows == 0) {
        return FALSE;
    } else {
        $responses = array();
        $i        = 0;
        while ($row = $res->fetch_assoc()) {
            $responses[$i]           = new Review();
            $responses[$i]->id       = $row["id"];
            $responses[$i]->user_id  = $row["fk_user_id"];
            $responses[$i]->stars    = $row["stars"];
            $responses[$i]->message  = $row["message"];
            $responses[$i]->response_id = $row["response_id"];
            $responses[$i]->name = $row["firstname"] . " " . $row["lastname"];
            $i++;
        }
    }
    return $responses;
}
//print_r(db_get_review_from_article_id(6267));
function db_add_review($art_id, $user_id, $stars, $message)
{
    $mysqli = db_connect();
    $sql    = "INSERT INTO review (fk_article_id, fk_user_id, stars, message) VALUES (?,?,?,?)";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("iiis", $art_id, $user_id, $stars, $message);
    if ($con->execute() == TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}
function db_add_response($art_id, $user_id, $message, $id)
{
    $mysqli = db_connect();
    $sql    = "INSERT INTO review (fk_article_id, fk_user_id, message, response_id) VALUES (?,?,?,?)";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("iisi", $art_id, $user_id, $message, $id);
    if ($con->execute() == TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}
function db_delete_review($id)
{
    $mysqli = db_connect();
    $sql    = "DELETE FROM review WHERE id = ? OR response_id = ?";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("ii", $id, $id);
    if ($con->execute() == true) {
        return true;
    } else {
        return FALSE;
    }
}
