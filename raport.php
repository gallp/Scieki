<?php

session_start();

require_once "config.php";

// echo $_SERVER["REQUEST_METHOD"];echo "<br>";
// var_dump($_POST);
// echo "<br>";
// var_dump($_SESSION);
// echo "<br>";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    if(isset($_SESSION["data-sciekin"])){
        unset($_SESSION["data-sciekin"]);
    }
    if(isset($_SESSION["rad-sciekin"])){
        unset($_SESSION["rad-sciekin"]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // echo "confirm conditional 1<br>";

    if(array_key_exists("data-sciekin", $_POST)){
        // echo "confirm conditional 2<br>";
        
        $_SESSION["data-sciekin"] = $_POST["data-sciekin"];
        $data_sciekin = $_POST["data-sciekin"];
        $tmp = strtotime($data_sciekin);
       
        // echo "zmienna data_sciekin " . $tmp . "<br>";

        $sql = "SELECT * FROM v_sciekin WHERE creation_date >= FROM_UNIXTIME($tmp) ORDER BY creation_date DESC";
        $result = $link->query($sql);
        
        $row = $result->fetch_assoc();

        // print_r($row);
        
    }

    if(array_key_exists("rad_sciekin", $_POST)){
        // echo "confirm conditional 3<br>";
        
        $_SESSION["rad-sciekin"] = $_POST["rad_sciekin"];
        $rad_sciekin = $_POST["rad_sciekin"];
        $tmp = strtotime($rad_sciekin);
        
        // echo "zmienna rad_sciekin " . $rad_sciekin . "<br>";


        $sql2 = "SELECT * FROM v_sciekio WHERE creation_date >= FROM_UNIXTIME($tmp) ORDER BY creation_date DESC";
        $result2 = $link->query($sql2);

    }

    if(array_key_exists("rad_sciekio", $_POST)){
        echo "confirm conditional 4<br>";
        
        $_SESSION["rad-sciekio"] = $_POST["rad_sciekio"];
        $str = "view_raport.php";
        
        header("location: $str");
        exit;
    }
}

// echo $_SERVER["PHP_SELF"];
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
</head>
<body>
    <?php require_once "navbar.php"?>

    <section class="body-middle">
        
        <section class="container">
        
            <header>Generator raportów</header>
            
            <?php            
            if(key_exists("data-sciekin",$_SESSION) && key_exists("rad-sciekin",$_SESSION)){ ?>

                    <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST" id="f222">
                    <div class="rapgen-grid-container">
                            
                        <div class="grid-item">
                            
                            <header>Ścieki<br>oczyszczone</header>
                                
                                <?php
                                foreach($result2 as $row){?>
                                    
                                <div class="rapgen-row">
                                    <input type="radio" id="rad_sciekio" name="rad_sciekio" value="<?php echo $row["creation_date"]?>">
                                    <p><?php echo $row["creation_date"]?></p>
                                </div> 
                                    
                                <?php }?>
                                            
                            </div>
                            
                        </div>

                        <div class='input-box-group'>            
                            <button type="submit" class="btn btn-next">Generuj</button>
                        </div>
            <?php
            }?>

            <?php
            if(key_exists("data-sciekin",$_SESSION) && !(key_exists("rad-sciekin",$_SESSION))){ ?>

                <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST" id="f222">
                
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
                        
                </div>

                    <div class='input-box-group'>            
                        <button type="submit" class="btn btn-next">Dalej</button>
                    </div>
            <?php
            }?>

            <?php
            if(!(key_exists("data-sciekin",$_SESSION))){?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" id="f111">

                    <div class="input-box">
                        <?php
                        if(!(key_exists("data-sciekin",$_SESSION))){
                            
                            
                            $tmp =(string)date("Y-m-d");
                            ?>
                            <p>confirm conditional 5</p>
                            <input type="date" name="data-sciekin" value="<?php echo $tmp?>">
                        <?php
                        }else{?>
                            <input type="date" name="data-sciekin" value="<?php echo $_SESSION['data-sciekin']?>">
                        <?php
                        }?>
                        
                    </div>
                        <div class="input-box">
                        <button type="submit" class="btn btn-send">Ustaw datę</button>
                    </div>

                </form>

            <?php    
            }?>

                </div>         
            </form>
        </section>
    </section>        
</body>
</html>

