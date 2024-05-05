<?php

session_start();

require_once "config.php";

if(isset($_POST["data-sciekin"])){
    $_SESSION["data-sciekin"] = $_POST["data-sciekin"];
}


// echo $_SERVER["PHP_SELF"];
// echo "<br>";
// var_dump($_POST);
// echo "<br>";
// var_dump($_SESSION);




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
            <a href="raport.php" class="btn btn-warning">Raporty</a>
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
        
            <header>Generator raportów</header>
            
            <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST" id="f111">
                
                <div class="input-box">
                    
                    <input type="date" name="data-sciekin" value="<?php echo $_SESSION['data-sciekin']?>">
                </div>
                    <div class="input-box">
                    <button type="submit" class="btn btn-send">Ustaw datę</button>
                </div>

                <?php 
                //var_dump($_POST);

                $tmp = $_SESSION["data-sciekin"];
                $tmp = strtotime(($tmp . " 00:00:00"));

                $sql = "SELECT * FROM v_sciekin WHERE creation_date >= FROM_UNIXTIME($tmp) ORDER BY creation_date DESC";
                $result = $link->query($sql);

                $sql2 = "SELECT * FROM v_sciekio WHERE creation_date >= FROM_UNIXTIME($tmp) ORDER BY creation_date DESC";
                $result2 = $link->query($sql2);

                ?>

            </form>

            <form action='view_raport.php' id="f222">
                <div class="rapgen-grid-container">
                        
                    <div class="grid-item">
                        
                    <header>Ścieki<br>nieoczyszczone</header>
                        
                        <?php
                        foreach($result as $row){?>
                            
                        <div class="rapgen-row">
                            <input type="radio" id="rad_sciekin" name="rad_sciekin" value="<?php echo $row["creation_date"]?>">
                            <p><?php echo $row["creation_date"]?></p>
                        </div> 
                            
                        <?php }?>
                                    
                    </div>
                        
                        <div class="grid-item">
                            <header>Ścieki<br>oczyszczone</header>
                        
                            <?php
                            foreach($result2 as $row2){?>
                            
                            <div class="rapgen-row">
                                <input type="radio" name="rad_sciekio" value="<?php echo $row2["creation_date"]?>">
                                <p><?php echo $row2["creation_date"]?></p>
                            </div> 

                            <?php }?>
                        </div>
                    </div> 

                    <div class='input-box-group'>            
                        <button type="submit" class="btn btn-next">Generuj</button>
                    </div>
                </div>         
            </form>
        </section>
    </section>        
</body>
</html>