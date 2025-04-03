<html lang="en">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css" title="css" />
    <script src="script.js" type="text/javascript"></script>
    <title>Registrierung</title>
</head>
<body>
    <?php
    session_start();
    ?>
    <div class="obere_leiste">
        <nav>
                <img alt="logo"> |
                <a href="Hauptseite.php">Alle Produkte</a> |
                <a href="Bestellung.php">Deine Bestellungen</a> |
                <a href="Support.html">Hilfe</a> |
                <a href="Registrierung.php">Anmeldung / Registrierung</a> |
        </nav>
		
        </div>
		 <div class="container">
        <h1 class="header">Anmeldung / Registrierung</h1>
        <?php if (isset($_SESSION['email'])): ?>
            <h2>Sie sind angemeldet als </h2>
            <form action="KndRegist.php" method="Post">
                <input type="hidden" value="abmeldung" name="action">
                <input type="submit" value="Abmelden" name="subm">
            </form>
        <?php else: ?>
<div class="divProdukt"> 
        <form action="KndRegist.php" method="Post">
            <h2>Anmeldung</h2>
            <input type="hidden" value="anmeldung" name="action">
        <strong>Email:<br></strong>
         <input type="text" name="email"><br>
        <strong>Passwort:<br></strong>
         <input type="password" name="password"><br>
            <input class="reg-submit" type="submit" value="Anmelden" name="subm"><br>
        </form>
</div>
<div class="divProdukt" >
    <form action="KndRegist.php" name="formReg" method="Post">
        <h2>Registrierung</h2>
        <input type="hidden" value="registrierung" name="action">
    <strong>Vorname:<br></strong>
    <input type="text" id="vorname" name="Vorname"><br>
    <strong>Name:<br></strong>
     <input type="text" name="Nachname"><br>
    <strong>EMail:<br></strong>
     <input type="text" name="email" onblur="evaluateReg()"><br>
    <strong>Strasse:<br></strong>
     <input type="text" name="Strasse" required><br>
    <strong>Hausnummer:<br></strong>
     <input type="number" name="Hnr"><br>
    <strong>PLZ:<br></strong>
     <input type="number" name="PLZ" onblur="evaluateReg()"><br>
    <strong>Ort:<br></strong> 
    <input type="text" name="Ort"><br>
    <strong>Passwort:<br></strong>
    <input type="password" name="password" required><br>
    <input class="reg-submit" type="submit" value="Registrieren" name="subm"><br>
    </form>
</div>
</div>
<?php endif; ?>
<footer class="Footer">
    <hr>
    <p>
        &copy; Alle Rechte vorbehalten
    </p>
</footer>
</body>
</html>