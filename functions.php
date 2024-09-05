<?php

function getLoggedUserId($link){

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

return $id;
}

function getLastRowIdSciekin($link){

    $sql = "SELECT * FROM sciekin ORDER BY id DESC LIMIT 1";
    $stmt = $link->prepare($sql);
    $stmt->execute();
    // Pobranie wyniku zapytania
    $result = $stmt->get_result();
    // // Pobranie pojedynczego wiersza jako tablicy asocjacyjnej
    $row = $result->fetch_assoc();
     // // Wydobycie wartości ID
    $id = $row['id'];
return $id;
}

function getLastRowIdSciekio($link){

    $sql = "SELECT * FROM sciekio ORDER BY id DESC LIMIT 1";
    $stmt = $link->prepare($sql);
    $stmt->execute();
    // Pobranie wyniku zapytania
    $result = $stmt->get_result();
    // // Pobranie pojedynczego wiersza jako tablicy asocjacyjnej
    $row = $result->fetch_assoc();
     // // Wydobycie wartości ID
    $id = $row['id'];
return $id;
}

function genRaport($sciekin, $sciekio){
    
    $przekroczenia =array(        
    "id" => NULL,
    "creation_date" => NULL, 
    "chlorki"   =>1000, 
    "chrom"     =>0.5,
    "cynk"      =>2, 
    "kadm"      =>0.05, 
    "miedz"     =>0.5,
    "nikiel"    =>0.5,
    "odczyn"    =>9,
    "olow"      =>0.1,
    "siarczany" =>500,
    "username" => NULL);
    ?>

    <div>
        <p>Odczyt scieków nieoczyszczonych z dn. <?php echo $sciekin["creation_date"]?> <br> wykonał: <?php echo $sciekin["username"] ?></p>
        <p>Odczyt scieków oczyszczonych z dn. <?php echo $sciekio["creation_date"]?> <br> wykonał: <?php echo $sciekio["username"]?></p>
    </div>
    
    <?php   
    foreach($sciekin as $key=>$value1){
        $value2 = $sciekio[$key];
        $przekroczenie = $przekroczenia[$key];

        
            if($key!="id" && $key!="creation_date" && $key !="username" && $value2!=NULL){?>
        <div>
        <table style="margin-top: 10px; width: 100%; border: 1px solid black;">
            <tr>
                <th rowspan="2" style="width: 100px; background-color: #f2f2f2; color: black;"><?php echo $key?></th>
                <th>Nieoczyszczone</th>
                <th>Oczyszczone</th>
                <th>Norma 
                    <?php 
                        if($key == "odczyn"){
                            echo "pH";
                        }else echo "mg/L";?></th>
                <th>% Normy</th>
            </tr>
            <tr>
                <td><?php echo $value1?></td>
                <td><?php echo $value2?></td>
                <td><?php echo $przekroczenie?></td>
                <td><?php echo round($value2/$przekroczenie*100,2)?></td>
            </tr>
        </table>
        </div>
        <?php  
            }
        }
}