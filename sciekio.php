<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
require_once "functions.php";
$lastRowId = getLastRowIdSciekio($link);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ścieki oczyszczone</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php require_once "navbar.php"?>

<section class="body-middle">
    <section class="table-container">
        <header>Ścieki oczyszczone</header>
        <div class="input-box-group">  
                <div class="input-group" style="margin-bottom: 20px;">         
                    <a href="form_insert_sciekio.php" class="btn btn-send">Nowy wpis</a>
                    <a href="browse_sciekio.php?a=<?php echo $lastRowId;?>" class="btn btn-next">Przeglądaj</a>
                </div>
        </div>
        <div>
            <?php include 'display_sciekio.php';?>
        </div>
    </section>
</body>
</html>