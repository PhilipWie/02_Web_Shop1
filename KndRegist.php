<?php
session_start();
  include('zugriff.inc');
  $conn = mysqli_connect($host, $user, $password, $db) or die('Conn Dead');
$regORan = $_POST['action'];
//$abme = $_POST['abmelden'];
if($regORan == 'anmeldung'){
    anmeldung($conn);
}else if($regORan == 'registrierung'){
    registrierung($conn);
}else{
    //abmeldung
    session_destroy();
    echo "Sie wurden abgemeldet";
    echo "<form action='Registrierung.php'> <h2>Melden sie
    sich hier an</h2><br>
    <input type='submit' value='Anmelden'>
    </form>"; 
}
  mysqli_close($conn);

function anmeldung($conn){

    $email = $_POST['email'];
    $passwort = $_POST['password'];
    
    $query = "Select K_Nr,K_Vorname from kunden where K_Mail = '$email' and K_Psw = '$passwort'";
    $result = mysqli_query($conn, $query) or die('Query Dead');
    $daten = mysqli_fetch_object($result);
    $K_Nr = $daten->K_Nr;
    $K_Vorname = $daten-> K_Vorname;
    
    if($K_Nr != null){
        echo "<h3>Anmeldung erfolgreich</h3>";
        echo "<a href='Hauptseite.php'><b>Kehren Sie zur Hauptseite zurück!</b></a>";
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $K_Vorname;
        $_SESSION['K_Nr'] = $K_Nr;
    }else{
        echo "Anmeldung fehlgeschlagen";
        echo "<a href='Hauptseite.php'><b>Kehren Sie zur Hauptseite zurück!</b></a>";
    }
}
function registrierung($conn){
    $Vname = $_POST['Vorname'];
    $Nname = $_POST['Nachname'];
    $email = $_POST['email'];
    $strasse = $_POST['Strasse'];
    $Hnr = $_POST['Hnr'];
    $PLZ = $_POST['PLZ'];
    $Ort = $_POST['Ort'];
    $passwort = $_POST['password'];
    
   
    //neue Kundennummer generieren
    $query = "Select Max(K_Nr) as max_kn from kunden";
    $result = mysqli_query($conn, $query) or die('Query Dead');
    $daten = mysqli_fetch_object($result);
    $K_Nr = $daten->max_kn;
    
    $K_Nr = $K_Nr + 1;
    $query = "Insert into kunden (K_Nr,K_Vorname, K_Nachname, K_Mail, K_Str, K_HNR, K_Pstl, K_Ort, K_Psw) values ($K_Nr,'$Vname', '$Nname', '$email', '$strasse', '$Hnr', '$PLZ', '$Ort', '$passwort')";
    mysqli_query($conn, $query) or die('Query Dead');
    
    $query = "Select K_Nr from kunden";
    $result = mysqli_query($conn, $query) or die('Query Dead');
    Echo "Sie haben sich erfolgreich registriert";
    Echo "<form action='Registrierung.php'> <h2>Melden sie sich hier an</h2>
    <input type='submit' value='anmeldung' name='action'>";

}

?>