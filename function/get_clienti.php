<?php
include("../DB/config.php");

if (isset($_GET["check"])) $check = mysqli_real_escape_string($conndb,$_GET["check"]);
else $check = "Nessuna query";

$sql_clienti = "SELECT id, nomeC, cognomeC, CFC FROM clienti WHERE id LIKE \"%".$check."%\" OR nomeC LIKE \"%".$check."%\" OR cognomeC LIKE \"%".$check."%\" OR CFC LIKE \"%".$check."%\"";

//echo $sql_clienti;
$result = $conndb->query($sql_clienti);

$newKey = array();

while ( $row = mysqli_fetch_assoc($result) ) {
    $nomeCliente = $row["nomeC"];
    $cognomeCliente = $row["cognomeC"];
    $CFCliente = $row["CFC"];
    if ($CFCliente == "") $CFCliente = "ND";
    $id = $row["id"];
    array_push($newKey, [
        "value" => $id,
        "data" => [
            "cognome" => $cognomeCliente,
            "nome" => $nomeCliente,
            "CodFiscC" => $CFCliente
            ]
        ]);
}

$json = json_encode($newKey, JSON_PRETTY_PRINT);

?>
{
    "query" : "<?php echo $check ?>",
    "suggestions" : <?php echo $json ?>
}