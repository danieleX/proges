<?php
include("./DB/config.php");

$query = "SELECT fatt.*, numerazione_ftt.*, clienti.nomeC, clienti.cognomeC, clienti.codC
                FROM fatt
                  INNER JOIN numerazione_ftt
                    ON fatt.id=numerazione_ftt.id
                  LEFT JOIN clienti
                    ON numerazione_ftt.dest=clienti.id";

/* check connection */
if ($result = $conndb->query($query)) {
    if ($debug === true) printf("<!-- Select returned %d rows.\n -->", $result->num_rows);
    $oggett_fatt = 1;
    if ($result->num_rows === 0) {
        $norows = "Non è presente alcun record";
    }

}
if ($conndb->connect_errno) {
    printf("Connect failed: %s\n", $conndb->connect_error);
    $oggett_fatt = 0;
    exit();
}


?>
<!DOCTYPE html>
<html lang="it">
<head>
    <!-- blu #071E3F arancione #EA640C -->
    <meta charset="utf-8">
    <title>Lista Clienti - Gestionale Provenzano</title>
    <meta name="description" content="Gestionale per etichettificio Provenzano"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <?php include_once("template/parrot/style.php") // Carica gli stili del tema in uso ?>
    <?php include_once("function/session.php") ?>

</head>
<body>
<!-- #### Navbars #### -->
<?php include_once("template/parrot/navbar.php") ?>
<!---->
<!--        <div class="masthead">-->
<!--            <div class="masthead-title">-->
<!--                <div class="container">-->
<!--                    <img src="images/logob.png" width="80%" alt=""><br/>-->
<!--                    Preventivi-->
<!--                    <small>Gestionale & Fatturazione</small>-->
<!--                    -->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<div class="container">
    <table class="table table-responsive">
        <tr>
            <th>Preventivo n°</th>
            <th>Codice Cliente</th>
            <th>Cliente</th>
            <th>Cod. Mezzo</th>
            <th>Cod. Causale</th>
            <th>Cod. Imballaggio</th>
            <th>Note</th>
            <th>Data</th>
        </tr>
        <tr>
        <?php
            if (isset($norows)) : ?>
        <tr>
            <td colspan="8"><?php echo $norows ?></td>
        </tr>
        <?php

        endif; // Se non restituisce alcuna riga
            if ($oggett_fatt === 1) :
            while ($oggett_fatt = $result->fetch_object()) :
            //print_r($oggett_fatt);
            ?>
        <tr>
            <td><?php echo $oggett_fatt->num ?></td>
            <td><?php echo $oggett_fatt->codC ?></td>
            <td><?php echo $oggett_fatt->nomeC." ".$oggett_fatt->nomeC ?></td>
            <td><?php echo $oggett_fatt->id_mezzo ?></td>
            <td><?php echo $oggett_fatt->id_caus ?></td>
            <td><?php echo $oggett_fatt->id_imb ?></td>
            <td><?php echo $oggett_fatt->note ?></td>
            <td><?php echo $oggett_fatt->reg_date ?></td>

        </tr>


        <?php
        endwhile;
        endif;
        ?>

    </table>
</div>
<?php $result->close(); ?>
<?php include_once("template/parrot/foot.php") ?>

</body>
</html>
