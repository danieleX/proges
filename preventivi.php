<?php
    include("./DB/config.php");

    $query = "SELECT prev.*, numerazione_p.*, clienti.nomeC, clienti.cognomeC, clienti.codC
                FROM prev
                  INNER JOIN numerazione_p
                    ON prev.id=numerazione_p.id
                  LEFT JOIN clienti
                    ON numerazione_p.dest=clienti.id";

    /* check connection */
    if ($result = $conndb->query($query)) {
        if ($debug === true) printf("<!-- Select returned %d rows.\n -->", $result->num_rows);
        $oggetto_prev = 1;
        if ($result->num_rows === 0) {
            $norows = "Non è presente alcun record";
        }

    }
    if ($conndb->connect_errno) {
        printf("Connect failed: %s\n", $conndb->connect_error);
        $oggetto_prev = 0;
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

                    if ($oggetto_prev === 1) :
                        while ($oggetto_prev = $result->fetch_object()) :
                    //print_r($oggetto_prev);
                    ?>
                <tr>
                    <td><?php echo $oggetto_prev->num ?></td>
                    <td><?php echo $oggetto_prev->codC ?></td>
                    <td><?php echo $oggetto_prev->nomeC." ".$oggetto_prev->nomeC ?></td>
                    <td><?php echo $oggetto_prev->id_mezzo ?></td>
                    <td><?php echo $oggetto_prev->id_caus ?></td>
                    <td><?php echo $oggetto_prev->id_imb ?></td>
                    <td><?php echo $oggetto_prev->note ?></td>
                    <td><?php echo $oggetto_prev->reg_date ?></td>

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
