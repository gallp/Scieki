<?php

session_start();

require_once "config.php";
require_once "functions.php";

if(isset($_POST["data-sciekin"])){
    $_SESSION["data-sciekin"] = $_POST["data-sciekin"];
}


echo $_SERVER["PHP_SELF"];
echo "<br>";
var_dump($_GET);
echo "<br>";
var_dump($_POST);
echo "<br>";
var_dump($_SESSION);
echo "<br>";


$tmp1=strtotime($_GET["rad_sciekin"]);
$tmp2=strtotime($_GET["rad_sciekio"]);


$sql1 = "SELECT * FROM v_sciekin WHERE creation_date = FROM_UNIXTIME($tmp1)";
$result = $link->query($sql1);
// var_dump($result);
// echo "<br>";
$sciekin = $result->fetch_assoc();

$sql2 = "SELECT * FROM v_sciekio WHERE creation_date = FROM_UNIXTIME($tmp2)";
$result2 = $link->query($sql2);
// var_dump($result2);
// echo "<br>";
$sciekio = $result2->fetch_assoc();
// var_dump($sciekin);
// echo "<br>";
// var_dump($sciekio);
// echo "<br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <b> Witaj, <?php echo htmlspecialchars($_SESSION["username"]);?> </b>
    <header class="header-main">
        <section class="first-header-section">
        </section>
        
        <section class="second-header-section">
            <a href="raport.php" class="btn btn-next">Raporty</a>
            <a href="sciekin.php" class="btn btn-warning">Ścieki nieoczyszczone</a>
            <a href="sciekio.php" class="btn btn-warning">Ścieki oczyszczone</a>  
        </section>
        
        <section class="third-header-section">
            <a href="reset-password.php" class="btn btn-warning">Zmień hasło</a>
            <a href="logout.php" class="btn btn-error">Wyloguj</a>
        </section>
    </header>

    <section class="body-middle">
        
        <section class="container">
        
            <header>Raport ścieków<br>z dn. <?php echo $_GET["rad_sciekio"]?></header>

            <?php genRaport($sciekin, $sciekio);?>
        
            <div class='input-box-group'>            
            <button type="submit" class="btn btn-next">Drukuj</button>
        </div>
                </div>         
            </form>
        </section>
    </section>        
</body>
</html>