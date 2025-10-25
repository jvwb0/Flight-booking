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
-- Europe short-haul
INSERT INTO flights (airline_id, origin_airport_id, destination_airport_id, depart_time, arrive_time, price)
VALUES (
  (SELECT id FROM airlines  WHERE name='Lufthansa'),
  (SELECT id FROM airports  WHERE iata='BER'),
  (SELECT id FROM airports  WHERE iata='MAD'),
  '2025-11-05 09:00','2025-11-05 12:00',149.00
);

INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='Lufthansa'),
  (SELECT id FROM airports  WHERE iata='MUC'),
  (SELECT id FROM airports  WHERE iata='BCN'),
  '2025-11-06 08:30','2025-11-06 11:00',139.00
);

INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='Lufthansa'),
  (SELECT id FROM airports  WHERE iata='FRA'),
  (SELECT id FROM airports  WHERE iata='CDG'),
  '2025-11-07 07:15','2025-11-07 09:00',129.00
);

INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='Air France'),
  (SELECT id FROM airports  WHERE iata='CDG'),
  (SELECT id FROM airports  WHERE iata='FRA'),
  '2025-11-08 10:15','2025-11-08 12:00',119.00
);

INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='British Airways'),
  (SELECT id FROM airports  WHERE iata='LHR'),
  (SELECT id FROM airports  WHERE iata='CDG'),
  '2025-11-09 11:00','2025-11-09 13:15',99.00
);

-- Germany <-> Spain
INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='Iberia'),
  (SELECT id FROM airports  WHERE iata='MAD'),
  (SELECT id FROM airports  WHERE iata='FRA'),
  '2025-11-10 15:30','2025-11-10 18:10',159.00
);

INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='Iberia'),
  (SELECT id FROM airports  WHERE iata='BCN'),
  (SELECT id FROM airports  WHERE iata='MUC'),
  '2025-11-11 17:00','2025-11-11 19:20',149.00
);

-- Italy <-> France
INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='Air France'),
  (SELECT id FROM airports  WHERE iata='FCO'),
  (SELECT id FROM airports  WHERE iata='CDG'),
  '2025-11-12 09:45','2025-11-12 10:55',89.00
);

INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='Alitalia'),
  (SELECT id FROM airports  WHERE iata='MXP'),
  (SELECT id FROM airports  WHERE iata='NCE'),
  '2025-11-13 13:00','2025-11-13 14:20',79.00
);

-- Transatlantic
INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='United Airlines'),
  (SELECT id FROM airports  WHERE iata='JFK'),
  (SELECT id FROM airports  WHERE iata='FRA'),
  '2025-11-14 07:00','2025-11-15 05:00',699.00
);

INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='United Airlines'),
  (SELECT id FROM airports  WHERE iata='LAX'),
  (SELECT id FROM airports  WHERE iata='MUC'),
  '2025-11-14 08:00','2025-11-14 16:00',499.00
);

INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='Air Canada'),
  (SELECT id FROM airports  WHERE iata='YYZ'),
  (SELECT id FROM airports  WHERE iata='LHR'),
  '2025-11-14 09:00','2025-11-14 21:00',499.00
);

INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='United Airlines'),
  (SELECT id FROM airports  WHERE iata='ORD'),
  (SELECT id FROM airports  WHERE iata='BER'),
  '2025-11-15 12:00','2025-11-16 01:00',559.00
);

INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='Air Canada'),
  (SELECT id FROM airports  WHERE iata='YVR'),
  (SELECT id FROM airports  WHERE iata='FRA'),
  '2025-11-16 10:00','2025-11-17 08:00',699.00
);

-- Japan routes
INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='ANA'),
  (SELECT id FROM airports  WHERE iata='HND'),
  (SELECT id FROM airports  WHERE iata='KIX'),
  '2025-11-18 09:00','2025-11-18 11:00',149.00
);

INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='ANA'),
  (SELECT id FROM airports  WHERE iata='KIX'),
  (SELECT id FROM airports  WHERE iata='HND'),
  '2025-11-19 14:30','2025-11-19 16:30',149.00
);

INSERT INTO flights VALUES (
  NULL,
  (SELECT id FROM airlines  WHERE name='ANA'),
  (SELECT id FROM airports  WHERE iata='NRT'),
  (SELECT id FROM airports  WHERE iata='BER'),
  '2025-11-20 13:00','2025-11-20 19:00',699.00
);

-- CHAT GPT Query :
-- "more flights please, maybe use the same origin and destinations but different times, prices with airlines"
-- More options for existing routes

INSERT INTO flights VALUES
-- BER -> MAD (Lufthansa, Iberia)
(NULL,(SELECT id FROM airlines WHERE name='Lufthansa'),(SELECT id FROM airports WHERE iata='BER'),(SELECT id FROM airports WHERE iata='MAD'),'2025-11-21 06:45','2025-11-21 09:35',129.00),
(NULL,(SELECT id FROM airlines WHERE name='Iberia'),    (SELECT id FROM airports WHERE iata='BER'),(SELECT id FROM airports WHERE iata='MAD'),'2025-11-21 12:10','2025-11-21 15:00',159.00),
(NULL,(SELECT id FROM airlines WHERE name='Lufthansa'),(SELECT id FROM airports WHERE iata='BER'),(SELECT id FROM airports WHERE iata='MAD'),'2025-11-22 18:20','2025-11-22 21:10',119.00),

-- MUC -> BCN (Lufthansa, Iberia)
(NULL,(SELECT id FROM airlines WHERE name='Lufthansa'),(SELECT id FROM airports WHERE iata='MUC'),(SELECT id FROM airports WHERE iata='BCN'),'2025-11-21 07:30','2025-11-21 09:55',109.00),
(NULL,(SELECT id FROM airlines WHERE name='Iberia'),    (SELECT id FROM airports WHERE iata='MUC'),(SELECT id FROM airports WHERE iata='BCN'),'2025-11-21 15:25','2025-11-21 17:50',139.00),
(NULL,(SELECT id FROM airlines WHERE name='Lufthansa'),(SELECT id FROM airports WHERE iata='MUC'),(SELECT id FROM airports WHERE iata='BCN'),'2025-11-22 20:10','2025-11-22 22:30',99.00),

-- FRA -> CDG (Lufthansa, Air France)
(NULL,(SELECT id FROM airlines WHERE name='Lufthansa'),(SELECT id FROM airports WHERE iata='FRA'),(SELECT id FROM airports WHERE iata='CDG'),'2025-11-21 08:05','2025-11-21 09:40',89.00),
(NULL,(SELECT id FROM airlines WHERE name='Air France'),(SELECT id FROM airports WHERE iata='FRA'),(SELECT id FROM airports WHERE iata='CDG'),'2025-11-21 13:40','2025-11-21 15:15',99.00),
(NULL,(SELECT id FROM airlines WHERE name='Air France'),(SELECT id FROM airports WHERE iata='FRA'),(SELECT id FROM airports WHERE iata='CDG'),'2025-11-22 19:20','2025-11-22 20:55',79.00),

-- CDG -> FRA (Air France, Lufthansa)
(NULL,(SELECT id FROM airlines WHERE name='Air France'),(SELECT id FROM airports WHERE iata='CDG'),(SELECT id FROM airports WHERE iata='FRA'),'2025-11-21 06:50','2025-11-21 08:25',85.00),
(NULL,(SELECT id FROM airlines WHERE name='Lufthansa'),(SELECT id FROM airports WHERE iata='CDG'),(SELECT id FROM airports WHERE iata='FRA'),'2025-11-21 17:10','2025-11-21 18:45',92.00),

-- LHR -> CDG (British Airways, Air France)
(NULL,(SELECT id FROM airlines WHERE name='British Airways'),(SELECT id FROM airports WHERE iata='LHR'),(SELECT id FROM airports WHERE iata='CDG'),'2025-11-21 09:00','2025-11-21 11:15',95.00),
(NULL,(SELECT id FROM airlines WHERE name='Air France'),      (SELECT id FROM airports WHERE iata='LHR'),(SELECT id FROM airports WHERE iata='CDG'),'2025-11-21 18:30','2025-11-21 20:45',99.00),

-- MAD -> FRA (Iberia, Lufthansa)
(NULL,(SELECT id FROM airlines WHERE name='Iberia'),    (SELECT id FROM airports WHERE iata='MAD'),(SELECT id FROM airports WHERE iata='FRA'),'2025-11-22 07:10','2025-11-22 09:55',139.00),
(NULL,(SELECT id FROM airlines WHERE name='Lufthansa'),(SELECT id FROM airports WHERE iata='MAD'),(SELECT id FROM airports WHERE iata='FRA'),'2025-11-22 16:20','2025-11-22 19:05',149.00),

-- BCN -> MUC (Iberia, Lufthansa)
(NULL,(SELECT id FROM airlines WHERE name='Iberia'),    (SELECT id FROM airports WHERE iata='BCN'),(SELECT id FROM airports WHERE iata='MUC'),'2025-11-22 06:40','2025-11-22 09:05',119.00),
(NULL,(SELECT id FROM airlines WHERE name='Lufthansa'),(SELECT id FROM airports WHERE iata='BCN'),(SELECT id FROM airports WHERE iata='MUC'),'2025-11-22 21:10','2025-11-22 23:35',129.00),

-- JFK -> FRA (United, Lufthansa)
(NULL,(SELECT id FROM airlines WHERE name='United Airlines'),(SELECT id FROM airports WHERE iata='JFK'),(SELECT id FROM airports WHERE iata='FRA'),'2025-11-23 17:30','2025-11-24 06:45',649.00),
(NULL,(SELECT id FROM airlines WHERE name='Lufthansa'),      (SELECT id FROM airports WHERE iata='JFK'),(SELECT id FROM airports WHERE iata='FRA'),'2025-11-23 22:15','2025-11-24 11:20',689.00),

-- LAX -> MUC (United, Lufthansa)
(NULL,(SELECT id FROM airlines WHERE name='United Airlines'),(SELECT id FROM airports WHERE iata='LAX'),(SELECT id FROM airports WHERE iata='MUC'),'2025-11-24 08:00','2025-11-24 16:05',479.00),
(NULL,(SELECT id FROM airlines WHERE name='Lufthansa'),      (SELECT id FROM airports WHERE iata='LAX'),(SELECT id FROM airports WHERE iata='MUC'),'2025-11-24 13:45','2025-11-24 21:50',529.00),

-- YYZ -> LHR (Air Canada, British Airways)
(NULL,(SELECT id FROM airlines WHERE name='Air Canada'),     (SELECT id FROM airports WHERE iata='YYZ'),(SELECT id FROM airports WHERE iata='LHR'),'2025-11-25 19:20','2025-11-26 07:10',459.00),
(NULL,(SELECT id FROM airlines WHERE name='British Airways'),(SELECT id FROM airports WHERE iata='YYZ'),(SELECT id FROM airports WHERE iata='LHR'),'2025-11-25 22:30','2025-11-26 10:20',489.00),

-- ORD -> BER (United, Lufthansa)
(NULL,(SELECT id FROM airlines WHERE name='United Airlines'),(SELECT id FROM airports WHERE iata='ORD'),(SELECT id FROM airports WHERE iata='BER'),'2025-11-26 16:00','2025-11-27 07:50',569.00),
(NULL,(SELECT id FROM airlines WHERE name='Lufthansa'),      (SELECT id FROM airports WHERE iata='ORD'),(SELECT id FROM airports WHERE iata='BER'),'2025-11-26 21:10','2025-11-27 12:55',589.00),

-- YVR -> FRA (Air Canada, Lufthansa)
(NULL,(SELECT id FROM airlines WHERE name='Air Canada'),     (SELECT id FROM airports WHERE iata='YVR'),(SELECT id FROM airports WHERE iata='FRA'),'2025-11-27 12:10','2025-11-28 08:05',679.00),
(NULL,(SELECT id FROM airlines WHERE name='Lufthansa'),      (SELECT id FROM airports WHERE iata='YVR'),(SELECT id FROM airports WHERE iata='FRA'),'2025-11-27 17:40','2025-11-28 11:25',709.00),

-- HND <-> KIX (ANA, mixed times)
(NULL,(SELECT id FROM airlines WHERE name='ANA'),(SELECT id FROM airports WHERE iata='HND'),(SELECT id FROM airports WHERE iata='KIX'),'2025-11-21 07:20','2025-11-21 08:40',129.00),
(NULL,(SELECT id FROM airlines WHERE name='ANA'),(SELECT id FROM airports WHERE iata='KIX'),(SELECT id FROM airports WHERE iata='HND'),'2025-11-21 19:10','2025-11-21 20:30',119.00),

-- NRT -> BER (ANA, Lufthansa)
(NULL,(SELECT id FROM airlines WHERE name='ANA'),      (SELECT id FROM airports WHERE iata='NRT'),(SELECT id FROM airports WHERE iata='BER'),'2025-11-28 10:30','2025-11-28 18:20',679.00),
(NULL,(SELECT id FROM airlines WHERE name='Lufthansa'),(SELECT id FROM airports WHERE iata='NRT'),(SELECT id FROM airports WHERE iata='BER'),'2025-11-28 21:00','2025-11-29 06:50',729.00);
