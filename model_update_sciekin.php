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

echo var_dump($_POST);

$chlorki = empty($_POST['Chlorki'])? NULL: htmlspecialchars($_POST['Chlorki']);
$chrom = empty($_POST['Chrom'])? NULL: htmlspecialchars($_POST['Chrom']);
$cynk = empty($_POST['Cynk'])? NULL: htmlspecialchars($_POST['Cynk']);
$kadm = empty($_POST['Kadm'])? NULL: htmlspecialchars($_POST['Kadm']);
$miedz = empty($_POST['Miedz'])? NULL: htmlspecialchars($_POST['Miedz']);
$nikel = empty($_POST['Nikiel'])? NULL: htmlspecialchars($_POST['Nikiel']);
$odczyn = empty($_POST['Odczyn'])? NULL: htmlspecialchars($_POST['Odczyn']);
$olow = empty($_POST['Olow'])? NULL: htmlspecialchars($_POST['Olow']);
$siarczany = empty($_POST['Siarczany'])? NULL: htmlspecialchars($_POST['Siarczany']);
$id = $_POST['id'];

$sql = "UPDATE sciekin SET chlorki=?, chrom=?, cynk=?, kadm=?, miedz=?, nikiel=?, odczyn=?, olow=?, siarczany=? WHERE id=?";

$stmt = $link->prepare($sql);
$stmt->bind_param("dddddddddi",$chlorki, $chrom, $cynk, $kadm, $miedz, $nikel, $odczyn, $olow, $siarczany, $id);
$stmt->execute();

echo "New records created successfully";

$stmt->close();
$link->close();

header("location: sciekin.php");