<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

$rowid = $_GET["a"];

$sql = "SELECT * FROM sciekio WHERE id = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i",$rowid);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
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


    <h1 class="my-5">Scieki oczyszczone/Edycja/rekord <?php echo $rowid ?> </h1>
    
    <div class="wrapper-form">
    <form action="model_update_sciekio.php" method="POST">
        <div class="input-group-grid">
            <label for="Chlorki">Chlorki:</label>
            <input type="text" id="Chlorki" name="Chlorki" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["chlorki"]?>'>
            <label for="Chrom">Chrom:</label>
            <input type="text" id="Chrom" name="Chrom" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["chrom"]?>'>
            <label for="Cynk">Cynk:</label>
            <input type="text" id="Cynk" name="Cynk" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["cynk"]?>'>
        </div>
        <div class="input-group-grid">
            <label for="Kadm">Kadm:</label>
            <input type="text" id="Kadm" name="Kadm" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["kadm"]?>'>
            <label for="Miedz">Miedź:</label>
            <input type="text" id="Miedz" name="Miedz" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["miedz"]?>'>
            <label for="Nikiel">Nikiel:</label>
            <input type="text" id="Nikiel" name="Nikiel" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["nikiel"]?>'>
        </div>
        <div class="input-group-grid">
            <label for="Odczyn">Odczyn:</label>
            <input type="text" id="Odczyn" name="Odczyn" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["odczyn"]?>'>
            <label for="Olow">Olów:</label>
            <input type="text" id="Olow" name="Olow" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["olow"]?>'>
            <label for="Siarczany">Siarczany:</label>
            <input type="text" id="Siarczany" name="Siarczany" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["siarczany"]?>'>
        </div>
            <input type="hidden" id="id" name="id" value='<?php echo $rowid?>'>
        </div>
            
        <br>
        <input type="submit" class="btn btn-send" value="Zapisz">
        <a href="sciekio.php" class="btn btn-error">Anuluj</a>
    </form>
</div>
<!--
<div>
    /*<?php echo var_dump($_GET);?>
<br>
    <?php echo var_dump($stmt);?>
<br>
    <?php print_r($result);?>
</div>
-->
</body>
</html>