<html>

<head>
    <meta charset="utf-8">
    <title>Accesso riservato</title>
    <link rel="stylesheet" href="css/style.css" media="all">
</head>

<body>

<div class="loginContainer">
    <div class="container">
        <div class="loginForm">
                <form action="creadb.php" method="POST">
                    <span>Creazione DB</span><br>
                    <input type="text" name="host" placeholder="Server del database">
                    <input type="text" name="userDB" placeholder="Username">
                    <input type="password" name="pswdDB" placeholder="Password">
                    <input type="text" name="database" placeholder="Nome del database locale">
                    <br><input type="submit" value="Crea DB">
                </form>
        </div>
        <div class="loginForm">
                <form action="creatabelle.php" method="POST">
                    <span>Crea Tabelle</span><br>
                    <input type="submit" value="Crea tabelle">
                </form>
        </div>
        <div class="loginForm">
        <form action="dropDB.php" method="POST">
            <span>Cancella DB</span><br>
            <input type="submit" value="Cancella">
        </form>
        </div>
        <div class="loginForm">
        <form action="droptabelle.php" method="POST">
            <span>Cancella Tabelle</span><br>
            <input type="submit" value="Cancella tabelle">
        </form>
        </div>
            <div class="loginForm">
                <form action="creareclogin.php" method="POST">
                    <h3>Nuovo utente</h3>
                    <select name="tipoFORM">
                        <option value="Titolare">Titolare</option>
                        <option value="Operatore">Operatore</option>
                        <option value="Tecnico">Tecnico</option>
                    </select><br/>
                    <input type="text" name="userFORM" placeholder="Username">
                    <input type="password" name="pswdFORM" placeholder="Password">
                    <br/><input type="submit" value="Crea utente">
                </form>
            </div>

        <div class="loginForm">
                <form action="../index.php" method="POST">
                    <span>Provami</span><br>
                    <input type="submit" value="Home gestionale">
                </form>
        </div>
    </div>
</div>

</body>

</html>
