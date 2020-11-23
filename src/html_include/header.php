<head>
    <link rel="stylesheet" href="./css/navbar.css">
</head>
<div class="navbar">
    <img src="./static/Banner.png" alt="Banner">
    <a href="/">&#x2302</a>
    <a href="/about.php">About</a>
    <?php
    if ($_SESSION["user"] == "max.benkert@gmx.de") {
        echo '<a href="/admin.php">Admin</a>'; } 
        if (isset($_SESSION['user'])) {
            echo '<a href="/logout.php">Logout</a>'; }
        else {
            echo '<a href="/login.php">Login</a>';
        }
        ?>
    
  </div>
  <div class="content">