<!DOCTYPE html>

<html lang="it">
<head>
    <!-- blu #071E3F arancione #EA640C -->
	<meta charset="utf-8">
	<title>Lista Clienti - Gestionale Provenzano</title>
	<meta name="description" content="Gestionale per etichettificio Provenzano"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <?php include_once("template/parrot/style.php") // Carica gli stili del tema in uso ?>

    <?php include_once("function/session.php"); ?>

</head>
<body>
        <!-- #### Navbars #### -->
        <?php include_once("template/parrot/navbar.php") ?>

        <div class="masthead">
            <div class="masthead-title">
                <div class="container">
                    <img src="images/logob.png" width="80%" alt=""><br/>
                    Documenti di Trasporto
                    <small>Gestionale & Fatturazione</small>
                </div>
            </div>
        </div>

    <div class="container">
        <div>
            <form action="gen_documenti/ddt.html">
                <input style="width: auto" class="form-control" type="submit" value="Genera DDT">
            </form>
        </div>
    </div>

    <?php include_once("template/parrot/foot.php") ?>

</body>
</html>
