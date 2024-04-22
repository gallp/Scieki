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
    <div id="sexy-flexy">
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
    </div>
    
    
    
</header>

<br>

<b>Ścieki nieoczyszczone</b> 

<br><br><br>
<a href="sciekio.php" class="btn btn-send">Nowy wpis</a>
<br><br><br>
<div>
    <?php include 'display_sciekio.php'; ?>
</div>
</body>
</html>