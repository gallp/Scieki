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
    <title>Scieki nieoczyszczone</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<b> Witaj, <?php echo htmlspecialchars($_SESSION["username"]);?> </b>
<header class="header-main">
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

<section class="body-middle">
     
    <section class="container">
        <header>Scieki nieoczyszczone\Nowy wpis</header>
        <form class="form-basic" action="model_insert_sciekin.php" method="POST">
            <div class="input-box-group">
                <div class="input-box">
                    <label for="Chlorki">Chlorki:</label>
                    <input type="text" id="Chlorki" name="Chlorki" pattern="(\d{0,3})(\.[\d]{1,3})?">
                </div>
                <div class="input-box">
                    <label for="Chrom">Chrom:</label>
                    <input type="text" id="Chrom" name="Chrom" pattern="(\d{0,3})(\.[\d]{1,3})?">
                </div>
                <div class="input-box">
                    <label for="Cynk">Cynk:</label>
                    <input type="text" id="Cynk" name="Cynk" pattern="(\d{0,3})(\.[\d]{1,3})?">
                </div>
            </div>
            <div class="input-box-group">
                <div class="input-box">
                    <label for="Kadm">Kadm:</label>
                    <input type="text" id="Kadm" name="Kadm" pattern="(\d{0,3})(\.[\d]{1,3})?">
                </div>
                <div class="input-box">
                    <label for="Miedz">Miedź:</label>
                    <input type="text" id="Miedz" name="Miedz" pattern="(\d{0,3})(\.[\d]{1,3})?">
                </div>
                <div class="input-box">
                    <label for="Nikiel">Nikiel:</label>
                    <input type="text" id="Nikiel" name="Nikiel" pattern="(\d{0,3})(\.[\d]{1,3})?">
                </div>
            </div>
            <div class="input-box-group">
                <div class="input-box">
                    <label for="Odczyn">Odczyn:</label>
                    <input type="text" id="Odczyn" name="Odczyn" pattern="(\d{0,3})(\.[\d]{1,3})?">
                </div>
                <div class="input-box">
                    <label for="Olow">Ołów:</label>
                    <input type="text" id="Olow" name="Olow" pattern="(\d{0,3})(\.[\d]{1,3})?">
                </div>
                <div class="input-box">
                    <label for="Siarczany">Siarczany:</label>
                    <input type="text" id="Siarczany" name="Siarczany" pattern="(\d{0,3})(\.[\d]{1,3})?"><br>
                </div>
            </div>
            <div class="input-box-group">
                <div class="input-box">
                    <label for="Komentarz">Komentarz:</label>
                    <textarea id="Komentarz" name="Komentarz"></textarea>
                </div>
            </div>
            <div class="input-box-group">  
                <div class="input-group">         
                    <input type="submit" class="btn btn-send" value="Zapisz">
                    <a href="sciekin.php" class="btn btn-error">Anuluj</a>
                </div>
            </div>
    </form>
 </div>
</body>
</html>