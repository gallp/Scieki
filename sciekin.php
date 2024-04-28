<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ścieki nieoczyszczone</title>
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

</header>

<br>
<section class="body-middle">

    <section class="table-container">
        <header>Ścieki nieoczyszczone</header>
        <div class="input-box-group">  
                <div class="input-group" style="margin-bottom: 20px;">         
                    <a href="form_insert_sciekin.php" class="btn btn-send">Nowy wpis</a>
                </div>
            </div>
        <div>
            <?php include 'display_sciekin.php'; ?>
        </div>
    </section>
</section>
</body>
</html>