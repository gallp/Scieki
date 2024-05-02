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



