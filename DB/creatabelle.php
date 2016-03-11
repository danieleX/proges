<?php

// Credenziali
include_once("config.php");

// Creo tabella IVA
$sql_iva = "CREATE TABLE iva (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
aliquota INT(3) NOT NULL,
descr VARCHAR(100) NULL,
reg_date TIMESTAMP,
UNIQUE (aliquota)
)";

if (mysqli_query($conndb, $sql_iva)) {
    echo "Tabella IVA creata con successo <br/>";
} else {
    echo "C'e' stato un errore creando la tabella IVA: " . mysqli_error($conndb) . '<br/>';
}

// Creo tabella Imballo
$sql_imb = "CREATE TABLE imballo (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(20) NOT NULL,
descr VARCHAR(100) NULL,
reg_date TIMESTAMP,
UNIQUE (tipo)
)";

if (mysqli_query($conndb, $sql_imb)) {
    echo "Tabella imballo creata con successo <br/>";
} else {
    echo "C'e' stato un errore creando la tabella imballo: " . mysqli_error($conndb) . '<br/>';
}

// Creo tabella Articoli
$sql_art = "CREATE TABLE articoli (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
cod_int VARCHAR(6) NOT NULL,
nome VARCHAR(50) NOT NULL,
descr VARCHAR(100) NULL,
cod_barre BIGINT(30) NOT NULL,
prezzo INT(5) NULL,
note VARCHAR(100) NULL,
reg_date TIMESTAMP,
UNIQUE (cod_barre)
)";

if (mysqli_query($conndb, $sql_art)) {
    echo "Tabella articoli creata con successo'<br/>'";
} else {
    echo "C'e' stato un errore creando la tabella articoli: " . mysqli_error($conndb) . '<br/>';
}

//creo tabella clienti generale
$sql_cg = "CREATE TABLE clienti_gen (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nomeC VARCHAR(40) NOT NULL,
cognomeC VARCHAR(20) NULL,
codC VARCHAR(4) NOT NULL,
descrC VARCHAR(100) NULL,
noteC VARCHAR(100) NULL,
reg_date TIMESTAMP,
UNIQUE (codC)
)";

if (mysqli_query($conndb, $sql_cg)) {
    echo "Tabella generale clienti creata con successo'<br/>'";
} else {
    echo "C'e' stato un errore creando la tabella generale clienti: " . mysqli_error($conndb) . '<br/>';
}

//creo tabella clienti legale
$sql_cl = "CREATE TABLE clienti_leg (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
indirizzoLC VARCHAR(50) NULL,
cittaLC VARCHAR(20) NULL,
capLC INT(5) NULL,
provLC VARCHAR(2) NULL,
telLC VARCHAR(16) NULL,
faxLC VARCHAR(16) NULL,
statoLC VARCHAR(30) NULL,
emailLC VARCHAR(40) NULL,
urlLC VARCHAR(100) NULL,
reg_date TIMESTAMP,
UNIQUE (emailLC)
)";

if (mysqli_query($conndb, $sql_cl)) {
    echo "Tabella sede legale clienti creata con successo'<br/>'";
} else {
    echo "C'e' stato un errore creando la tabella sede legale clienti: " . mysqli_error($conndb) . '<br/>';
}

//creo tabella clienti amministrazione
$sql_ca = "CREATE TABLE clienti_amm (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
indirizzoAC VARCHAR(50) NULL,
cittaAC VARCHAR(20) NULL,
capAC INT(5) NULL,
provAC VARCHAR(2) NULL,
telAC VARCHAR(16) NULL,
cellAC INT(11) NULL,
statoAC VARCHAR(30) NULL,
emailAC VARCHAR(40) NULL,
urlAC VARCHAR(100) NULL,
reg_date TIMESTAMP,
UNIQUE (emailAC)
)";

if (mysqli_query($conndb, $sql_ca)) {
    echo "Tabella sede amministrativa clienti creata con successo'<br/>'";
} else {
    echo "C'e' stato un errore creando la tabella sede amministrattiva clienti: " . mysqli_error($conndb) . '<br/>';
}

//creo tabella clienti contabilita'
$sql_cc = "CREATE TABLE clienti_cont (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
PIVAC INT(11) NULL,
CFC VARCHAR(16) NULL,
IBANC VARCHAR(27) NULL,
bancaC VARCHAR(100) NULL,
UNIQUE (PIVAC, CFC)
)";

if (mysqli_query($conndb, $sql_cc)) {
    echo "Tabella contabilita' clienti creata con successo'<br/>'";
} else {
    echo "C'e' stato un errore creando la tabella contabilita' clienti: " . mysqli_error($conndb) . '<br/>';
}

// Creo tabella Causale
$sql_cau = "CREATE TABLE causale (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(20) NOT NULL,
descr VARCHAR(100) NULL,
reg_date TIMESTAMP,
UNIQUE (tipo)
)";

if (mysqli_query($conndb, $sql_cau)) {
    echo "Tabella Causale creata con successo'<br/>'";
} else {
    echo "C'e' stato un errore creando la tabella Causale: " . mysqli_error($conndb) . '<br/>';
}

// Creo tabella Mezzo
$sql_mezzo = "CREATE TABLE mezzo (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(20) NOT NULL,
descr VARCHAR(100) NULL,
reg_date TIMESTAMP,
UNIQUE (tipo)
)";

if (mysqli_query($conndb, $sql_mezzo)) {
    echo "Tabella mezzo creata con successo'<br/>'";
} else {
    echo "C'e' stato un errore creando la tabella mezzo: " . mysqli_error($conndb) . '<br/>';
}

// Creo tabella Spese Aggiuntive
$sql_sag = "CREATE TABLE sp_agg (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(20) NOT NULL,
prezzo INT(5) NOT NULL,
descr VARCHAR(100) NULL,
UNIQUE (tipo)
)";

if (mysqli_query($conndb, $sql_sag)) {
    echo "Tabella Spese Aggiunte creata con successo'<br/>'";
} else {
    echo "C'e' stato un errore creando la tabella Spese Aggiunte: " . mysqli_error($conndb) . '<br/>';
}

// Creo tabella Pagamento
$sql_pag = "CREATE TABLE pagam (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(20) NOT NULL,
descr VARCHAR(100) NULL,
UNIQUE (tipo)
)";

if (mysqli_query($conndb, $sql_pag)) {
    echo "Tabella Pagamento creata con successo'<br/>'";
} else {
    echo "C'e' stato un errore creando la tabella Pagamento: " . mysqli_error($conndb) . '<br/>';
}

//creo tabella fornitori generale
$sql_fg = "CREATE TABLE fornitori_gen (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nomeF VARCHAR(40) NOT NULL,
cognomeF VARCHAR(20) NULL,
codF VARCHAR(4) NOT NULL,
descrF VARCHAR(100) NULL,
noteF VARCHAR(100) NULL,
reg_date TIMESTAMP,
UNIQUE (codF)
)";

if (mysqli_query($conndb, $sql_fg)) {
    echo "Tabella generale fornitori creata con successo'<br/>'";
} else {
    echo "C'e' stato un errore creando la tabella generale fornitori: " . mysqli_error($conndb) . '<br/>';
}

//creo tabella fornitori legale
$sql_fl = "CREATE TABLE fornitori_leg (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
indirizzoLF VARCHAR(50) NULL,
cittaLF VARCHAR(20) NULL,
capLF INT(5) NULL,
provLF VARCHAR(2) NULL,
telLF VARCHAR(16) NULL,
faxLF VARCHAR(16) NULL,
statoLF VARCHAR(30) NULL,
emailLF VARCHAR(40) NULL,
urlLF VARCHAR(100) NULL,
reg_date TIMESTAMP,
UNIQUE (emailLF)
)";

if (mysqli_query($conndb, $sql_fl)) {
    echo "Tabella sede legale fornitori creata con successo<br/>";
} else {
    echo "C'e' stato un errore creando la tabella sede legale fornitori: " . mysqli_error($conndb) . "<br/>";
}

//creo tabella fornitori contabilita'
$sql_fc = "CREATE TABLE fornitori_cont (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
PIVAF INT(11) NULL,
CFF VARCHAR(16) NULL,
IBANF VARCHAR(27) NULL,
bancaF VARCHAR(100) NULL,
UNIQUE (PIVAF, CFF)
)";

if (mysqli_query($conndb, $sql_fc)) {
    echo "Tabella contabilita' fornitori creata con successo'<br/>'";
} else {
    echo "C'e' stato un errore creando la tabella contabilita' fornitori: " . mysqli_error($conndb) . '<br/>';
}

//creo tabella login
$sql_log = "CREATE TABLE login (
id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tipoLOG VARCHAR(9) NOT NULL,
userLOG VARCHAR(20) NOT NULL,
pswdLOG VARCHAR(10),
reg_date TIMESTAMP,
UNIQUE (userLOG)
)";

if (mysqli_query($conndb, $sql_log)) {
    echo "Tabella login creata con successo";
    header('Refresh: 3; URL = homeDB.php');
} else {
    echo "C'e' stato un errore creando la tabella: " . mysqli_error($conndb);
}

mysqli_close($conndb);
?>
