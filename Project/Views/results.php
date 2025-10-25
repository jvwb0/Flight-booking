<?php
require '../assets/db.php';

$from   = $_GET['from'];
$to     = $_GET['to'];

$sql = "SELECT f.id, al.name AS airline,
                     a1.iata AS origin, 
                     a2.iata AS destination,
                    f.depart_time, f.arrive_time, f.price
        FROM flights f
        JOIN airlines al ON al.id = f.airline_id
        JOIN airports a1 ON a1.id = f.origin_airport_id
        JOIN airports a2 ON a2.id = f.destination_airport_id
        JOIN countries c1 ON c1.id = a1.country_id
        JOIN countries c2 ON c2.id = a2.country_id
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
    if ($befehl->rowCount() == 0)
    {
        echo "No flights found.<br>";
    }
  ?>
    <br><a class="link" href="main.php">Back</a>

  </main>
</body>
</html>