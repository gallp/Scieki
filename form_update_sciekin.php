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
//error_reporting(E_ERROR | E_PARSE);
    $rowid = $_GET["a"];

    $sql = "SELECT * FROM sciekin WHERE id = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i",$rowid);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    

    $sqlprev = "SELECT * FROM sciekin WHERE id < ? ORDER BY creation_date DESC LIMIT 1";
    $stmtprev = $link->prepare($sqlprev);
    $stmtprev->bind_param("i",$rowid);
    $stmtprev->execute();
    $resultprev = $stmtprev->get_result()->fetch_assoc();                
                        
    if(is_null($resultprev)){ 
        $prev = $rowid;
    }else{
        $prev = $resultprev["id"];
    }

    $sqlnext = "SELECT * FROM sciekin WHERE id > ? ORDER BY creation_date ASC LIMIT 1";
    $stmtnext = $link->prepare($sqlnext);
    $stmtnext->bind_param("i",$rowid);
    $stmtnext->execute();
    $resultnext = $stmtnext->get_result()->fetch_assoc();
                    
    
    if(is_null($resultnext)){
        $next = $rowid;
    }else{
        $next = $resultnext["id"];
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
            <header>Scieki nieoczyszczone\Edycja rekord <?php echo $rowid ?></header>
            <form class="form-basic" action="model_update_sciekin.php" method="POST">
                <div class="input-box-group">
                    <div class="input-box">
                        <label for="Chlorki">Chlorki:</label>
                        <input type="text" id="Chlorki" name="Chlorki" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["chlorki"]?>'>
                    </div>
                    <div class="input-box">
                        <label for="Chrom">Chrom:</label>
                        <input type="text" id="Chrom" name="Chrom" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["chrom"]?>'>
                    </div>
                    <div class="input-box">
                        <label for="Cynk">Cynk:</label>
                        <input type="text" id="Cynk" name="Cynk" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["cynk"]?>'>
                    </div>
                </div>
                <div class="input-box-group">
                    <div class="input-box">
                        <label for="Kadm">Kadm:</label>
                        <input type="text" id="Kadm" name="Kadm" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["kadm"]?>'>
                    </div>
                    <div class="input-box">
                        <label for="Miedz">Miedź:</label>
                        <input type="text" id="Miedz" name="Miedz" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["miedz"]?>'>
                    </div>
                    <div class="input-box">
                        <label for="Nikiel">Nikiel:</label>
                        <input type="text" id="Nikiel" name="Nikiel" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["nikiel"]?>'> 
                    </div>
                </div>
                <div class="input-box-group">
                    <div class="input-box">
                        <label for="Odczyn">Odczyn:</label>
                        <input type="text" id="Odczyn" name="Odczyn" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["odczyn"]?>'>
                    </div>
                    <div class="input-box">
                        <label for="Olow">Ołów:</label>
                        <input type="text" id="Olow" name="Olow" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["olow"]?>'>
                    </div>
                    <div class="input-box">
                        <label for="Siarczany">Siarczany:</label>
                        <input type="text" id="Siarczany" name="Siarczany" pattern="(\d{0,3})(\.[\d]{1,3})?" value='<?php echo $result["siarczany"]?>'><br>
                    </div>
                </div>
                <div class="input-box-group">
                    <div class="input-box">
                        <label for="Komentarz">Komentarz:</label>
                        
                        <textarea id="Komentarz" name="Komentarz"><?php echo $result["komentarz"]?></textarea>
                    </div>
                    </div>
                        <input type="hidden" id="id" name="id" value='<?php echo $rowid?>'>
                    </div>
                </div>
                <div class="input-box-group">  
                    <div class="input-group">         
                        <input type="submit" class="btn btn-send" value="Zapisz">
                        <a href="sciekin.php" class="btn btn-error">Anuluj</a>
                        <a href="form_update_sciekin.php?a=<?php echo $prev; ?>" class="btn btn-next">Poprzedni</a>
                        <a href="form_update_sciekin.php?a=<?php echo $next; ?>" class="btn btn-next">Nastepny</a>
                    </div>
                </div>
            </form>
        </section>
    </section>
</body>
</html>