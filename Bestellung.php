<html lang="en">

<head>
    <?php
    session_start();
    ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css" title="css" />
    <title>Bestellung</title>
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
    <h1 class="header">Deine Bestellungen</h1>
    <div class="container">

        <?php
        include('zugriff.inc');
        $conn = mysqli_connect($host, $user, $password, $db) or die('Conn Dead');
        //nur wenn jmd angemeldet ist:
        if (isset($_SESSION['email'])) {
            $knr = $_SESSION['K_Nr'];
            //wenn der bestell button auf der Hauptseite gedrückt wurde - wird eine neue Bst hinzugefügt
            if (isset($_POST['subm_Bst'])) {
                //neue Bst_Nr generieren
                $query = "Select Max(Bst_Nr) as max_kn from bestellungen";
                $result = mysqli_query($conn, $query) or die('Query Dead');
                $daten = mysqli_fetch_object($result);
                $bst = $daten->max_kn;
                $bst = $bst + 1;

                $pr_id = $_POST['subm_Bst'];
                $bst_menge = $_POST['bst_menge'];

                $query = "Insert Into bestellungen(Bst_Nr,K_Nr,Pr_Nr,Bst_Datum,Bst_Menge,Bst_Status) 
            Values($bst,$knr,$pr_id,NOW(),$bst_menge,'offen')";
                mysqli_query($conn, $query) or die('Query Dead');
            }
            // Gucken ob der Benutzer überhaupt Bestellungen aufgegeben hat
            $query = "Select Count(*) as 'i' from bestellungen where K_Nr = $knr";
            $result = mysqli_query($conn, $query) or die("Query Dead");
            $daten = mysqli_fetch_object($result);
            $i = $daten->i;

            if ($i == 0) {
                echo "<h2>Noch keine Bestellungen aufgegeben!</h2>";
            } else {
                // Alle Bst des jwg Kunden anzeigen
                $query = "Select * from bestellungen where K_Nr = $knr";
                $result1 = mysqli_query($conn, $query) or die('Query Dead');
                while ($daten1 = mysqli_fetch_object($result1)) {
                    $prnr = $daten1->Pr_Nr;
                    $datum = $daten1->Bst_Datum;
                    $status = $daten1->Bst_Status;
                    $query = "Select * from produkte where Pr_Nr = $prnr";
                    $result2 = mysqli_query($conn, $query) or die("query dead");
                    while ($daten2 = mysqli_fetch_object($result2)) {
                        $name = $daten2->Pr_Name;
                        $preis = $daten2->Pr_Preis;
                        $bst = $daten2->Pr_Lagerbst;
                        $bild = $daten2->P_bildPfad;
                        $id = $daten2->Pr_Nr;



                        echo "<div class='divProdukt'>";
                        echo "<h3> Vielen Dank für deine Bestellung:</h3>";
                        echo "    <h2>$name</h2>";
                        echo "    <div class='divProdBild'>";
                        echo "        <img class='prod-img1' src='$bild'>";
                        echo "        <p>Preis: $preis</p>";
                        echo "        <p>Status: $status</p>";
                        echo "        <p>Bestell-Datum: $datum";
                        echo "    </div>";
                        echo "</div>";
                        echo "<br><br>";
                    }
                }
            }
        } else {
            echo "<h3>Bitte melden Sie sich an um Ihre Bestellungen zu sehen</h3> <br>";
            echo "<a href='Registrierung.php'>Anmeldung / Registrierung</a>";
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