<?php
   include("../DB/config.php");
      $ck = "";
      if (isset($_GET["elimina"])) {
        $query = "DELETE FROM clienti WHERE clienti.codC LIKE '".$_GET["elimina"]."'";
        //controllo
        if ($conndb->query($query) === TRUE) {
            $ck = "
                  <div class=\"alert alert-success alert-dismissable\">
                  Utente eliminato con <strong>successo.</strong>
                  </div>
                  ";
                  header('Refresh: 2; URL= ../lista_clienti.php');
        } 

        else {
          $ck = "
               <div class=\"alert alert-danger alert-dismissable\">
               Errore durante l'eliminazione: $conndb->error;
               </div>
               ";


        }
      } // END ELIMINA
   if(isset($_POST["nomeC"])) {

        // tipo, username e password da form
       $nomeC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['nomeC']));
       $cognomeC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['cognomeC']));
       $codC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['codC']));
       $descrC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['descrC']));
       $noteC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['noteC']));
       $indirizzoLC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['indirizzoLC']));
       $cittaLC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['cittaLC']));
       $capLC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['capLC']));
       $provLC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['provLC']));
       $telLC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['telLC']));
       $faxLC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['faxLC']));
       $statoLC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['statoLC']));
       $emailLC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['emailLC']));
       $urlLC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['urlLC']));
       $indirizzoAC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['indirizzoAC']));
       $cittaAC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['cittaAC']));
       $capAC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['capAC']));
       $provAC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['provAC']));
       $telAC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['telAC']));
       $cellAC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['cellAC']));
       $statoAC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['statoAC']));
       $emailAC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['emailAC']));
       $urlAC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['urlAC']));
       $PIVAC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['PIVAC']));
       $CFC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['CFC']));
       $IBANC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['IBANC']));
       $bancaC = htmlspecialchars(mysqli_real_escape_string($conndb, $_POST['bancaC']));


      //inserisci dati in tabella clienti generale
        $sql_gen = "UPDATE clienti SET nomeC='$nomeC', cognomeC='$cognomeC', codC='$codC', descrC='$descrC', noteC='$noteC', indirizzoLC='$indirizzoLC', cittaLC='$cittaLC', capLC='$capLC', provLC='$provLC', telLC='$telLC', faxLC='$faxLC', statoLC='$statoLC', emailLC='$emailLC', urlLC='$urlLC', indirizzoAC='$indirizzoAC', cittaAC='$cittaAC', capAC='$capAC', provAC='$provAC', telAC='$telAC', cellAC='$cellAC', statoAC='$statoAC', emailAC='$emailAC', urlAC='$urlAC', PIVAC='$PIVAC', CFC='$CFC', IBANC='$IBANC', bancaC='$bancaC' WHERE codC LIKE '$codC'";
        print_r($sql_gen);
        echo $conndb->error;
        //controllo inserimento
        if ($conndb->query($sql_gen)) {
            $ck = "
                  <div class=\"alert alert-success alert-dismissable\">
                  Modifica effettuata con <strong>successo.</strong>
                  </div>
                  ";
        } else {
            $ck = "
                 <div class=\"alert alert-danger alert-dismissable\">
                 Errore durante la modifica: $conndb->error;
                 </div>
                 ";
        } 

    }
      if (isset($_GET["modifica"])) { //MODIFICA INIT

      $query = "SELECT * FROM clienti WHERE codC LIKE '".$_GET["modifica"]."'";

      $result = $conndb->query($query);
      echo $conndb->error;
      $utente = $result->fetch_object();

       $nomeC = $utente->nomeC;
       $cognomeC = $utente->cognomeC;
       $codC = $utente->codC;
       $descrC = $utente->descrC;
       $noteC = $utente->noteC;
       $indirizzoLC = $utente->indirizzoLC;
       $cittaLC = $utente->cittaLC;
       $capLC = $utente->capLC;
       $provLC = $utente->provLC;
       $telLC = $utente->telLC;
       $faxLC = $utente->faxLC;
       $statoLC = $utente->statoLC;
       $emailLC = $utente->emailLC;
       $urlLC = $utente->urlLC;
       $indirizzoAC = $utente->indirizzoAC;
       $cittaAC = $utente->cittaAC;
       $capAC = $utente->capAC;
       $provAC = $utente->provAC;
       $telAC = $utente->telAC;
       $cellAC = $utente->cellAC;
       $statoAC = $utente->statoAC;
       $emailAC = $utente->emailAC;
       $urlAC = $utente->urlAC;
       $PIVAC = $utente->PIVAC;
       $CFC = $utente->CFC;
       $IBANC = $utente->IBANC;
       $bancaC = $utente->bancaC;





} //modifica end

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
                <small><?php echo $ck; ?></small>
</div>
  <?php if(!isset($_GET["elimina"])) : ?>
        <div class="componant-section">
            <div class="container login_">
                <form method="POST" action="?modifica=<?php echo $_GET["modifica"]; ?>">
                    <h1>Nuovo cliente</h1>
                    <h4>Scheda generale</h4> 
                    <input onkeyup="action($(this).val())" value="<?php echo $nomeC ?>" class="form-control widthAuto" type="text" name="nomeC" placeholder="Nome o Ragione Sociale">
                    <input value="<?php echo $cognomeC ?>" class="form-control widthAuto" type="text" name="cognomeC" placeholder="cognomeC">
                    <input readonly id="codC" value="<?php echo $codC ?>" class="form-control widthAuto" type="text" name="codC" placeholder="codice"><br/>
                    <input value="<?php echo $descrC ?>" class="form-control widthAuto" type="text" name="descrC" placeholder="Descrizione">
                    <input value="<?php echo $noteC ?>"  class="form-control widthAuto" type="text" name="noteC" placeholder="Note">
                    <h4>Scheda sede legale</h4>
                    <input value="<?php echo $indirizzoLC ?>" class="form-control widthAuto" type="text" name="indirizzoLC" placeholder="Indirizzo">
                    <input value="<?php echo $cittaLC ?>" class="form-control widthAuto" type="text" name="cittaLC" placeholder="Citta'">
                    <input value="<?php echo $capLC ?>" class="form-control widthAuto" type="text" name="capLC" placeholder="capLC"><br/>
                    <input value="<?php echo $provLC ?>" class="form-control widthAuto" type="text" name="provLC" placeholder="Provincia (XX)">
                    <input value="<?php echo $telLC ?>" class="form-control widthAuto" type="text" name="telLC" placeholder="Telefono">
                    <input value="<?php echo $faxLC ?>" class="form-control widthAuto" type="text" name="faxLC" placeholder="Fax"><br/>
                    <input value="<?php echo $statoLC ?>" class="form-control widthAuto" type="text" name="statoLC" placeholder="Stato">
                    <input value="<?php echo $emailLC ?>" class="form-control widthAuto" type="text" name="emailLC" placeholder="e-Mail">
                    <input value="<?php echo $urlLC ?>" class="form-control widthAuto" type="text" name="urlLC" placeholder="URL sito web">
                    <h4>Scheda sede amministrativa</h4>
                    <input value="<?php echo $indirizzoAC ?>" type="text" class="form-control widthAuto" name="indirizzoAC" placeholder="Indirizzo">
                    <input value="<?php echo $cittaAC ?>" type="text" class="form-control widthAuto" name="cittaAC" placeholder="Citta'">
                    <input value="<?php echo $capAC ?>" type="text" class="form-control widthAuto" name="capAC" placeholder="CAP"><br/>
                    <input value="<?php echo $provAC ?>" type="text" class="form-control widthAuto" name="provAC" placeholder="Provincia (XX)">
                    <input value="<?php echo $telAC ?>" type="text" class="form-control widthAuto" name="telAC" placeholder="Telefono">
                    <input value="<?php echo $cellAC ?>" type="text" class="form-control widthAuto" name="cellAC" placeholder="Cellulare"><br/>
                    <input value="<?php echo $statoAC ?>" type="text" class="form-control widthAuto" name="statoAC" placeholder="Stato">
                    <input value="<?php echo $emailAC ?>" type="text" class="form-control widthAuto" name="emailAC" placeholder="e-Mail">
                    <input value="<?php echo $urlAC ?>" type="text" class="form-control widthAuto" name="urlAC" placeholder="URL sito web">
                    <h4>Scheda contabilita'</h4>
                    <input value="<?php echo $PIVAC ?>" class="form-control widthAuto" type="text" name="PIVAC" placeholder="Partita IVA">
                    <input value="<?php echo $CFC ?>" class="form-control widthAuto" type="text" name="CFC" placeholder="Codice Fiscale (no spazi)"><br/>
                    <input value="<?php echo $IBANC ?>" class="form-control widthAuto" type="text" name="IBANC" placeholder="Codice IBAN (no spazi)">
                    <input value="<?php echo $bancaC ?>" class="form-control widthAuto" type="text" name="bancaC" placeholder="Nome banca"><br/>
                    <input class="form-control widthAuto" type="submit" value="Modifica Cliente">
                </form>
            </div>
        </div>
<?php endif ?>
    <?php include_once("./../template/parrot/foot.php") ?>
    <script>
      function action(val) {
        var action = $("codC").val();
        $("post").attr("action","./?modifica=" + action);
      }
    </script>
	</body>
</html>
