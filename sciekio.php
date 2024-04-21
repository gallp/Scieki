<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ścieki oczyszczone</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<b> Witaj, <?php echo htmlspecialchars($_SESSION["username"]);?> </b>
<header>
    <section class="first-header-section">
      
    </section>
    
    <section class="second-header-section">
        <ul>
            <li><a href="sciekin.php" class="btn btn-warning">Ścieki nieoczyszczone</a></li>
            <li><a href="sciekio.php" class="btn btn-warning">Ścieki oczyszczone</a></li>
        </ul> 
    </section>
    
    <section class="third-header-section">
        <a href="reset-password.php" class="btn btn-warning">Zmień hasło</a>
        <a href="logout.php" class="btn btn-error">Wyloguj</a>
    </section>
</header>

<br>

<b>Ścieki oczyszczone</b> 

<br><br><br>      
    
<div class="wrapper-form">
    <form action="insert_sciekio.php" method="POST">
        <div class="input-group-grid">
            <label for="Chlorki">Chlorki:</label>
            <input type="text" id="Chlorki" name="Chlorki" pattern="([\d]{1,3})(\.)([\d]{1,3})">
            <label for="Chrom">Chrom:</label>
            <input type="text" id="Chrom" name="Chrom" pattern="([\d]{1,3})(\.)([\d]{1,3})">
            <label for="Cynk">Cynk:</label>
            <input type="text" id="Cynk" name="Cynk" pattern="([\d]{1,3})(\.)([\d]{1,3})">
        </div>
        <div class="input-group-grid">
            <label for="Kadm">Kadm:</label>
            <input type="text" id="Kadm" name="Kadm" pattern="([\d]{1,3})(\.)([\d]{1,3})">
            <label for="Miedz">Miedź:</label>
            <input type="text" id="Miedz" name="Miedz" pattern="([\d]{1,3})(\.)([\d]{1,3})">
            <label for="Nikiel">Nikiel:</label>
            <input type="text" id="Nikiel" name="Nikiel" pattern="([\d]{1,3})(\.)([\d]{1,3})">
        </div>
        <div class="input-group-grid">
            <label for="Odczyn">Odczyn:</label>
            <input type="text" id="Odczyn" name="Odczyn" pattern="([\d]{1,3})(\.)([\d]{1,3})">
            <label for="Olow">Olów:</label>
            <input type="text" id="Olow" name="Olow" pattern="([\d]{1,3})(\.)([\d]{1,3})">
            <label for="Siarczany">Siarczany:</label>
            <input type="text" id="Siarczany" name="Siarczany" pattern="([\d]{1,3})(\.)([\d]{1,3})">
        </div>       
        <br>
        <input type="submit" class="btn btn-send" value="Nowy wpis"><br><br><br>
    </form>
</div>
    
<div>
    <?php include 'display_sciekio.php'; ?>
</div>

    
</body>
</html>