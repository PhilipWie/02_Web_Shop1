<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" title="css" />

    <title>Handy Laden</title>
</head>

<body>
    <div class="obere_leiste">
        <nav>
            <img alt="logo"> |
            <a href="Hauptseite.php">Alle Produkte</a> |
            <a href="Bestellung.php">Deine Bestellungen</a> |
            <a href="Support.html">Hilfe</a> |
            <a href="Registrierung.php">Anmeldung / Registrierung</a> |
        </nav>
    </div>
    <h1 class="header">Handy Laden</h1>
    <div class="container">
        <?php
        include("zugriff.inc");
        $conn = mysqli_connect($host, $user, $password, $db) or die("conn dead");
        $query = "Select * from produkte ";
        $result = mysqli_query($conn, $query) or die("query dead");

        while ($daten = mysqli_fetch_object($result)) {
            $name = $daten->Pr_Name;
            $preis = $daten->Pr_Preis;
            $bst = $daten->Pr_Lagerbst;
            $bild = $daten->P_bildPfad;
            $id = $daten->Pr_Nr;


            echo "<div class='divProdukt'>";
            echo "    <h2>$name</h2>";
            echo "    <div class='divProdBild'>";
            echo "        <img class='prod-img1' src='$bild'>";
            echo "    </div>";
            if ($bst >= 1) {
                echo "<p class='font'>$preis € <strong>Lieferbar</strong> </p>";
            } else {
                echo "<p>$preis € <strong>Derzeit nicht Verfügbar</strong> </p>";
            }
            echo "<form action='Bestellung.php' method='Post'>";
            echo "Menge: <select name='bst_menge'>";
            for ($i = 1; $i <= $bst; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            echo "</select>";

            echo "<br><br>
    <button type='submit' class='prod-button' name='subm_Bst' value='$id' >Bestellen</button>
	</form>";

            echo "</div>";
        }
        mysqli_close($conn);
        ?>
     </div>

    <footer class="Footer">
        <p>
            &copy; Alle Rechte vorbehalten
        </p>
    </footer>
   
</body>

</html>