<?php
session_start();
require '../assets/db.php';

// this gon make sure we logged in boy
if (empty($_SESSION['user_id'])) 
  {
  header("Location: login.php");
  exit;
}
$fid = 0;     // get the email n id from the pop up
$email = '';

if (isset($_POST['fid'])) {
    $fid = (int)$_POST['fid'];
}

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
}

if ($fid <= 0 || $email == '') {
    header("Location: results.php");
    exit;
}
    // get flight deets
$sql = "SELECT f.id, al.name AS airline,
               a1.iata AS origin, a2.iata AS destination,
               f.depart_time, f.arrive_time, f.price
        FROM flights f
        JOIN airlines al ON al.id = f.airline_id
        JOIN airports a1 ON a1.id = f.origin_airport_id
        JOIN airports a2 ON a2.id = f.destination_airport_id
        WHERE f.id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$fid]);
$flight = $stmt->fetch();

if (!$flight) {
  header("Location: results.php");
  exit;
}

 // insert data to db
$user_id = $_SESSION['user_id']; // add booking to db

$sql = "INSERT INTO bookings (user_id, flight_id) VALUES (?, ?)";
$statement = $pdo->prepare($sql);
$statement->execute([$user_id, $fid]);

// Save the new booking ID to the new one
$bookingId = $pdo->lastInsertId();

// EMAILLLLLLLLLLLLLLL   we not doin this shi cuz i got better things to do
$subject = "BSZ AIR Booking Confirmation #$bookingId";
$body = "Hi {$_SESSION['username']},

Your booking is confirmed!

Airline: {$flight['airline']}
Route:   {$flight['origin']} → {$flight['destination']}
Depart:  {$flight['depart_time']}
Arrive:  {$flight['arrive_time']}
Price:   {$flight['price']} EUR

Thanks for flying BSZ AIR!";

$headers = "From: BSZ AIR <no-reply@bsz-air.local>\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

@mail($email, $subject, $body, $headers);

// Save email for next time
$_SESSION['email'] = $email;

header("Location: my_bookings.php");
exit;