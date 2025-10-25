<?php
require '../assets/db.php';

$from   = $_GET['from'];
$to     = $_GET['to'];
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
$order = ($sort == 'desc') ? 'DESC' : 'ASC';

$sql = "SELECT f.id, al.name AS airline,
                     a1.iata AS origin, 
                     a2.iata AS destination,
                     f.price
        FROM flights f
        JOIN airlines al ON al.id = f.airline_id
        JOIN airports a1 ON a1.id = f.origin_airport_id
        JOIN airports a2 ON a2.id = f.destination_airport_id
        JOIN countries c1 ON c1.id = a1.country_id
        JOIN countries c2 ON c2.id = a2.country_id
        WHERE (a1.iata = ? OR c1.name = ?)
        AND (a2.iata = ? OR c2.name = ?)
        ORDER BY f.price $order";

$befehl = $pdo->prepare($sql);
$befehl->execute(array($from, $from, $to, $to));
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Results</title>
  <link rel="stylesheet" href="../assets/styles.css">  <!--https://www.geeksforgeeks.org/php/how-to-fetch-data-from-localserver-database-and-display-on-html-table-using-php/!-->  
</head>
<body class="results-view">
    <div class="results-container">
        <h1>Available Flights</h1>
    <table>
      <tr>
        <th>Airline</th>
        <th>From</th>
        <th>To</th>
        <th>Price €</th>
        <th></th>
      </tr>
      <?php
        while($row = $befehl->fetch()) 
        {
        ?>
        <tr>
            <td><?php echo $row['airline']; ?></td>
            <td><?php echo $row['origin']; ?></td>
            <td><?php echo $row['destination']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><a class="book" href="book.php?fid=<?php echo $row['id']; ?>">Book</a></td>
        </tr>
        <?php
        }
        if ($befehl->rowCount() == 0)
            {
                echo "No flights found.<br>";
            }
        ?>
    </table>
    <br><a class="link" href="main.php">Back</a>
</body>
</html>