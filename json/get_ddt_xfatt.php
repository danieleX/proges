<?php

include_once("../function/session.php");
include_once("../DB/config.php");

// Queries
if (isset($_GET["check"])) {
    $check = mysqli_real_escape_string($conndb, $_GET["check"]);
    $query = "SELECT * FROM stampa_ddt WHERE id LIKE \"%" . $check . "%\" OR cliente LIKE \"%" . $check . "%\" OR Piva LIKE \"%" . $check . "%\"  OR cf LIKE \"%" . $check . "%\"";
} else {
    $check = '';
$query = "SELECT * FROM stampa_ddt";
}

$result = $conndb->query($query);

$newKey = array();

while ($ddt = $result->fetch_object()) {

    $arr_prezzi= explode("||", $ddt->arr_imp_uni);
    $arr_qta = explode("||", $ddt->arr_qta);
    $arr_beni = explode("||", $ddt->arr_beni);
    $arr_tipologie = explode("||", $ddt->arr_tipologia);
    $arr_prezzi_tot = [];


    //print_r($arr_tipologie);
    foreach ($arr_prezzi as $key=>$prezzo) {
        if ($arr_tipologie[$key] == "Normale") {
            $arr_prezzi_tot[] = $prezzo * $arr_qta[$key];
        }
        //(quantitaScelta / 1000) * (parseFloat(prezzoUnitario)))
        if ($arr_tipologie[$key] == "Scaglione") {
            $arr_prezzi_tot[] = (($arr_qta[$key]/1000) * $prezzo);
        }

        if ($arr_tipologie[$key] == "Stock") {
            $arr_prezzi_tot[] = $prezzo;
        }
    }

    array_push($newKey, [
        "value" => $ddt->id,
        "data" => [
            "num" => $ddt->id,
            "data_doc" => $ddt->data_doc,
            "arr_qta" => $arr_qta,
            "arr_beni" => $arr_beni,
            "arr_prezzi" => $arr_prezzi,
            "arr_prezzi_tot" => $arr_prezzi_tot,
            "somma" => array_sum($arr_prezzi_tot),
            "note" => $ddt->note
        ]
    ]);
}

$json = json_encode($newKey, JSON_PRETTY_PRINT);

?>
{
"query" : "<?php echo $check ?>",
"suggestions" : <?php echo $json ?>
}
