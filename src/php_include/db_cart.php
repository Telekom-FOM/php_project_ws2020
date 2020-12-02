<?php
require_once("php_include/db_basic.php");
require_once("php_include/db_user.php");
/**
 * db_add_cart($kdNr)
 * db_check_if_cart($kdNr)
 * db_get_cart($kdNr)
 * db_add_to_cart($kdNr, $article, $amount)
 * db_show_cart($kdNr)
 * db_already_in_cart($cartID, $article)
 * db_change_cart_content($id, $amount, $article)
 * db_delete_cart_content($id, $article)
 * db_order($user)
 * db_get_orders($kdNr)
 */

//Returns TRUE if cart created, false if error
function db_add_cart($kdNr)
{
    $mysqli = db_connect();
    $sql    = "INSERT INTO cart (fk_kdnr) VALUES (?)";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("i", $kdNr);
    if ($con->execute() === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//Returns TRUE if cart exists, false if not
function db_check_if_cart($kdNr)
{
    $mysqli = db_connect();
    $sql    = "SELECT * FROM cart where fk_kdnr=? AND cart.ordered = 0";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("i", $kdNr);
    $con->execute();
    if ($con->get_result()->num_rows == 1) {
        return TRUE;
    } else {
        return FALSE;
    }
    
}

//Returns cart_id
function db_get_cart($kdNr)
{
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

//Returns TRUE if article added, false if error
function db_add_to_cart($kdNr, $article, $amount)
{
    $cartID  = db_get_cart($kdNr);
    $mysqli  = db_connect();
    $in_cart = db_already_in_cart($cartID, $article);
    if ($in_cart > 0) {
        $sql = "UPDATE `cart_content` SET `amount` = ? where `fk_article` = ? and `fk_cart_id` = ?";
        $con = $mysqli->prepare($sql);
        $amount += $in_cart;
        $con->bind_param("iii", $amount, $article, $cartID);
    } else {
        $sql = "INSERT INTO cart_content (fk_cart_id, fk_article, amount) VALUES (?,?,?)";
        $con = $mysqli->prepare($sql);
        $con->bind_param("iii", $cartID, $article, $amount);
    }
    if ($con->execute() === TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//Returns array with cart content or false if none exists
function db_show_cart($kdNr)
{
    $mysqli = db_connect();
    $sql    = "SELECT * FROM cart JOIN cart_content ON fk_cart_id = cart.id JOIN article ON fk_article = article_nr WHERE cart.fk_kdnr = ? AND cart.ordered = 0";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("s", $kdNr);
    $con->execute();
    $res = $con->get_result();
    if ($res->num_rows >= 1) {
        $content = array();
        $i       = 0;
        while ($row = $res->fetch_assoc()) {
            $content[$i] = $row;
            $i++;
        }
        return $content;
    } else {
        return FALSE;
    }
}

//Returns amount if an article is already in cart, false if not
function db_already_in_cart($cartID, $article)
{
    $mysqli = db_connect();
    $query  = ("SELECT amount FROM cart_content WHERE fk_article = ? AND fk_cart_id = ?");
    $res    = $mysqli->prepare($query);
    $res->bind_param("ii", $article, $cartID);
    $res->execute();
    $res = $res->get_result();
    
    if ($res->num_rows == 1) {
        $res = $res->fetch_assoc();
        return $res['amount'];
        
    } else {
        return FALSE;
    }
}

//Changes amaount of an article in cart. Returns true if success, false if error
function db_change_cart_content($id, $amount, $article)
{
    $mysqli = db_connect();
    $sql    = "UPDATE cart_content SET amount = ? WHERE fk_cart_id = ? AND fk_article=?";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("iii", $amount, $id, $article);
    if ($con->execute() === true) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//Deletes article from cart. Returns true if success, false if error
function db_delete_cart_content($id, $article)
{
    $mysqli = db_connect();
    $sql    = "DELETE FROM cart_content where fk_cart_id = ? AND fk_article=?";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("ii", $id, $article);
    if ($con->execute() === true) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//Executes order. Sets cart as ordered so it wont appear as cart anymore
function db_order($user)
{
    $cartID = db_get_cart($user->kd_nr);
    $mysqli = db_connect();
    $sql    = "UPDATE cart SET ordered = 1 where fk_kdnr = ?";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("i", $user->kd_nr);
    $con->execute();
}

//Returns all carts which set ordered. False if none exists
function db_get_orders($kdNr)
{
    $mysqli = db_connect();
    $sql    = "SELECT * FROM cart JOIN cart_content ON fk_cart_id = cart.id JOIN article ON fk_article = article_nr WHERE cart.fk_kdnr = ? AND cart.ordered = 1";
    $con    = $mysqli->prepare($sql);
    $con->bind_param("s", $kdNr);
    $con->execute();
    $res = $con->get_result();
    if ($res->num_rows >= 1) {
        $content = array();
        $i       = 0;
        while ($row = $res->fetch_assoc()) {
            $content[$i] = $row;
            $i++;
        }
        return $content;
    } else {
        return FALSE;
    }
}
?>