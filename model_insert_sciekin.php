<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

//check if this page was accesed via POST method, if not redirect to login page
if(!$_SERVER["REQUEST_METHOD"] == "POST"){
    header("location: login.php");
    exit;
}
?>
<pre>
    <?php
        print_r($_POST);
    ?>
</pre>
<?php

// Include config file
require_once "config.php";

$id = $_SESSION["id"];

$sql = "INSERT INTO sciekin (chlorki, chrom, cynk, kadm, miedz, nikiel, odczyn, olow, siarczany, komentarz, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $link->prepare($sql);

$stmt->bind_param("dddddddddsi", $chlorki, $chrom, $cynk, $kadm, $miedz, $nikel, $odczyn, $olow, $siarczany, $komentarz, $id);


$chlorki = empty($_POST['Chlorki'])? NULL: $_POST['Chlorki'];
$chrom = empty($_POST['Chrom'])? NULL: $_POST['Chrom'];
$cynk = empty($_POST['Cynk'])? NULL: $_POST['Cynk'];
$kadm = empty($_POST['Kadm'])? NULL: $_POST['Kadm'];
$miedz = empty($_POST['Miedz'])? NULL: $_POST['Miedz'];
$nikel = empty($_POST['Nikiel'])? NULL: $_POST['Nikiel'];
$odczyn = empty($_POST['Odczyn'])? NULL: $_POST['Odczyn'];
$olow = empty($_POST['Olow'])? NULL: $_POST['Olow'];
$siarczany = empty($_POST['Siarczany'])? NULL: $_POST['Siarczany'];
$komentarz = empty($_POST['Komentarz'])? NULL: $_POST['Komentarz'];

if(empty($chlorki) && empty($chrom) && empty($cynk) && empty($kadm) && empty($miedz) && empty($nikel) && empty($odczyn) && empty($olow) && empty($siarczany) ){
    echo "uzupełnij co najmniej jedną wartość";
}else{
    $stmt->execute();
    $stmt->close();
    $link->close();
    header("location: sciekin.php");
}
