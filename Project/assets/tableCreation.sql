CREATE TABLE countries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80),
  code CHAR(2)
);

CREATE TABLE airports (
  id INT AUTO_INCREMENT PRIMARY KEY,
  country_id INT,
  name VARCHAR(120),
  iata CHAR(3),
  FOREIGN KEY (country_id) REFERENCES countries(id)
);

CREATE TABLE airlines (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100)
);

CREATE TABLE flights (
  id INT AUTO_INCREMENT PRIMARY KEY,
  airline_id INT,
  origin_airport_id INT,
  destination_airport_id INT,
  depart_time DATETIME,
  arrive_time DATETIME,
  price DECIMAL(8,2),
  FOREIGN KEY (airline_id) REFERENCES airlines(id),
  FOREIGN KEY (origin_airport_id) REFERENCES airports(id),
  FOREIGN KEY (destination_airport_id) REFERENCES airports(id)
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50),
  email VARCHAR(120),
  password VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  flight_id INT,
  booked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (flight_id) REFERENCES flights(id)
);
