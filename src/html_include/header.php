<head>
    <link rel="stylesheet" href="./css/navbar.css">
</head>
<div class="navbar">
    <a href="/">
    <img class="resize" src="./static/Banner.png" alt="Banner">
    </a>
    <div class="navbar-right">
        <a class="link" href="/">&#x2302</a>
        <a class="link" href="/about.php">About</a>
        <?php
        if (isset($_SESSION["user"]) && unserialize($_SESSION['user'])->is_admin == "1") {
            echo '<a class="link" href="/admin.php">Admin</a>'; } 
            if (isset($_SESSION['user'])) {
                echo '<a class="link" href="/logout.php">Logout</a>'; }
            else {
                echo '<a class="link" href="/login.php">Login</a>';
            }
        if (isset($_SESSION["user"])){
            echo "<a class='link' href='/orders.php'>Orders</a><a class='link' href='/cart.php'>Cart</a>";
            echo "<h3>Willkommen, " , unserialize($_SESSION["user"])->firstname, " ", unserialize($_SESSION["user"])->lastname;
        }
            ?>
        </div>
    </div>
  <div class="content">