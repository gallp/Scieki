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
$lastRowId = getLastRowIdSciekin($link);  
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ścieki nieoczyszczone</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    
    <?php require_once "navbar.php";?>

<section class="body-middle">
    <section class="table-container">
        <header>Ścieki nieoczyszczone</header>
        <div class="input-box-group">  
                <div class="input-group" style="margin-bottom: 20px;">         
                    <a href="form_insert_sciekin.php" class="btn btn-send">Nowy wpis</a>
                    <a href="browse_sciekin.php?a=<?php echo $lastRowId;?>" class="btn btn-next">Przeglądaj</a>
                </div>
        </div>
        <div>
            <?php include 'display_sciekin.php';?>
        </div>
    </section>
</section>
</body>
</html>