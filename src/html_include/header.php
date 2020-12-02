<!--This is the header. It includes all links on the website and the stylesheet-->
<head>
    <link rel="stylesheet" href="./css/navbar.css">
</head>
<div class="navbar">
    <a href="/">
    <img class="resize" src="./static/Banner.png" alt="Banner">
    </a>
    <div class="navbar-right">
        <a class="link" href="/">&#x2302</a>
        <a class="link" href="/about.php">Über uns</a>
        <?php
        //Check if user is an Admin show "Admin" button
        if (isset($_SESSION["user"]) && unserialize($_SESSION['user'])->is_admin == "1") {
            echo "<a class='link' href='/admin.php'>Administration</a>"; }
            //Show logout, orders & cart button if user is logged in. Say Hello to user as well 
            if (isset($_SESSION["user"])) {
                echo "<a class='link' href='/logout.php'>Abmelden</a>";
                echo "<a class='link' href='/orders.php'>Bestellungen</a><a class='link' href='/cart.php'>Einkaufswagen</a>";
                echo "<h3>Willkommen, " , unserialize($_SESSION["user"])->firstname, " ", unserialize($_SESSION["user"])->lastname; }
            else {
                //Show login button if user not logged in
                echo "<a class='link' href='/login.php'>Anmelden</a>";
            }
            ?>
        </div>
    </div>
  <div class="content">