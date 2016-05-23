<?php
include_once("session.php");
include_once("../DB/config.php");

$query = "SELECT num
                FROM numerazione_ftt";

/* check connection */
if ($result = $conndb->query($query)) {
    if ($debug === true) printf("<!-- Select returned %d rows.\n -->", $result->num_rows);
    $oggetto_prev = 1;
    if ($result->num_rows === 0) {
        $numerazione_fatt = 1;
    }
    if ($result->num_rows > 0) {
        $last_row = $result->fetch_object();
        $numerazione_fatt = $last_row->num + 1;
    }


}
if ($conndb->connect_errno) {
    printf("Connect failed: %s\n", $conndb->connect_error);
    $numerazione_fatt = "Errore";
}

?>

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
    <div class="row">
    <form class="form-horizontal" method="post" action="#">
        <input type="hidden" value="<?php echo $numerazione_fatt ?>">
        <div class="form-group col-sm-3">
            <label class="col-sm-12 control-label">ID cliente</label>
            <div class="col-sm-12">
                <input id="idCliente" type="number" name="idcliente" class="idCliente form-control">
            </div>
        </div>
        <div class="form-group col-sm-9">
            <label class="col-sm-12 control-label">Nome e cognome</label>
            <div class="col-sm-12">
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
