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

<?php require_once "navbar.php"?>

<section class="body-middle">
    <section class="container">
        <header>Scieki nieoczyszczone\Nowy wpis</header>
        <form class="form-basic" action="model_insert_sciekin.php" method="POST">
            <div class="input-box-group">
                <div class="input-box">
                    <label for="Chlorki">Chlorki:</label>
                    <input type="text" id="Chlorki" name="Chlorki" pattern="(\d{0,4})(\.[\d]{1,3})?">
                </div>
                <div class="input-box">
                    <label for="Chrom">Chrom:</label>
                    <input type="text" id="Chrom" name="Chrom" pattern="(\d{0,4})(\.[\d]{1,3})?">
                </div>
                <div class="input-box">
                    <label for="Cynk">Cynk:</label>
                    <input type="text" id="Cynk" name="Cynk" pattern="(\d{0,4})(\.[\d]{1,3})?">
                </div>
            </div>
            <div class="input-box-group">
                <div class="input-box">
                    <label for="Kadm">Kadm:</label>
                    <input type="text" id="Kadm" name="Kadm" pattern="(\d{0,4})(\.[\d]{1,3})?">
                </div>
                <div class="input-box">
                    <label for="Miedz">Miedź:</label>
                    <input type="text" id="Miedz" name="Miedz" pattern="(\d{0,4})(\.[\d]{1,3})?">
                </div>
                <div class="input-box">
                    <label for="Nikiel">Nikiel:</label>
                    <input type="text" id="Nikiel" name="Nikiel" pattern="(\d{0,4})(\.[\d]{1,3})?">
                </div>
            </div>
            <div class="input-box-group">
                <div class="input-box">
                    <label for="Odczyn">Odczyn:</label>
                    <input type="text" id="Odczyn" name="Odczyn" pattern="(\d{0,4})(\.[\d]{1,3})?">
                </div>
                <div class="input-box">
                    <label for="Olow">Ołów:</label>
                    <input type="text" id="Olow" name="Olow" pattern="(\d{0,4})(\.[\d]{1,3})?">
                </div>
                <div class="input-box">
                    <label for="Siarczany">Siarczany:</label>
                    <input type="text" id="Siarczany" name="Siarczany" pattern="(\d{0,4})(\.[\d]{1,3})?"><br>
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
    </section>
</section>


    <h1 class="my-5">Scieki oczyszczone/Edycja/rekord <?php echo $rowid ?> </h1>
    
        <form class="form-basic" action="model_update_sciekio.php" method="POST">
            <label for="Chlorki">Chlorki:</label>
            <input type="text" id="Chlorki" name="Chlorki" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["chlorki"]?>'>
            <label for="Chrom">Chrom:</label>
            <input type="text" id="Chrom" name="Chrom" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["chrom"]?>'>
            <label for="Cynk">Cynk:</label>
            <input type="text" id="Cynk" name="Cynk" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["cynk"]?>'>
            <label for="Kadm">Kadm:</label>
            <input type="text" id="Kadm" name="Kadm" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["kadm"]?>'>
            <label for="Miedz">Miedź:</label>
            <input type="text" id="Miedz" name="Miedz" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["miedz"]?>'>
            <label for="Nikiel">Nikiel:</label>
            <input type="text" id="Nikiel" name="Nikiel" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["nikiel"]?>'>
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
        <section>
            <input type="submit" class="btn btn-send" value="Zapisz">
            <a href="sciekio.php" class="btn btn-error">Anuluj</a>
        </section>
        
    </form>
</div>
</body>
</html>