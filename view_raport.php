<?php

session_start();

require_once "config.php";
require_once "functions.php";

// echo $_SERVER["PHP_SELF"];
// echo "<br>";
// var_dump($_GET);
// echo "<br>";
// var_dump($_POST);
// echo "<br>";
// var_dump($_SESSION);
// echo "<br>";


$tmp1=strtotime($_SESSION["rad-sciekin"]);
$tmp2=strtotime($_SESSION["rad-sciekio"]);
$tmp3=$_SESSION["rad-sciekio"];


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

// unset($_SESSION["rad-sciekin"]);
// unset($_SESSION["rad-sciekio"]);
// unset($_SESSION["data-sciekin"]);
// echo "<br>";
// var_dump($_SESSION);
// echo "<br>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link  media="print" rel="stylesheet" href="print.css" />
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
        
            <header>Raport ścieków<br>z dn. <?php echo date("Y-m-d")?></header>

            <?php genRaport($sciekin, $sciekio);?>
        
            <div class='input-box-group'>            
                <button type="submit" class="btn btn-next" onclick="window.print()">Pobierz</button>
            </div>

        </section>

        <script>
            kontener = document.getElementsByClassName('container')[0];
            diw = document.evaluate("//th[text()='odczyn']", kontener, null,
                XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue.closest('div');
                kontener.lastElementChild.before( diw );
</script> 
    </section>        
</body>
</html>