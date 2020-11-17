<?php
include("php_include/db_user.php");

//Returns TRUE if cart created
function db_add_cart($kdNr) {
    $mysql = db_connect();
    $sql = "INSERT INTO cart (fk_kdnr) VALUES (?)";
    $con = $mysql->prepare($sql);
    $con->bind_param("i", $kdNr);
    if ($con->execute() === TRUE) {
        return TRUE;
    }
    else {
        return FALSE;
    }
} 

//Returns TRUE or FALSE if cart (not) exists
function db_check_if_cart($kdNr) {
    $mysqli = db_connect();
    $sql = "SELECT * FROM cart where fk_kdnr=?";
    $con = $mysqli->prepare($sql);
    $con->bind_param("i", $kdNr);
    $con->execute();
    if ($con->get_result()->num_rows == 1) {
        return TRUE;
    }
    else {
            return FALSE;
    }

}

//Returns cart_id
function db_get_cart($kdNr) {
    $mysqli = db_connect();
    if (!db_check_if_cart($kdNr)) {
        db_add_cart($kdNr);
    }
    $sql = "SELECT * FROM cart where fk_kdnr=?";
    $con = $mysqli->prepare($sql);
    $con->bind_param("i", $kdNr);
    $con->execute();
    $res = $con->get_result();
    return $res->fetch_array()[0];
   
      
}

//Returns TRUE or FALSE if article added to cart
function db_add_to_cart($kdNr, $article, $amount) {
    $cartID = db_get_cart($kdNr);
    $mysql = db_connect();
    $sql = "INSERT INTO cart_content (fk_cart_id, fk_article, amount) VALUES (?,?,?)";
    $con = $mysql->prepare($sql);
    $con->bind_param("iii", $cartID, $article, $amount);
    if ($con->execute() === TRUE) {
        return TRUE;
    }
    else {
        return FALSE;
    }
} 


?>