<!DOCTYPE html>

<html lang="it">
<head>
    <!-- blu #071E3F arancione #EA640C -->
	<meta charset="utf-8">
	<title>Lista Clienti - Gestionale Provenzano</title>
	<meta name="description" content="Gestionale per etichettificio Provenzano"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <?php include_once("template/parrot/style.php") // Carica gli stili del tema in uso ?>

    <?php include("function/session.php"); ?>

</head>
<body>
        <!-- #### Navbars #### -->
        <?php include_once("template/parrot/navbar.php") ?>

    <div class="masthead">
        <div class="masthead-title">
            <div class="container">
                Lista Clienti sintetica
                <small>Gestionale & Fatturazione</small>
            </div>
        </div>
    </div>

    <div class="container">
        <div>
            <form action="lista_clienti_big.php">
                <input style="width: auto" class="form-control" type="submit" value="Lista completa">
            </form>
        </div>
        <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Codice</th>
                <th>Descrizione</th>
                <th>Note</th>
                <th>Telefono legale</th>
                <th>Cellulare</th>
                <th>P.IVA</th>
                <th>Cod Fisc</th>
                <th>+ info</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("DB/config.php");
            $sql = "SELECT * FROM clienti_gen
            INNER JOIN clienti_leg ON clienti_gen.id=clienti_leg.id
            INNER JOIN clienti_amm ON clienti_gen.id=clienti_amm.id
            INNER JOIN clienti_cont ON clienti_gen.id=clienti_cont.id ";
            $result = mysqli_query($conndb, $sql);
            while($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $nomeC = $row['nomeC'];
                $cognomeC = $row['cognomeC'];
                $codC = $row['codC'];
                $descrC = $row['descrC'];
                $noteC = $row['noteC'];
                $indirizzoLC = $row['indirizzoLC'];
                $cittaLC = $row['cittaLC'];
                $capLC = $row['capLC'];
                $provLC = $row['provLC'];
                $telLC = $row['telLC'];
                $faxLC = $row['faxLC'];
                $statoLC = $row['statoLC'];
                $emailLC = $row['emailLC'];
                $urlLC = $row['urlLC'];
                $indirizzoAC = $row['indirizzoAC'];
                $cittaAC = $row['cittaAC'];
                $capAC = $row['capAC'];
                $provAC = $row['provAC'];
                $telAC = $row['telAC'];
                $cellAC = $row['cellAC'];
                $statoAC = $row['statoAC'];
                $emailAC = $row['emailAC'];
                $urlAC = $row['urlAC'];
                $PIVAC = $row['PIVAC'];
                $CFC = $row['CFC'];
                $IBANC = $row['IBANC'];
                $bancaC = $row['bancaC'];
                echo "<tr>
                <td>".$id."</td>
                <td>".$nomeC."</td>
                <td>".$cognomeC."</td>
                <td>".$codC."</td>
                <td>".$descrC."</td>
                <td>".$noteC."</td>
                <td>".$telLC."</td>
                <td>".$cellAC."</td>
                <td>".$PIVAC."</td>
                <td>".$CFC."</td>
                <td>
                    <input class=\"form-control\" type=\"button\" value=\"Dettagli\" onClick=\"clientModal('".$nomeC."','".$cognomeC."','".$codC."','".$descrC."','".$noteC."','".$indirizzoLC."','".$cittaLC."','".$capLC."','".$provLC."','".$telLC."','".$faxLC."','".$statoLC."','".$emailLC."','".$urlLC."','".$indirizzoAC."','".$cittaAC."','".$capAC."','".$provAC."','".$telAC."','".$cellAC."','".$statoAC."','".$emailAC."','".$urlAC."','".$PIVAC."','".$CFC."','".$IBANC."','".$bancaC."')\" old-onClick=\"window.alert('ID:                            $id\\nNome:                      $nomeC\\nCognome:                $cognomeC\\nCodice:                     $codC\\nDescrizione:             $descrC\\nNote:                       $noteC\\nIndirizzo legale:       $indirizzoLC\\nCitta legale:             $cittaLC\\nCAP legale:              $capLC\\nProv legale:              $provLC\\nTelefono legale:       $telLC\\nFax legale:                $faxLC\\nStato legale:             $statoLC\\ne-mail legale:           $emailLC\\nURL legale:               $urlLC\\nIndirizzo:                  $indirizzoAC\\nCitta:                        $cittaAC\\nCAP:                         $capAC\\nProvincia:                 $provAC\\nTelefono:                  $telAC\\nCellulare:                 $cellAC\\nStato:                       $statoAC\\nemail:                       $emailAC\\nURL:                         $urlAC\\nP.IVA:                       $PIVAC\\nCod.Fisc.:                 $CFC\\nIBAN:                       $IBANC\\nBanca:                     $bancaC')\">
                </td>
                </tr>";
            }
            mysqli_close($conndb);
            ?>
        </tbody>
    </table>
    </div>

    <div class="modal fade" id="clientModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Scheda Completa</h4>
      </div>

<div class="modalClienti" style="color: #000" class="modal-body">
<div class="container">
<table>
<tr><td><h4>Cliente</h4></b></td><td></td></tr>
<tr><td><b>Nome: </b></td><td><span id="nomeC"></span></td></tr>
<tr><td><b>Cognome: </b></td><td><span id="cognomeC"></span></td></tr>
<tr><td><b>Codice Cliente: </b></td><td><span id="cC"></span></td></tr>
<tr><td><b>Descrizione: </b></td><td><span id="descC"></span></td></tr>
<tr><td><b>Note Cliente: </b></td><td><span id="noteC"></span></td></tr>
<tr><td><h4>Sede legale</h4></b></td><td></td></tr>
<tr><td><b>Indirizzo legale: </b></td><td><span id="indirizzoL"></span></td></tr>
<tr><td><b>Città legale: </b></td><td><span id="cittaL"></span></td></tr>
<tr><td><b>Cap legale: </b></td><td><span id="capL"></span></td></tr>
<tr><td><b>Provincia legale: </b></td><td><span id="provinciaL"></span></td></tr>
<tr><td><b>Tel legale: </b></td><td><span id="telL"></span></td></tr>
<tr><td><b>Fax Legale: </b></td><td><span id="faxL"></span></td></tr>
<tr><td><b>Stato legale: </b></td><td><span id="provL"></span></td></tr>
<tr><td><b>Email Legale: </b></td><td><span id="emailL"></span></td></tr>
<tr><td><b>Sito web legale: </b></td><td><span id="sitoWebL"></span></td></tr>
<tr><td><h4>Sede Amministrativa</h4></b></td><td></td></tr>
<tr><td><b>Indirizzo:</b></td><td><span id="indrizzoAc"></span></td></tr>
<tr><td><b>Città: </b></td><td><span id="cittaAc"></span></td></tr>
<tr><td><b>Cap: </b></td><td><span id="capAc"></span></td></tr>
<tr><td><b>Provincia: </b></td><td><span id="provinciaAc"></span></td></tr>
<tr><td><b>Telefono: </b></td><td><span id="telefonoAc"></span></td></tr>
<tr><td><b>Cellulare: </b></td><td><span id="cellulareAc"></span></td></tr>
<tr><td><b>Stato: </b></td><td><span id="statoAc"></span></td></tr>
<tr><td><b>Email: </b></td><td><span id="emailAc"></span></td></tr>
<tr><td><b>Sito web: </b></td><td><span id="sitoAc"></span></td></tr>
<tr><td><b>P.Iva: </b></td><td><span id="pivaAc"></span></td></tr>
<tr><td><b>C. Fiscale: </b></td><td><span id="cfiscAc"></span></td></tr>
<tr><td><b>Iban: </b></td><td><span id="ibanAc"></span></td></tr>
<tr><td><b>Banca: </b></td><td><span id="bancaAc"></span></td></tr>
</table>
</div>
</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
      </div>
    </div>
  </div>
</div>
    <?php include_once("template/parrot/foot.php") ?>
	</body>
</html>
