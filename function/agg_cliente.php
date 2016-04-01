<?php
   include("../DB/config.php");

   if($_SERVER["REQUEST_METHOD"] == "POST") {

        // tipo, username e password da form
        $nomeC = mysqli_real_escape_string($conndb,$_POST['nomeC']);
        $cognomeC = mysqli_real_escape_string($conndb,$_POST['cognomeC']);
        $codC = mysqli_real_escape_string($conndb,$_POST['codC']);
        $descrC = mysqli_real_escape_string($conndb,$_POST['descrC']);
        $noteC = mysqli_real_escape_string($conndb,$_POST['noteC']);
        $indirizzoLC = mysqli_real_escape_string($conndb,$_POST['indirizzoLC']);
        $cittaLC = mysqli_real_escape_string($conndb,$_POST['cittaLC']);
        $capLC = mysqli_real_escape_string($conndb,$_POST['capLC']);
        $provLC = mysqli_real_escape_string($conndb,$_POST['provLC']);
        $telLC = mysqli_real_escape_string($conndb,$_POST['telLC']);
        $faxLC = mysqli_real_escape_string($conndb,$_POST['faxLC']);
        $statoLC = mysqli_real_escape_string($conndb,$_POST['statoLC']);
        $emailLC = mysqli_real_escape_string($conndb,$_POST['emailLC']);
        $urlLC = mysqli_real_escape_string($conndb,$_POST['urlLC']);
        $indirizzoAC = mysqli_real_escape_string($conndb,$_POST['indirizzoAC']);
        $cittaAC = mysqli_real_escape_string($conndb,$_POST['cittaAC']);
        $capAC = mysqli_real_escape_string($conndb,$_POST['capAC']);
        $provAC = mysqli_real_escape_string($conndb,$_POST['provAC']);
        $telAC = mysqli_real_escape_string($conndb,$_POST['telAC']);
        $cellAC = mysqli_real_escape_string($conndb,$_POST['cellAC']);
        $statoAC = mysqli_real_escape_string($conndb,$_POST['statoAC']);
        $emailAC = mysqli_real_escape_string($conndb,$_POST['emailAC']);
        $urlAC = mysqli_real_escape_string($conndb,$_POST['urlAC']);
        $PIVAC = mysqli_real_escape_string($conndb,$_POST['PIVAC']);
        $CFC = mysqli_real_escape_string($conndb,$_POST['CFC']);
        $IBANC = mysqli_real_escape_string($conndb,$_POST['IBANC']);
        $bancaC = mysqli_real_escape_string($conndb,$_POST['bancaC']);

      //inserisci dati in tabella clienti generale
$sql_gen = "INSERT INTO clienti_gen (nomeC, cognomeC, codC, descrC, noteC) VALUES ('$nomeC', '$cognomeC', '$codC', '$descrC', '$noteC')";

//controllo inserimento
if ($conndb->query($sql_gen) === TRUE) {

    $ok_gen = "
          <div class=\"alert alert-success alert-dismissable\">
          Inserimento dati generali effettuato con <strong>successo.</strong>
          </div>
          ";
} else {
    $no_gen = "
         <div class=\"alert alert-danger alert-dismissable\">
         Errore durante l'inserimento dati generali: $conndb->error;
         </div>
         ";
}

//inserisci dati in tabella clienti legale
$sql_leg = "INSERT INTO clienti_leg (indirizzoLC, cittaLC, capLC, provLC, telLC, faxLC, statoLC, emailLC, urlLC) VALUES ('$indirizzoLC', '$cittaLC', '$capLC', '$provLC', '$telLC', '$faxLC', '$statoLC', '$emailLC', '$urlLC')";

if ($conndb->query($sql_leg) === TRUE) {
    $ok_leg = "
          <div class=\"alert alert-success alert-dismissable\">
          Inserimento dati legali effettuato con <strong>successo.</strong>
          </div>
          ";
} else {
    $no_leg = "
         <div class=\"alert alert-danger alert-dismissable\">
         Errore durante l'inserimento dati sede legale: $conndb->error;
         </div>
         ";
}

//controllo inserimento


//inserisci dati in tabella clienti amministrativo
$sql_amm = "INSERT INTO clienti_amm (indirizzoAC, cittaAC, capAC, provAC, telAC, cellAC, statoAC, emailAC, urlAC) VALUES ('$indirizzoAC', '$cittaAC', '$capAC', '$provAC', '$telAC', '$cellAC', '$statoAC', '$emailAC', '$urlAC')";

//controllo inserimento
if ($conndb->query($sql_amm) === TRUE) {
    $ok_amm = "
          <div class=\"alert alert-success alert-dismissable\">
          Inserimento dati sede amministrativaeffettuato con <strong>successo.</strong>
          </div>
          ";
} else {
    $no_amm = "
         <div class=\"alert alert-danger alert-dismissable\">
         Errore durante l'inserimento dati sede amministrativa: $conndb->error;
         </div>
         ";
}

//inserisci dati in tabella clienti contabilità
$sql_cont = "INSERT INTO clienti_cont (PIVAC, CFC, IBANC, bancaC) VALUES ('$PIVAC', '$CFC', '$IBANC', '$bancaC')";

//controllo inserimento
if ($conndb->query($sql_cont) === TRUE) {
    $ok_cont = "
          <div class=\"alert alert-success alert-dismissable\">
          Inserimento dati contabilita' effettuato con <strong>successo.</strong>
          </div>
          ";
} else {
    $no_cont = "
         <div class=\"alert alert-danger alert-dismissable\">
         Errore durante l'inserimento dati contabilita': $conndb->error;
         </div>
         ";
}
   }

?>

<!DOCTYPE html>

<html lang="it">
<head>
    <!-- blu #071E3F arancione #EA640C -->
	<meta charset="utf-8">
	<title>Gestionale Provenzano</title>
	<meta name="description" content="Gestionale per etichettificio Provenzano">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <?php
    include_once("./../template/parrot/style.php"); // Carica gli stili del tema in uso ?>

    <?php include_once("session.php"); ?>

    <style>
        /*
        * Ma gli stili li lasciamo qua? Ma per ora si. non ce ne saranno molti tanto. poi li raggruppiamo e facciamo file dedicato
        */

        .login_ {
            margin: auto;
            text-align: center;
        }
        .login_form {
            display: inline-block;
            width: 400px;
            max-width: 100%;
        }
        select[name="tipoFORM"] {
            margin-bottom: 5px;
        }
        .theLogo {
            padding-top: 30px;
        }
        .theLogo img{
            width: 500px;
            max-width: 100%;
        }

        h3, h4 {
            color: #EA640C;
        }
    </style>

</head>
<body>
        <!-- #### Navbars #### -->
        <?php include_once("./../template/parrot/navbar.php") ?>

<div class="container">
                <small><?php echo $ok_gen; echo $no_gen; echo $ok_leg; echo $no_leg; echo $ok_amm; echo $no_amm; echo $ok_cont; echo $no_cont; ?></small>
</div>

        <div class="componant-section">
            <div class="container login_">
                <form method="POST">
                    <h1>Nuovo cliente</h1>
                    <h4>Scheda generale</h4>
                    <input class="form-control widthAuto" type="text" name="nomeC" placeholder="Nome o Ragione Sociale">
                    <input class="form-control widthAuto" type="text" name="cognomeC" placeholder="Cognome">
                    <input class="form-control widthAuto" type="text" name="codC" placeholder="codice"><br/>
                    <input class="form-control widthAuto" type="text" name="descrC" placeholder="Descrizione">
                    <input class="form-control widthAuto" type="text" name="noteC" placeholder="Note">
                    <h4>Scheda sede legale</h4>
                    <input class="form-control widthAuto" type="text" name="indirizzoLC" placeholder="Indirizzo">
                    <input class="form-control widthAuto" type="text" name="cittaLC" placeholder="Citta'">
                    <input class="form-control widthAuto" type="text" name="capLC" placeholder="CAP"><br/>
                    <input class="form-control widthAuto" type="text" name="provLC" placeholder="Provincia (XX)">
                    <input class="form-control widthAuto" type="text" name="telLC" placeholder="Telefono">
                    <input class="form-control widthAuto" type="text" name="faxLC" placeholder="Fax"><br/>
                    <input class="form-control widthAuto" type="text" name="statoLC" placeholder="Stato">
                    <input class="form-control widthAuto" type="text" name="emailLC" placeholder="e-Mail">
                    <input class="form-control widthAuto" type="text" name="urlLC" placeholder="URL sito web">
                    <h4>Scheda sede amministrativa</h4>
                    <input type="text" class="form-control widthAuto" name="indirizzoAC" placeholder="Indirizzo">
                    <input type="text" class="form-control widthAuto" name="cittaAC" placeholder="Citta'">
                    <input type="text" class="form-control widthAuto" name="capAC" placeholder="CAP"><br/>
                    <input type="text" class="form-control widthAuto" name="provAC" placeholder="Provincia (XX)">
                    <input type="text" class="form-control widthAuto" name="telAC" placeholder="Telefono">
                    <input type="text" class="form-control widthAuto" name="cellAC" placeholder="Cellulare"><br/>
                    <input type="text" class="form-control widthAuto" name="statoAC" placeholder="Stato">
                    <input type="text" class="form-control widthAuto" name="emailAC" placeholder="e-Mail">
                    <input type="text" class="form-control widthAuto" name="urlAC" placeholder="URL sito web">
                    <h4>Scheda contabilita'</h4>
                    <input class="form-control widthAuto" type="text" name="PIVAC" placeholder="Partita IVA">
                    <input class="form-control widthAuto" type="text" name="CFC" placeholder="Codice Fiscale (no spazi)"><br/>
                    <input class="form-control widthAuto" type="text" name="IBANC" placeholder="Codice IBAN (no spazi)">
                    <input class="form-control widthAuto" type="text" name="bancaC" placeholder="Nome banca"><br/>
                    <input class="form-control widthAuto" type="submit" value="Crea Cliente">
                </form>
            </div>
        </div>

    <?php include_once("./../template/parrot/foot.php") ?>

	</body>
</html>
