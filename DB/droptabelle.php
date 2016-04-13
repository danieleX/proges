<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['confirm'] == 'Yes') {

// Credenziali
include_once("config.php");

// Elimino tabella IVA
$sql_iva = "DROP TABLE iva";

if (mysqli_query($conndb, $sql_iva)) {
    echo "Tabella IVA eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella IVA: " . mysqli_error($conndb) . '<br/>';
}

// Elimino tabella Imballo
$sql_imb = "DROP TABLE imballo";

if (mysqli_query($conndb, $sql_imb)) {
    echo "Tabella imballo eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella imballo: " . mysqli_error($conndb) . '<br/>';
}

// Elimino tabella Articoli
$sql_art = "DROP TABLE articoli";

if (mysqli_query($conndb, $sql_art)) {
    echo "Tabella articoli eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella articoli: " . mysqli_error($conndb) . '<br/>';
}

//Elimino tabella clienti generale
$sql_c = "DROP TABLE clienti";

if (mysqli_query($conndb, $sql_c)) {
    echo "Tabella clienti eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella clienti: " . mysqli_error($conndb) . '<br/>';
}

// Elimino tabella Causale
$sql_cau = "DROP TABLE causale";

if (mysqli_query($conndb, $sql_cau)) {
    echo "Tabella Causale eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella Causale: " . mysqli_error($conndb) . '<br/>';
}

// Elimino tabella Mezzo
$sql_mezzo = "DROP TABLE mezzo";

if (mysqli_query($conndb, $sql_mezzo)) {
    echo "Tabella mezzo eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella mezzo: " . mysqli_error($conndb) . '<br/>';
}

// Elimino tabella Spese Aggiuntive
$sql_sag = "DROP TABLE sp_agg";

if (mysqli_query($conndb, $sql_sag)) {
    echo "Tabella Spese Aggiunte eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella Spese Aggiunte: " . mysqli_error($conndb) . '<br/>';
}

// Elimino tabella Pagamento
$sql_pag = "DROP TABLE pagam";

if (mysqli_query($conndb, $sql_pag)) {
    echo "Tabella Pagamento eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella Pagamento: " . mysqli_error($conndb) . '<br/>';
}

//Elimino tabella fornitori generale
$sql_fg = "DROP TABLE fornitori";

if (mysqli_query($conndb, $sql_fg)) {
    echo "Tabella fornitori eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella fornitori: " . mysqli_error($conndb) . '<br/>';
}

//Elimino tabella login
$sql_log = "DROP TABLE login";

if (mysqli_query($conndb, $sql_log)) {
    echo "Tabella login eliminata con successo";
    header('Refresh: 3; URL = homeDB.php');
} else {
    echo "C'e' stato un errore eliminando la tabella login: " . mysqli_error($conndb);
}

//elimino tabella numerazione fattura
$sql_nf = "DROP TABLE numerazione_ftt";

if (mysqli_query($conndb, $sql_nf)) {
    echo "Tabella numerazione fattura eliminata con successo";
    header('Refresh: 3; URL = homeDB.php');
} else {
    echo "C'e' stato un errore eliminando la tabella numerazione fattura: " . mysqli_error($conndb);
}

//elimino tabella numerazione DocumentoDiTrasporto
$sql_nd = "DROP TABLE numerazione_ddt";

if (mysqli_query($conndb, $sql_nd)) {
    echo "Tabella numerazione DDT eliminata con successo";
    header('Refresh: 3; URL = homeDB.php');
} else {
    echo "C'e' stato un errore eliminando la tabella numerazione DDT: " . mysqli_error($conndb);
}

//elimino tabella numerazione NotaDiCredito
$sql_nn = "DROP TABLE numerazione_ndc";

if (mysqli_query($conndb, $sql_nn)) {
    echo "Tabella numerazione NDC eliminata con successo";
    header('Refresh: 3; URL = homeDB.php');
} else {
    echo "C'e' stato un errore creando la tabella numerazione NDC: " . mysqli_error($conndb);
}

//elimino tabella numerazione preventivi
$sql_np = "DROP TABLE numerazione_p";

if (mysqli_query($conndb, $sql_np)) {
    echo "Tabella numerazione preventivi eliminata con successo";
    header('Refresh: 3; URL = homeDB.php');
} else {
    echo "C'e' stato un errore creando la tabella numerazione preventivi: " . mysqli_error($conndb);
}

        }
    if ($_POST['confirm'] == 'No') {
    echo "Ottima scelta. Le tabelle sono salve. Attendi 5 secondi <br><br>";
    header('Refresh: 3; URL = homeDB.php');
    }
}

mysqli_close($conndb);
?>
<form method="POST">
    Sei sicuro/a?
    <input type="submit" name="confirm" value="Yes">
    <input type="submit" name="confirm" value="No">
</form>

