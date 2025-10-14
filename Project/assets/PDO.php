<?php
    $pdo = new PDO('mysql:host=localhost;dbname=BrownJustin','root','');
?>

<?php
    $select = "SELECT * FROM benutzer;";
    foreach ($pdo->query($select) as $row) {
        $Vorname = $row['Vorname'];
        $Nachname = $row['Nachname'];
        $Benutzer = $row['Benutzername'];
        $Passwort = $row['Passwort'];
        echo "$Benutzer: $Vorname $Nachname<br>";
    }

?>