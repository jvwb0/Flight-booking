-- Datentabellen
---------------------------
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

-- CHATGPT Query : "lets fill the countries, airlines, airports, flights (imaginary)"
-- countries
-------------------------------------------
INSERT INTO countries (name, code) VALUES
('Germany', 'DE'),
('Spain', 'ES'),
('Japan', 'JP'),
('United States', 'US'),
('Italy', 'IT'),
('France', 'FR'),
('Canada', 'CA'),
('United Kingdom', 'UK');

-- airlines
-----------------------------
INSERT INTO airlines (name) VALUES
('Lufthansa'),
('Iberia'),
('ANA'),
('United Airlines'),
('Air France'),
('British Airways'),
('Air Canada'),
('Alitalia');

-- Airports 
-------------------------------------------
INSERT INTO airports (country_id, name, iata) VALUES
-- Germany
(1, 'Berlin Brandenburg', 'BER'),
(1, 'Munich', 'MUC'),
(1, 'Frankfurt Main', 'FRA'),

-- Spain
(2, 'Madrid Barajas', 'MAD'),
(2, 'Barcelona El Prat', 'BCN'),

-- Japan
(3, 'Tokyo Haneda', 'HND'),
(3, 'Tokyo Narita', 'NRT'),
(3, 'Osaka Kansai', 'KIX'),

-- United States
(4, 'New York JFK', 'JFK'),
(4, 'Los Angeles LAX', 'LAX'),
(4, 'Chicago O\'Hare', 'ORD'),

-- Italy
(5, 'Rome Fiumicino', 'FCO'),
(5, 'Milan Malpensa', 'MXP'),

-- France
(6, 'Paris Charles de Gaulle', 'CDG'),
(6, 'Nice Cote d\'Azur', 'NCE'),

-- Canada
(7, 'Toronto Pearson', 'YYZ'),
(7, 'Vancouver Intl', 'YVR'),

-- United Kingdom
(8, 'London Heathrow', 'LHR'),
(8, 'Manchester', 'MAN');

-- Flights
----------------------------------------------------
--(25 realistic sample flights with date, time, airline, origin, destination, price)
INSERT INTO flights (airline_id, origin_airport_id, destination_airport_id, depart_time, arrive_time, price) VALUES
-- Europe short-haul
(1, 1, 4, '2025-11-05 09:00', '2025-11-05 12:00', 149.00),
(1, 2, 5, '2025-11-06 08:30', '2025-11-06 11:00', 139.00),
(1, 3, 14, '2025-11-07 07:15', '2025-11-07 09:00', 129.00),
(5, 14, 3, '2025-11-08 10:15', '2025-11-08 12:00', 119.00),
(6, 19, 14, '2025-11-09 11:00', '2025-11-09 13:15', 99.00),

-- Germany <-> Spain
(2, 4, 3, '2025-11-10 15:30', '2025-11-10 18:10', 159.00),
(2, 5, 2, '2025-11-11 17:00', '2025-11-11 19:20', 149.00),

-- Italy <-> France
(5, 12, 14, '2025-11-12 09:45', '2025-11-12 10:55', 89.00),
(8, 13, 15, '2025-11-13 13:00', '2025-11-13 14:20', 79.00),

-- Transatlantic
(4, 9, 3, '2025-11-14 07:00', '2025-11-15 05:00', 699.00),
(4, 10, 2, '2025-11-14 08:00', '2025-11-14 16:00', 499.00),
(7, 17, 19, '2025-11-14 09:00', '2025-11-14 21:00', 499.00),
(4, 11, 1, '2025-11-15 12:00', '2025-11-16 01:00', 559.00),
(7, 18, 3, '2025-11-16 10:00', '2025-11-17 08:00', 699.00),

-- Asia / Japan routes
(3, 6, 8, '2025-11-18 09:00', '2025-11-18 11:00', 149.00),
(3, 8, 6, '2025-11-19 14:30', '2025-11-19 16:30', 149.00),
(3, 7, 1, '2025-11-20 13:00', '2025-11-20 19:00', 699.00),

-- UK / Europe
(6, 19, 5, '2025-11-21 07:15', '2025-11-21 10:00', 139.00),
(6, 20, 12, '2025-11-22 09:45', '2025-11-22 12:15', 139.00),

-- Canada / US
(7, 17, 10, '2025-11-23 11:00', '2025-11-23 13:00', 239.00),
(7, 18, 11, '2025-11-23 12:30', '2025-11-23 14:45', 249.00),
(4, 9, 18, '2025-11-24 07:00', '2025-11-24 09:00', 199.00),
(4, 11, 17, '2025-11-25 10:00', '2025-11-25 14:00', 299.00),

-- Random mix
(5, 15, 13, '2025-11-26 09:00', '2025-11-26 10:30', 89.00),
(1, 2, 14, '2025-11-27 08:00', '2025-11-27 09:30', 109.00),
(2, 5, 1, '2025-11-28 18:00', '2025-11-28 21:00', 149.00);
