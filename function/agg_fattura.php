<!DOCTYPE html>

<html lang="it">
<head>
    <!-- blu #071E3F arancione #EA640C -->
    <meta charset="utf-8">
    <title>Lista Fornitori - Gestionale Provenzano</title>
    <meta name="description" content="Gestionale per etichettificio Provenzano"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <?php include_once("../template/parrot/style.php") // Carica gli stili del tema in uso ?>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <![endif]-->

    <?php include_once("session.php"); ?>
    <style>
        .autocomplete-suggestions {color: #000000}
        .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-selected { background: #F0F0F0; }
        .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
        .autocomplete-group { padding: 2px 5px; }
        .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
    </style>
</head>
<body>
<!-- #### Navbars #### -->
<?php include_once("../template/parrot/navbar.php") ?>

<div class="masthead">
    <div class="masthead-title">
        <div class="container">
            Genera Fattura
            <small>Gestionale & Fatturazione</small>
        </div>
    </div>
</div>

<div class="container">
    <form class="form-horizontal" method="post" action="#">
        <div class="form-group">
            <label class="col-sm-2 control-label">ID cliente</label>
            <div class="col-sm-10">
                <input id="idCliente" type="number" name="idcliente" class="idCliente form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Nome e cognome</label>
            <div class="col-sm-10">
                <input id="nomeCognome" type="text" class="idCliente form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Conferma</button>
            </div>
        </div>
    </form>
</div>

<?php include_once("../template/parrot/foot.php") ?>
<script>
    $('.idCliente').devbridgeAutocomplete({
        dataType: "json",
        paramName: "check",
        serviceUrl: 'get_clienti.php',
        formatResult: function(suggestion, currentValue){
            return suggestion.value + ' - ' +suggestion.data.cognome+' '+suggestion.data.nome;
        },
        onSelect: function (suggestion) {
            $("#idCliente")
                .val(suggestion.value);
            $("#nomeCognome").val(suggestion.data.nome + " " + suggestion.data.cognome);
        }
    });
</script>

</body>
</html>
