<?php
include("../DB/config.php");
$check = @$_GET["check"];

$sql_clienti = "SELECT nomeC, cognomeC, CFC FROM clienti_gen
INNER JOIN clienti_cont ON clienti_gen.id=clienti_cont.id
WHERE clienti_gen.nomeC LIKE \"%".$check."%\" OR
clienti_gen.cognomeC LIKE \"%".$check."%\" OR
clienti_cont.CFC LIKE \"%".$check."%\"";

//echo $sql_clienti;
$result = $conndb->query($sql_clienti);


$newKey = array();
$key = 0;
while ( $row = mysqli_fetch_assoc($result) ) {
    $nomeCliente = $row["nomeC"];
    $cognomeCliente = $row["cognomeC"];
    $CFCliente = $row["CFC"];
    $newKey[] .= $key;
    array_push($newKey, array(["nomeC" => $nomeCliente,
"cognomeC" => $cognomeCliente,
"CodFiscC" => $CFCliente]));



    $key++;
}



echo json_encode($newKey);

           //"nomeC" => $nomeCliente,
           //"cognomeC" => $cognomeCliente,
           //"CodFiscC" => $CFCliente
