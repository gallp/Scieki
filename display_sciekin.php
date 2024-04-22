<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<?php

// Include config file
require_once "config.php";

$sql = "SELECT * FROM v_sciekin ORDER BY creation_date DESC";
$result = $link->query($sql);

//echo var_dump($result);
$username = $_SESSION["username"];
//echo var_dump($username);

if ($result->num_rows > 0) {
    // Wyświetlenie danych
    echo "<table class='table-sciekio'>";
    echo "<tr><th>ID</th><th>Data utworzenia</th><th>Chlorki</th><th>Chrom</th><th>Cynk</th><th>Kadm</th><th>Miedź</th><th>Nikiel</th><th>Odczyn</th><th>Ołów</th><th>Siarczany</th><th>Autor</th><th>Edycja</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "\r\n<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["creation_date"] . "</td>";
        echo "<td>" . $row["chlorki"] . "</td>";
        echo "<td>" . $row["chrom"] . "</td>";
        echo "<td>" . $row["cynk"] . "</td>";
        echo "<td>" . $row["kadm"] . "</td>";
        echo "<td>" . $row["miedz"] . "</td>";
        echo "<td>" . $row["nikiel"] . "</td>";
        echo "<td>" . $row["odczyn"] . "</td>";
        echo "<td>" . $row["olow"] . "</td>";
        echo "<td>" . $row["siarczany"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo '<td><a href="form_update_sciekin.php?a=' . $row['id'] . '">Edytuj</a> <a href="delete_sciekin.php?a=' . $row['id'] . '">Usuń</a></td>';
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Brak rekordów";
}
$link->close();