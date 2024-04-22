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

echo var_dump($_POST) ;

// Include config file
require_once "config.php";

//$username = $_SESSION["username"];
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("s",$_SESSION["username"]);
$stmt->execute();

// Pobranie wyniku zapytania
$result = $stmt->get_result();

// Pobranie pojedynczego wiersza jako tablicy asocjacyjnej
$row = $result->fetch_assoc();

// Wydobycie wartości ID
$id = $row['id'];

$sql = "INSERT INTO sciekio (chlorki, chrom, cynk, kadm, miedz, nikiel, odczyn, olow, siarczany, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $link->prepare($sql);

$stmt->bind_param("dddddddddi", $chlorki, $chrom, $cynk, $kadm, $miedz, $nikel, $odczyn, $olow, $siarczany, $id);

$chlorki = empty($_POST['Chlorki'])? NULL: $_POST['Chlorki'];
$chrom = empty($_POST['Chrom'])? NULL: $_POST['Chrom'];
$cynk = empty($_POST['Cynk'])? NULL: $_POST['Cynk'];
$kadm = empty($_POST['Kadm'])? NULL: $_POST['Kadm'];
$miedz = empty($_POST['Miedz'])? NULL: $_POST['Miedz'];
$nikel = empty($_POST['Nikiel'])? NULL: $_POST['Nikiel'];
$odczyn = empty($_POST['Odczyn'])? NULL: $_POST['Odczyn'];
$olow = empty($_POST['Olow'])? NULL: $_POST['Olow'];
$siarczany = empty($_POST['Siarczany'])? NULL: $_POST['Siarczany'];

$stmt->execute();

echo "New records created successfully";

$stmt->close();
$link->close();

header("location: sciekio.php");