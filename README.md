# ✈️ Flight Booking System  

A full-stack **PHP + MySQL** web application that **simulates** a functional airline booking system.  
Built as a school project to demonstrate **database design, backend logic, and dynamic UI rendering** using pure PHP without external frameworks.  

The system allows users to **search flights**, view real-time database results, and simulate **flight bookings** with a clean, responsive interface.  
Every component—from database tables to visual layout—was implemented manually for learning purposes.

---

## 🎯 Project Goals  

- Design a normalized relational database with proper 1:N connections  
- Build a fully functional PHP backend using **PDO** and prepared statements  
- Create a front-end that feels modern, minimal, and easy to use  
- Apply clean separation between logic, presentation, and database  

---

## ⚙️ Core Features  

✅ **User System** – account creation and login (planned)  
✅ **Flight Search** – by airport code or country name  
✅ **Live Results** – dynamically fetched and displayed in styled tables  
✅ **Booking Simulation** – each flight has a “Book” button linking to a detail page  
✅ **SQL Security** – all queries use prepared statements  
✅ **Responsive Styling** – clean layout and mobile-friendly elements  

---

## 🧩 Database Overview  

| Table | Description |
|:------|:-------------|
| `users` | Stores account information |
| `flights` | Flight data (origin, destination, airline, times, price) |
| `airlines` | Airline directory |
| `airports` | Airport data linked to countries |
| `countries` | Country names for search functionality |

## 🎨 UI & Design Choices  

The design focuses on simplicity and clarity:  
- Orange-to-coral gradient buttons (`linear-gradient(90deg, #ff914d, #f57b51)`)  
- Soft background tones (`#fffaf6`, `#fff3ea`)  
- Rounded edges, shadows, and hover transitions for modern feel  
- Consistent typography for readability  

All styling is defined in `/assets/styles.css`.

---

## 🧱 Tech Stack  

| Layer | Technology |
|:------|:------------|
| Backend | PHP 8+ |
| Database | MySQL |
| Frontend | HTML5, CSS3 |
| Environment | XAMPP / phpMyAdmin |

---
