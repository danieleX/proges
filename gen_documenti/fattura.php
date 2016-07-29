<?php
date_default_timezone_set('Europe/Rome');
$base_url = $_SERVER["SERVER_NAME"] . "/proges";
include_once("../DB/config.php");
include_once("./../function/session.php");


//prendi i tipi di pagamento
$query = "SELECT descr FROM ck_pagam";

if ($result = $conndb->query($query)) {
    $pagamenti = [];
    while ($row = $result->fetch_object()) {
        array_push($pagamenti, $row->descr);
    }
}
// Prendi le aliquote
$query = "SELECT aliquota FROM ck_iva ORDER BY id";
if ($result = $conndb->query($query)) {
    $iva = [];
    while ($row = $result->fetch_object()) {
        array_push($iva, $row->aliquota);
    }
}

//Checka se si tratta della pagina output di post.php

if ((isset($post)) == true) {

    $idRiga = count($quantita) + 1;
    $modifica = true;

} else {
    $data = date('Y-m-d');
    $anno = date("Y");
    $idRiga = 1;
    $memory = '["default"]';
}

?>

<html>
<head>
    <title>Fattura</title>
    <meta charset="utf-8">
    <meta name="image" content="../images/logos.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="default.css">
    <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body>

<span id="controlloQuery"></span>
<div id="stampa" class="row">
    <div class="container">
        <div class="row text-right">
            <div class="col-sm-4">
                <a href="../fatture.php"> <span class="glyphicon glyphicon-chevron-left"></span>Indietro</a>
            </div>
            <div class="col-sm-4">
                <a href="#" onclick=save()> <i class="fa fa-floppy-o" aria-hidden="true"></i> Salva</a>
            </div>
            <div class="col-sm-4">
                <?php if (isset($post)) : ?>
                    <a href="#" onclick="window.print()"> <span class="glyphicon glyphicon-print"></span> Stampa</a>
                <?php endif; ?>
            </div>
            </span>
        </div>
    </div>
</div>

<page>
    <div style="background: #FFF" class="container-fluid">
        <div class="table-responsive">

            <table class="table-bordered table table-striped">

                <thead>

                <tr height="150px"></tr>

                <tr>

                    <td colspan="2" style="width:600;">
                        <p class="col-md-12">
                        <h5>
                        <p><strong>FATTURA N.
                                <input id="fattId" class="stampa form-control" style="width:15%; text-align:right; display:inline" type="number" size="4" <?php if (isset($id)) echo "value='" . $id . "'" ?> >/
                                <?php echo $anno ?>
                                <br/> del <input id="data" type="date" value="<?php echo $data ?>" class="stampa form-control" style="width:30%; display:inline">
                            </strong></p>
                        </h5>
                        </p>
                        <p>Pagamento
<select id="pagamento" class="form-control" name="pagamento" style="width:50%; display:inline">

    <?php $selected = "";
    foreach ($pagamenti as $pagamento) : ?>
        <?php
        if (isset($pagamento_scelto)) {
            if ($pagamento_scelto == $pagamento) {
                $selected = "selected";
            } else {
                $selected = "";
            }
        }
        ?>
        <option <?php echo $selected ?> value="<?php echo $pagamento ?>"><?php echo $pagamento ?></option>
    <?php endforeach ?>
</select></p>
                        <p>CREDITO SICILIANO - AG. BAGHERIA</p>
                        <p>IBAN: <strong>IT 69 F 03019 43070 000008380468</strong></p>
                    </td>

                    <td colspan="2">
                        <div class="col-md-12">
                            Spett.le<br/>
                            <input id="cliente" type="text" class="text-left form-control" placeholder="Cliente con suggerimento" <?php if (isset($cliente)) echo "value='" . $cliente . "'" ?>>
                            <p>P. IVA <input id="ivaCliente" style="display:inline, width:90%;" type="text" class="text-left form-control"
                                <?php if (isset($cliente)) echo "value='" . $piva . "'" ?> readonly></p>
                            <p><input id="indirizzo" type="text" class="text-left form-control"
                                   placeholder="Indirizzo"
                                   readonly <?php if (isset($indirizzo)) echo "value='" . $indirizzo . "'" ?>></p>
                            <p><input id="citta" class="text-left form-control" type="text"
                                   style="width: auto; max-width:65%; display:inline;"
                                   placeholder="Città" <?php if (isset($citta)) echo "value='" . $citta . "'" ?>
                                   readonly>
                            <span style="width: auto;"> - </span>
                            <input id="pr" class="text-left form-control" type="text"
                                   style="width: auto; max-width:15%; display:inline;"
                                    <?php if (isset($prov)) echo "value='" . $prov . "'" ?> readonly>
                            <span style="width: auto;"> - </span>
                            <input id="cap" class="text-left form-control" type="number"
                                   style="width:20%; display:inline;"
                                    <?php if (isset($cap)) echo "value='" . $cap . "'" ?>
                                   readonly> </p>
                        </div>
                    </td>

                </tr>

                </thead>

                <tbody>
                <tr style="background: lightgreen" class="stampa">
                    <td  colspan="4">
                        <div id="scegliDDT">
                            <input id="selectDDT" placeholder="Numero DDT" type="number" class="stampa form-control arrQuantita" min="1">
                            <!-- QUI -->
                        </div>

                            <div id="incolonnaArticoli">
                                <input class="stampa form-control incolonnatore" type="text"
                                   placeholder="Descrizione articolo automatica">
                       </div>
                    </td>
                </tr>
                <tr>
                    <td><p class="col-md-12">Quantità</p></td>
                    <td width="300px"><p class="col-md-12">Descrizione della merce</p></td>
                    <td><p class="col-md-12">Imp.unit.</p></td>
                    <td><p class="col-md-12">Importo</p></td>
                </tr>
                </tr>

                <!-- Tabella interattiva // INIZIO -->
                <tr class="qnt hiddenElement stampa">

                <!--
                    <td id="incolonnaPrezzi">
                        <input class="hiddenElement form-control stampa" style="text-align:right;" type="text"
                               placeholder="auto da DB €" readonly>
                    </td>

                    <td id="incolonnaPrezziTot">
                        <input class="hiddenElement form-control stampa" style="text-align:right;" type="text"
                               placeholder="auto da riga €" readonly>
                    </td>
                -->
                </tr>
                        <?php

                        // DDT allegati
                        $DDTsomma = 0;
                        $DDTarray = [];
                        $arr_prezzi_tot = [];
                        //print_r($ddt_n[0]);
                        if (!empty($ddt_n[0])) :
                            for ($ii = 0; $ii < count(@$ddt_n); $ii++) :

                                $num_doc_ = $ddt_n[$ii];

                                $query = "SELECT * FROM stampa_ddt WHERE id=".$num_doc_;
                                $result = $conndb->query($query);
                                $ddt = $result->fetch_object();
                                //print_r($ddt);
                                $arr_prezzi= explode("||", $ddt->arr_imp_uni);
                                $arr_qta = explode("||", $ddt->arr_qta);
                                $arr_beni = explode("||", $ddt->arr_beni);
                                $data_ddt = $ddt->data_doc;
                                $DDTarray = 0;

                                $arr_prezzi_tot = [];
                                for ($k = 0; count($arr_prezzi) > $k; $k++) {
                                    array_push($arr_prezzi_tot, ($arr_prezzi[$k] * $arr_qta[$k]));
                                }

                                //print_r($arr_prezzi_tot);
                                $somma = array_sum($arr_prezzi_tot);

                                //echo "risultato: ".$somma." altro: ".$ii;
                                 ?>

                                <tr onclick="cancellaDDT($(this))" class="ddt-<?php echo $ddt->id ?>">
                                <input id="inputDDT-<?php echo $ddt->id ?>" type="hidden" value="<?php echo $somma ?>">
                                <th colspan="4">
                                <p>DDT N° <?php echo $ddt->id ?> del <?php echo $data_ddt ?> </p>
                                </th>
                                </tr>
                                <?php for ($i=0; count($arr_prezzi) > $i; $i++ ) :
                                    $arr_prezzi_tot = $arr_prezzi[$i] * $arr_qta[$i];


                                ?>
                                    <!-- FOR -->
                                    <tr class="ddt-<?php echo $ddt->id ?> borderless">
                                    <td><input type="number" readonly="" class="form-control arrQuantita" value="<?php echo $arr_qta[$i] ?>"></td>
                                    <td><p class="col-xs-12 noMargin"><?php echo $arr_beni[$i] ?></p></td>
                                    <td><p class="col-xs-12 noMargin valuta"><?php echo $arr_prezzi[$i] ?></p></td>
                                    <td><p class="col-xs-12 noMargin valuta"><?php echo  $arr_prezzi_tot ?></p></td>

                                    </tr>
                                <?php


                                endfor;

                                ?>

                                <?php

                            endfor;
                        endif;
                        // Articoli salvati
                        if (isset($post)) :
                            if ($quantita[0] != "") {
                            for ($i = 0; count($quantita) > $i; $i++) : ?>
                            <tr id="ordini-<?php echo $i+1 ?>" class="borderless">

                                <td>
                                    <input id="idQuantita-<?php echo $i + 1 ?>" type="number" class="form-control arrQuantita" min="1" value="<?php echo $quantita[$i] ?>">
                                </td>
                                <td>
                                    <p class="col-xs-12 arrArticoli noMargin"
                                   id="idArticoli-<?php echo $i + 1 ?>"><?php echo $prodotti[$i] ?></p>
                                </td>
                                <td><p class="valuta col-xs-10 noMargin"
                                   id="prezzo-<?php echo $i + 1 ?>"><?php echo $prezzi_cad[$i] ?></p></td>
                                <td><p class="valuta col-xs-10 noMargin"
                                   id="prezzoTOT-<?php echo $i + 1 ?>"><?php echo $prezzi[$i] ?></p></td>
                               <input type="hidden" value="<?php echo $tipologia[$i]; ?>" id="tipologia-<?php echo $i + 1 ?>">
                            </tr>
                            <?php endfor; }?>


                        <?php endif ?>
                <!-- Tabella interattiva // FINE -->
                <tr>
                    <td style="text-align:center" colspan="2" rowspan="3">
                    <p class="col-md-12"><textarea id="nota" class="form-control" cols="50" rows="10"><?php echo @$note ?></textarea></p>
                    <p>Contributo CONAI assolto ove dovuto.</p>
                    </td>
                    <td style="text-align:right"><p>Totale parziale €</p></td>
                    <td>
                        <input id="parziale" class="form-control " style="text-align:right" type="text"
                               placeholder="auto da colonna €" <?php if (isset($parziale)) echo "value='" . str_replace(".", ",", $parziale) . "'" ?>
                               readonly>
                    </td>
                </tr>

                <tr>
                    <td style="text-align:right"><p>IVA %</p></td>
                    <td><select id="iva" class="form-control" style="text-align:right">
                            <?php foreach ($iva as $aliquota) :
                                if (isset($iva_scelta)) {
                                    if ($iva_scelta == $aliquota) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                }
                                ?>
                                <option <?php echo $selected ?>
                                    value="<?php echo $aliquota ?>"><?php echo $aliquota ?></option>
                            <?php endforeach ?>
                        </select></td>
                </tr>

                <tr>
                    <td style="text-align:right"><p><strong>Totale dovuto €</strong></p></td>
                    <td>
                        <input id="totaleDovuto" class="form-control" style="text-align:right" type="text"
                               placeholder="auto da colonna €" <?php if (isset($totale)) echo "value='" . str_replace(".", ",", $totale) . "'" ?>
                               readonly>
                    </td>
                </tr>

                <tr>
                    <td id="ifIva0" colspan="3"><p class="smaller">Esente IVA ai sensi dell’art.8 del D.P.R. 633/72.
                            Documento
                            n°<input id="esenteNum" min=1 type="number"
                                     class="smaller form-control"
                                     style="width:5%; display:inline"
                                     placeholder="0000" <?php if (isset($esente_num)) echo "value='" . $esente_num . "'" ?>>
                            valido dal <input id="esIvaDal" type="date" class="smaller form-control"
                                              style="display:inline; width:20%" <?php if (isset($esente_dal)) echo "value='" . $esente_dal . "'" ?>>
                            al <input id="esIvaAl"
                                      type="date" <?php if (isset($esente_al)) echo "value='" . $esente_al . "'" ?>
                                      class="smaller form-control" style="display:inline; width:20%"></p></td>
                    <td class="text-center"><p>S. E. & O.</p></td>
                </tr>

                </tbody>

            </table>
            <input type="hidden" value="0" id="calcola">
        </div>
    </div>
</page>

<?php include_once("../template/parrot/foot.php") ?>

<script>
    var memory = <?php echo $memory ?>;
    var sommaDDT = 0;
    <?php //echo $DDTarray ?>
    var idRiga = <?php echo $idRiga ?>;
    var controlloClick = 1;
    var codCliente = "<?php if (isset($codC)) { echo $codC; } ?>";

    function sommaDDT_ () {
        var valori = $("input[id*=inputDDT]");
        for (var i = 0; valori.length > i; i++) {
            sommaDDT = sommaDDT + parseFloat(valori[i].value);
            console.log(valori[i].value);
        }

    }

    <?php if (isset($post)) : ?>
        sommaDDT_ ();
    <?php endif ?>

    $('.incolonnatore').devbridgeAutocomplete({
        dataType: "json",
        paramName: "check",
        serviceUrl: 'http://<?php echo $base_url ?>/json/get_articoli.php',
        formatResult: function (suggestion, currentValue) {
            return suggestion.value + " - " + suggestion.data.descr + " - " + suggestion.data.misura + " - " + suggestion.data.prezzo + "€";
        },
        onSelect: function (suggestion) {
            var execute = false;
            $(function () {
                var checkIfExists = memory.indexOf(suggestion.data.descr +" - "+suggestion.data.misura);
                console.log(checkIfExists);
                if (checkIfExists !== -1) {
                        alert("Hai già inserito questo prodotto");
                        execute = false;
                    }
                    else {
                        execute = true;
                    }

                if (execute === true) {

                    var tr = "<tr id=ordini-"+ idRiga +" class=\"borderless\">";
                    var prezzoFloat = parseFloat(suggestion.data.prezzo).toFixed(2);

                    tr += "<td><input id=\"idQuantita-" + idRiga + "\" type=\"number\" class=\"form-control arrQuantita\" min=\"1\" value=\"1\"></td>";

                    tr += "<td><p class=\"col-xs-12 arrArticoli noMargin\" id=\"idArticoli-" + idRiga + "\" >" + suggestion.data.descr + " - " + suggestion.data.misura + "</p></td>";


                    tr += "<td><p class=\"valuta col-xs-10 noMargin\" id=\"prezzo-" + idRiga + "\">" + prezzoFloat.replace(".",",") + "</p></td>";

                    tr += "<td><p class=\"valuta col-xs-10 noMargin\" id=\"prezzoTOT-" + idRiga + "\">" + prezzoFloat.replace(".",",") + "</p></td>";

                    tr += '<input type="hidden" id="tipologia-'+ idRiga +'" value="' + suggestion.data.tipologia + '">';
                    $(".qnt").after(tr);

                    prezziTot($("#idQuantita-" + idRiga));
                    memory.push(suggestion.data.descr +" - "+suggestion.data.misura);
                    idRiga++;

                    $(".arrQuantita, #iva").keyup(function () {
                        prezziTot($(this));
                    });
                    $(".arrQuantita, #iva").click(function () {
                        prezziTot($(this));
                    });

                    $(".arrArticoli").click(function () {
                        cancella($(this));
                        prezziTot($(this));
                    })
                }

            });
        }
    });
    $(".arrArticoli").click(function () {
        cancella($(this));
        prezziTot($(this));
    });

    function prezziTot(quantita) {
        quantitaScelta = quantita.val();
        quantitaId = quantita.attr("id");
        quantitaId = quantitaId.split("-");
        prezzoUnitario = $("#prezzo-" + quantitaId[1]).text();
        tipologia = $("#tipologia-" + quantitaId[1]).val(); //
        console.log(tipologia);

        //controlla tipologia

        /*  Normale
         *   Scaglione

         Es. 19458 etichette. verrà scritto quantità 20000 (manualmente) = (20000/1000) * 11.64 [quantità/1000 * pr.unitarioSCAGLIONE]


         *   Stock
         */

        if (tipologia == "Normale" || tipologia == undefined) {
            prezzoTotale = quantitaScelta * (parseFloat(commaReplace(prezzoUnitario)));
        }

        if (tipologia == "Scaglione") {
            prezzoTotale = ((quantitaScelta / 1000) * (parseFloat(commaReplace(prezzoUnitario))));
        }

        if (tipologia == "Stock") {
            prezzoTotale = parseFloat(prezzoUnitario);
        }

        prezzoTotID = $("#prezzoTOT-" + quantitaId[1]);
        prezzoTotale = prezzoTotale.toFixed(2);
        prezzoTotID.text(prezzoTotale.replace(".",","));
        console.log(prezzoTotale);
        var selectPrezzi = $("p[id*=prezzoTOT-]");
        //console.log(selectPrezzi.length);
        //console.log(selectPrezzi);
        var somma = 0;
        for (var i = 0; i < selectPrezzi.length; i++) {
            //console.log(selectPrezzi[i]);
            prezzoDaSommare = parseFloat(commaReplace(selectPrezzi[i].textContent));
            console.log("prezzo da sommare " + prezzoDaSommare);
            somma += parseFloat(prezzoDaSommare.toFixed(2));

        }
        somma += parseFloat(sommaDDT);

        $("#parziale").val(dotReplace(somma.toFixed(2)));
        var iva = $("#iva").val();
        iva = somma * (iva / 100);
        var totaleDovuto = (somma + iva).toFixed(2);
        $("#totaleDovuto").val(totaleDovuto.replace(".",","));
    }

    $(".arrQuantita, #iva").click(function () {
        prezziTot($(this));
    });

    $('#cliente').devbridgeAutocomplete({
        dataType: "json",
        paramName: "check",
        serviceUrl: 'http://<?php echo $base_url ?>/json/get_clienti.php',
        formatResult: function (suggestion, currentValue) {
            return suggestion.data.PIVAC + " - " + suggestion.data.nomeC + "  " + suggestion.data.cognomeC;
        },
        onSelect: function (suggestion) {

            $("#cliente").val(suggestion.data.nomeC + "  " + suggestion.data.cognomeC);
            $("#ivaCliente").val(suggestion.data.PIVAC);
            $("#indirizzo").val(suggestion.data.indirizzoLC);
            $("#citta").val(suggestion.data.cittaLC);
            $("#pr").val(suggestion.data.provLC);
            $("#cap").val(suggestion.data.capLC);
            codCliente = suggestion.data.codC;

        }
    });

// ------------------------


    // array_push($newKey, [
    //     "value" => $ddt->id,
    //     "data" => [
    //         "num" => $ddt->id,
    //         "data_doc" => $ddt->data_doc,
    //         "arr_qta" => $arr_qta,
    //         "arr_beni" => $arr_beni,
    //         "arr_prezzi" => $arr_prezzi,
    //         "arr_prezzi_tot" => $arr_prezzi_tot,
    //         "somma" => array_sum($arr_prezzi_tot)
    //     ]
    // ]);

    $('#selectDDT').devbridgeAutocomplete({
        dataType: "json",
        paramName: "check",
        serviceUrl: 'http://<?php echo $base_url ?>/json/get_ddt_xfatt.php',
        formatResult: function (suggestion, currentValue) {
            return "DDT n° " + suggestion.data.num;
        },
        onSelect: function (suggestion) {
            console.log($("#inputDDT-" + suggestion.data.num));
            if ($("#inputDDT-" + suggestion.data.num).length == 0) {
                var ddt = `
                    <tr onclick="cancellaDDT($(this))" class="ddt-` + suggestion.data.num +`">
                        <input id="inputDDT-` + suggestion.data.num +`" type="hidden" value="` + suggestion.data.somma + `"></td>
                        <th colspan="4"><p>DDT N° ` + suggestion.data.num + ` del ` + suggestion.data.data_doc +` </p></th>
                    </tr>`;

                    var qta = suggestion.data.arr_qta;
                    for (var i = 0; i < qta.length; i++) {
                    ddt += `
                        <tr class="ddt-` + suggestion.data.num +` borderless" id="DDT-` + (i +1) + `" class="borderless">
                        <td><input type="number" readonly class="form-control arrQuantita" value="`+ suggestion.data.arr_qta[i] + `"></td>
                        <td><p class="col-xs-12 noMargin">    `+ suggestion.data.arr_beni[i] + `</p></td>
                        <td><p class="col-xs-12 noMargin valuta">`+ dotReplace(suggestion.data.arr_prezzi[i]) + `</p></td>
                        <td><p class="col-xs-12 noMargin valuta">`+ dotReplace(suggestion.data.arr_prezzi_tot[i]) + `</p>
                        </tr>`;
                    }
                $(".qnt").before(ddt);
                $("#nota").val(($("#nota").val()) + suggestion.data.note + "\n");
                sommaDDT += suggestion.data.somma;
                prezziTot($("#calcola"));
            }
            else {
                alert("DDT già esistente!");
            }
        }
    });


//-------------------------

    function cancellaDDT(elemento) {
        console.log(elemento);
        id = elemento.attr("class");
        id = id.split("-");
        sottrai = $("#inputDDT-" + id[1]).val();
        $(".ddt-"+ id[1]).remove();
        sommaDDT -= parseFloat(sottrai);
        console.log(sottrai);
        prezziTot($("#calcola"));
    }

    function saveDDT() {
        var countDDT = $("input[id*=inputDDT]");
        //console.log(countDDT);
        var id_ddt = [];
        for (var i = 0; i < countDDT.length; i++) {
            //console.log(countDDT.length);
            idDDT = countDDT[i].id;
            idDDT = idDDT.split("-");
            id_ddt.push(idDDT[1]);
        }

        return String(id_ddt);
    }
    function save() {
        var dati = {
            ddt : saveDDT(),
            richiesta: "fattura",
            azione: "<?php if (!isset($azione)) {
                echo "aggiungi";
            } else {
                echo $azione;
            } ?>",
            id: $("#fattId").val(),
            data: $("#data").val(),
            pagamento: $("#pagamento").val(),
            cliente: escapeHtml($("#cliente").val()),
            ivaCliente: escapeHtml($("#ivaCliente").val()),
            indirizzoCliente: escapeHtml($("#indirizzo").val()),
            cittaCliente: escapeHtml($("#citta").val()),
            pr: $("#pr").val(),
            cap: $("#cap").val(),
            arrayQuantita: ciclaArray($("input[id*=idQuantita-]"), "value"),
            arrayProdotti: ciclaArray($("p[id*=idArticoli-]"), "textContent"),
            arrayPrezziCad: ciclaArray($("p[id*=prezzo-]"), "textContent"),
            arrayPrezzi: ciclaArray($("p[id*=prezzoTOT-]"), "textContent"),
            tipologie: ciclaArray($("input[id*=tipologia-]"), "value"),
            parziale: $("#parziale").val().replace(",","."),
            iva: $("#iva").val(),
            note: $("#nota").val(),
            totaleDovuto: $("#totaleDovuto").val().replace(",","."),
            esenteNum: $("#esenteNum").val(),
            esIvaDal: $("#esIvaDal").val(),
            esIvaAl: $("#esIvaAl").val(),
            codC : codCliente
        };
        if (controlloClick == 1) {
        var call = $.ajax({
            url: "http://<?php echo $base_url ?>/gen_documenti/post.php",
            method: "POST",
            data: {data: dati},
            dataType: "json"
        });
        call.done(function (msg) {
            controlloClick = 0;
            console.log(msg.vai);
            if (msg.vai == "ok") {
                window.location.assign("http://<?php echo $base_url ?>/gen_documenti/post.php?" + msg.cosa + "=" + msg.dove + "&documento=" + msg.documento);
            }

            if (msg.vai == "no") {
                controlloClick = 1;
                console.log(msg.perche);
                var elem = '<div class="alert alert-danger" role="alert"><strong>Errore: </strong><span class="text">' + msg.perche + ' </span> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&nbsp &times;</span></button>';

                $("#controlloQuery").removeClass("hidden");
                $("#controlloQuery").append(elem);
            }
        });
    }

        //console.log(dati);
        return true;
    }

    function ciclaArray(variabile, nodo) {
        var i = 0,
            ritorna = "";
        for (i = 0; i < variabile.length; i++) {
            if ((i + 1) < variabile.length) {
                ritorna += escapeHtml(variabile[i][nodo]) + "||";
            }
            else {
                ritorna += escapeHtml(variabile[i][nodo]);
            }
        }

        return ritorna;
    }

    function cancella(elemento) {
        id = elemento.attr("id");
        id = id.split("-");
        index = memory.indexOf(elemento.text());
        console.log(elemento.text());
        console.log("array - " + index);
        delete memory[index];
        console.log("#ordini-" + id[1]);
        $("#ordini-" + id[1]).remove();
    }

    function checkIva() {
        var ammIva = $("#iva").val();
        if (ammIva != 0) {
            console.log($("#iva").val());
            $("#ifIva0 p").hide();
        }

        else {
            $("#ifIva0 p").show();
        }
    }
    checkIva();
    $("#iva").click(function () {
        checkIva();
    });
    function escapeHtml(text) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };

        return text.replace(/[&<>"']/g, function (m) {
            return map[m];
        });
    }

    function dotReplace(punto) {
        return punto.replace(".",",")
    }

    function commaReplace(comma) {
        return comma.replace(",",".")
    }


</script>

</body>
