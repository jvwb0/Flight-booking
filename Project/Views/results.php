<?php
require '../assets/db.php';

$from   = $_GET['from'];
$to     = $_GET['to'];

$sql = "SELECT f.id, al.name AS airline,
                     a1.iata AS origin, 
                     a2.iata AS destination,
                    f.depart_time, f.arrive_time, f.price
        FROM flights f
        WHERE (a1.iata = ? OR c1.name = ?)
        AND (a2.iata = ? OR c2.name = ?)
        ORDER BY f.depart_time";

$befehl = $pdo->prepare($sql);
$befehl->execute(array($from, $from, $to, $to));
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Results</title>
  <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
  <main class="card">
    <h1 class="title">Search Results</h1>
  <?php
    while($r = $befehl->fetch()) {
      echo $r['airline']." | ".$r['origin']." → ".$r['destination']." | ".
           $r['depart_time']." → ".$r['arrive_time']." | ".
           $r['price']." EUR ".
           "<a class='link' href='book.php?fid=".$r['id']."'>book</a><br>";
    }
  ?>
    <br><a class="link" href="main.php">Back</a>

  </main>
</body>
</html>