<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['confirm'] == 'Yes') {

// Credenziali
include_once("config.php");

// Creo tabella IVA
$sql_iva = "DROP TABLE iva";

if (mysqli_query($conndb, $sql_iva)) {
    echo "Tabella IVA eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella IVA: " . mysqli_error($conndb) . '<br/>';
}

// Creo tabella Imballo
$sql_imb = "DROP TABLE imballo";

if (mysqli_query($conndb, $sql_imb)) {
    echo "Tabella imballo eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella imballo: " . mysqli_error($conndb) . '<br/>';
}

// Creo tabella Articoli
$sql_art = "DROP TABLE articoli";

if (mysqli_query($conndb, $sql_art)) {
    echo "Tabella articoli eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella articoli: " . mysqli_error($conndb) . '<br/>';
}

//creo tabella clienti generale
$sql_cg = "DROP TABLE clienti_gen";

if (mysqli_query($conndb, $sql_cg)) {
    echo "Tabella generale clienti eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella generale clienti: " . mysqli_error($conndb) . '<br/>';
}

//creo tabella clienti legale
$sql_cl = "DROP TABLE clienti_leg";

if (mysqli_query($conndb, $sql_cl)) {
    echo "Tabella sede legale clienti eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella sede legale clienti: " . mysqli_error($conndb) . '<br/>';
}

//creo tabella clienti amministrazione
$sql_ca = "DROP TABLE clienti_amm";

if (mysqli_query($conndb, $sql_ca)) {
    echo "Tabella sede amministrativa clienti eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella sede amministrattiva clienti: " . mysqli_error($conndb) . '<br/>';
}

//creo tabella clienti contabilita'
$sql_cc = "DROP TABLE clienti_cont";

if (mysqli_query($conndb, $sql_cc)) {
    echo "Tabella contabilita' clienti eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella contabilita' clienti: " . mysqli_error($conndb) . '<br/>';
}

// Creo tabella Causale
$sql_cau = "DROP TABLE causale";

if (mysqli_query($conndb, $sql_cau)) {
    echo "Tabella Causale eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella Causale: " . mysqli_error($conndb) . '<br/>';
}

// Creo tabella Mezzo
$sql_mezzo = "DROP TABLE mezzo";

if (mysqli_query($conndb, $sql_mezzo)) {
    echo "Tabella mezzo eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella mezzo: " . mysqli_error($conndb) . '<br/>';
}

// Creo tabella Spese Aggiuntive
$sql_sag = "DROP TABLE sp_agg";

if (mysqli_query($conndb, $sql_sag)) {
    echo "Tabella Spese Aggiunte eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella Spese Aggiunte: " . mysqli_error($conndb) . '<br/>';
}

// Creo tabella Pagamento
$sql_pag = "DROP TABLE pagam";

if (mysqli_query($conndb, $sql_pag)) {
    echo "Tabella Pagamento eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella Pagamento: " . mysqli_error($conndb) . '<br/>';
}

//creo tabella fornitori generale
$sql_fg = "DROP TABLE fornitori_gen";

if (mysqli_query($conndb, $sql_fg)) {
    echo "Tabella generale fornitori eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella generale fornitori: " . mysqli_error($conndb) . '<br/>';
}

//creo tabella fornitori legale
$sql_fl = "DROP TABLE fornitori_leg";

if (mysqli_query($conndb, $sql_fl)) {
    echo "Tabella sede legale fornitori eliminata con successo<br/>";
} else {
    echo "C'e' stato un errore eliminando la tabella sede legale fornitori: " . mysqli_error($conndb) . "<br/>";
}

//creo tabella fornitori contabilita'
$sql_fc = "DROP TABLE fornitori_cont";

if (mysqli_query($conndb, $sql_fc)) {
    echo "Tabella contabilita' fornitori eliminata con successo'<br/>'";
} else {
    echo "C'e' stato un errore eliminando la tabella contabilita' fornitori: " . mysqli_error($conndb) . '<br/>';
}

//creo tabella login
$sql_log = "DROP TABLE login";

if (mysqli_query($conndb, $sql_log)) {
    echo "Tabella login eliminata con successo";
    header('Refresh: 3; URL = homeDB.php');
} else {
    echo "C'e' stato un errore eliminando la tabella: " . mysqli_error($conndb);
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

