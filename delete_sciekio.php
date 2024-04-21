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

echo $rowid;
$sql = "DELETE FROM sciekio WHERE id=?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i",$rowid);
$stmt->execute();

echo "Records deleted successfully";

$stmt->close();
$link->close();

header("location: sciekio.php");