<?php
require_once("php_include/basic_includes.php");
require_once('php_include/db_article.php');
require_once("php_include/db_review.php");

//Check if article is selected
if (isset($_GET['id'])) {
    //get article
    $article = db_get_article_from_id($_GET['id']);
    $reviews = db_get_review_from_article_id($_GET['id']);
    //if article-id in database, show
    if ($article) {
        echo "<title>" . $article->name . "</title>";
        echo "<div class='header'><h1>" . $article->name . "</h1></div>";
        echo "<div class='imagediv'><img width='400px' height='400px' src=/static/products/" . $article->id . ".jpg></div><br>";
        echo "<div class='price'>" . $article->price . "€ </div>";
        echo '<form action=/change_cart.php method="get">
        <button type="submit" name="id" value= ' . $_GET["id"] . '>Zum Einkaufswagen hinzufügen</button>
        <input type="number" name="amount" value="1" required></input>
        </form>';
    }
    //if article id not found in database, show error
    else {
        echo "<title>Nicht gefunden</title>";
        echo "Artikelnummer ", $_GET['id'], " unbekannt";
    }
    echo "<div class='review'><details><summary>Rezensionen</summary>";
    if(isset($_SESSION["user"])) {
    echo "<form action='/change_review.php' id='new_review' method='get'>
        <input type='hidden' form='new_review' name ='art_id' value='" . $_GET["id"] . "' readonly>
        <input type='hidden' form='new_review' name ='user_id' value='" . unserialize($_SESSION["user"])->kd_nr . "' readonly>
        <input type='number' min='1' max='5' form='new_review' value='' placeholder='Stars' name='stars' required>
        <input type='text' form='new_review' value='' placeholder='Review' name='message' required>
        <input type='submit' form='new_review' name='action' value='Absenden'>
        </form>";
    }

    if ($reviews) {
    foreach($reviews as $review) {
        $responses = db_get_response_from_review_id($review->id);
            for ($x = 0; $x < $review->stars; $x++) {
                echo "<img width='20px' height='20px' src=/static/outlined_star1600.png>";
            }
            echo "<p>" . $review->name . ": " . $review->message . "</p>";
            echo "";
            if((unserialize($_SESSION["user"])->kd_nr == $review->user_id) || (unserialize($_SESSION["user"])->is_admin == 1)) {
                echo "<form action='/change_review.php' id='del_review' method='get'>
                    <input type='hidden' form='del_review' name ='id' value='" . $review->id . "' readonly>
                    <input type='hidden' form='del_review' name ='art_id' value='" . $_GET["id"] . "' readonly>
                    <input type='submit' form='del_review' name='action' value='Löschen'>
                    </form>";
            }
            if(isset($_SESSION["user"])) {
            echo "<form action='/change_review.php' id='add_response " . $review->id . "' method='get'>
                    <input type='hidden' form='add_response " . $review->id . "' name ='art_id' value='" . $_GET["id"] . "' readonly>
                    <input type='hidden' form='add_response " . $review->id . "' name = 'user_id' value='" . unserialize($_SESSION["user"])->kd_nr . "' readonly>
                    <input type='text' form='add_response " . $review->id . "' placeholder='Antwort' name = 'message' required>
                    <input type='hidden' form='add_response " . $review->id . "' name='id' value='" . $review->id . "' readonly>
                    <input type='submit' form='add_response " . $review->id . "' name='action' value='Antworten'>
                    </form>";
            }
            if ($responses) {
                echo "<h4>Antworten:</h4>";
                foreach($responses as $response) {
                    echo "<p class='response'>" . $response->name . ": " . $response->message . "</p>";
                    if(unserialize($_SESSION["user"])->kd_nr == $response->user_id || (unserialize($_SESSION["user"])->is_admin == 1)) {
                        echo "<form action='/change_review.php' id='del_response " . $response->id . "' method='get'>
                            <input type='hidden' form='del_response " . $response->id . "' name ='id' value='" . $response->id . "' readonly>
                            <input type='hidden' form='del_response " . $response->id . "' name ='art_id' value='" . $_GET["id"] . "' readonly>
                            <input type='submit' form='del_response " . $response->id . "' name='action' value='Löschen'>
                            </form>";
                    }
                }
            }
        }
    echo "</details>";
    }
}
// if no article is selected, redirect to index.php
else {
    header('Location: /');
}