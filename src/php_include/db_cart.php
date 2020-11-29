<?php
require_once("php_include/db_basic.php");
require_once("php_include/db_user.php");
require_once("php_include/mail_helper.php");

//Returns TRUE if cart created
function db_add_cart($kdNr) {
    $mysqli = db_connect();
    $sql = "INSERT INTO cart (fk_kdnr) VALUES (?)";
    $con = $mysqli->prepare($sql);
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
    $sql = "SELECT * FROM cart where fk_kdnr=? AND cart.ordered = 0";
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
    $sql = "SELECT * FROM cart where fk_kdnr=? AND cart.ordered = 0";
    $con = $mysqli->prepare($sql);
    $con->bind_param("i", $kdNr);
    $con->execute();
    $res = $con->get_result();
    return $res->fetch_array()[0];
   
      
}

//Returns TRUE or FALSE if article added to cart
function db_add_to_cart($kdNr, $article, $amount) {
    $cartID = db_get_cart($kdNr);
    $mysqli = db_connect();
    $in_cart = db_already_in_cart($cartID, $article);
    if ($in_cart > 0) {
        $sql = "UPDATE `cart_content` SET `amount` = ? where `fk_article` = ? and `fk_cart_id` = ?";
        $con = $mysqli->prepare($sql);
        $amount += $in_cart;
        $con->bind_param("iii", $amount, $article, $cartID);
    }
    else {
        $sql = "INSERT INTO cart_content (fk_cart_id, fk_article, amount) VALUES (?,?,?)";
        $con = $mysqli->prepare($sql);
        $con->bind_param("iii", $cartID, $article, $amount);
    }
    if ($con->execute() === TRUE) {
        return TRUE;
    }
    else {
        return FALSE;
    }
} 

function db_show_cart($kdNr) {
    $mysqli = db_connect();
    $sql = "SELECT * FROM cart JOIN cart_content ON fk_cart_id = cart.id JOIN article ON fk_article = article_nr WHERE cart.fk_kdnr = ? AND cart.ordered = 0";
    $con = $mysqli->prepare($sql);
    $con->bind_param("s", $kdNr);
    $con->execute();
    $res = $con->get_result();
    if ($res->num_rows >= 1) {
        $content = array();
        $i = 0;
        while ($row = $res->fetch_assoc()) {
            $content[$i] = $row;
            $i++;
        }
        return $content;
    }
    else {
        return FALSE;
    }
}

function db_already_in_cart($cartID, $article) {
    $mysqli = db_connect();
        $query = ("SELECT amount FROM cart_content WHERE fk_article = ? AND fk_cart_id = ?");
        $res = $mysqli->prepare($query);
        $res->bind_param("ii", $article, $cartID);
        $res->execute();   
        $res = $res->get_result();
        
        if ($res->num_rows == 1) {
            $res = $res->fetch_assoc();
            return $res['amount'];
        
        }
        else {
            return "blub";
        }
    }

function db_order($user) {
    $cartID = db_get_cart($user->kd_nr);
    $mysqli = db_connect();
    $sql = "UPDATE cart SET ordered = 1 where fk_kdnr = ?";
    $con = $mysqli->prepare($sql);
    $con->bind_param("i", $user->kd_nr);
    $con->execute();
    send_order_mail($user);
}

function db_get_orders($kdNr) {
    $mysqli = db_connect();
    $sql = "SELECT * FROM cart JOIN cart_content ON fk_cart_id = cart.id JOIN article ON fk_article = article_nr WHERE cart.fk_kdnr = ? AND cart.ordered = 1";
    $con = $mysqli->prepare($sql);
    $con->bind_param("s", $kdNr);
    $con->execute();
    $res = $con->get_result();
    if ($res->num_rows >= 1) {
        $content = array();
        $i = 0;
        while ($row = $res->fetch_assoc()) {
            $content[$i] = $row;
            $i++;
        }
        return $content;
    }
    else {
        return FALSE;
    }
}
?>