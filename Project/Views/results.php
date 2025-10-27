<?php
session_start();
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
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Results</title>
  <link rel="stylesheet" href="../assets/styles.css">  <!--https://www.geeksforgeeks.org/php/how-to-fetch-data-from-localserver-database-and-display-on-html-table-using-php/!-->
  <style>
  table {
    margin: 0 auto;
    width: 90%;
    border-collapse: collapse;
    font-family: system-ui, Arial, sans-serif;
    font-size: 15px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(0,0,0,0.08);
  }

  th {
    background-color: #ff914d;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
    padding: 14px;
  }

  td {
    padding: 12px 14px;
    border-bottom: 1px solid #f3e7db;
    text-align: center;
    background-color: #fffaf6;
  }

  tr:nth-child(even) td {
    background-color: #fff3ea;
  }

  tr:hover td {
    background-color: #ffe5cc;
  }

  .book {
    background: linear-gradient(90deg, #ff914d, #f57b51);
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
  }
  .book:hover {
    filter: brightness(1.1);
  }
  
    </style>
</head>
<body class="main-view">
    <header class="topbar">
        <div class="brand">
            <span class="brand-mark">✈️</span>
            <span class="brand-name">BSZ AIR</span>
        </div>
        <nav class="nav">
          <?php if (!empty($_SESSION['username'])): ?>
            <span class="nav-link">Hi, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
            <a class="nav-link" href="my_bookings.php">My bookings</a>
            <a class="nav-link strong" href="logout.php">Logout</a>
          <?php else: ?>
            <a class="nav-link" href="login.php">Login</a>
            <a class="nav-link strong" href="register.php">Sign Up</a>
          <?php endif; ?>
        </nav>
    </header>
    <br><br>
    <h1 class="title" style="color:#d36b00;text-align:center;">Available Flights</h1>
    <main>
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
                        <td>
                            <?php if (!empty($_SESSION['user_id'])): ?>
                              <button class="book"type="button" data-fid="<?= (int)$row['id'] ?>"
                                data-airline="<?= htmlspecialchars($row['airline']) ?>"
                                data-origin="<?= htmlspecialchars($row['origin']) ?>"
                                data-destination="<?= htmlspecialchars($row['destination']) ?>"
                                data-price="<?= htmlspecialchars($row['price']) ?>"
                                onclick="openBookDialog(this)"
                            >Book</button>
                          <?php else: ?>
                            <a class="book" href="login.php">Login to book</a>
                          <?php endif; ?>
                      </td>
                    </tr>
                    <?php
                }
            if ($befehl->rowCount() == 0)
                {
                echo "No flights found.<br>";
                }
            ?>
        </table>
    </main>
    <br>
    <footer class="footer">
    <button class="btn" style="width: 15%;" type="button" onclick="window.location.href='<?php echo $_SERVER['HTTP_REFERER'] ?? 'main.php'; ?>'">Back</button>
        <br><br><br><br><br><br><small>© BSZ AIR — made for a school project</small>
    </footer>
      <dialog id="bookDialog">
        <form method="post" action="book.php" id="bookForm">
          <h3 style="margin:0 0 8px 0;">Confirm booking</h3>
          <p id="flightSummary" style="margin:0 0 10px 0;"></p>

          <input type="hidden" name="fid" id="fid">

          <label class="label" for="email">Confirmation email</label>
          <input class="input" type="email" name="email" id="email" required
              value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '';?>">
          <div style="margin-top:12px; display:flex; gap:8px; justify-content:flex-end;">
            <button class="btn" type="submit">Book & Send</button>
            <button class="btn" type="button" onclick="document.getElementById('bookDialog').close()">Cancel</button>
          </div>
        </form>
      </dialog>
      <script>
        function openBookDialog(btn){
          const d = document.getElementById('bookDialog');
          document.getElementById('fid').value = btn.dataset.fid;
          document.getElementById('flightSummary').textContent =
      `     ${btn.dataset.airline}  ${btn.dataset.origin} → ${btn.dataset.destination}  —  €${btn.dataset.price}`;
          if (typeof d.showModal === 'function') d.showModal(); else d.show();
          }
      </script>
    </body>
</html>