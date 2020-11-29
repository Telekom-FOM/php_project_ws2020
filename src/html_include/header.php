<head>
    <link rel="stylesheet" href="./css/navbar.css">
</head>
<div class="navbar">
    <img src="./static/Banner.png" alt="Banner">
    <a href="/">&#x2302</a>
    <a href="/about.php">About</a>
    <?php
    if (unserialize($_SESSION["user"])->kd_nr == "1008") {
        echo '<a href="/admin.php">Admin</a>'; } 
        if (isset($_SESSION['user'])) {
            echo '<a href="/logout.php">Logout</a>'; }
        else {
            echo '<a href="/login.php">Login</a>';
        }
    if (isset($_SESSION["user"])){
        echo "<a href='/orders.php'>Orders</a><a href='/cart.php'>Cart</a>";
        echo "Willkommen, " , unserialize($_SESSION["user"])->firstname, " ", unserialize($_SESSION["user"])->lastname;
    }
        ?>
    
  </div>
  <div class="content">