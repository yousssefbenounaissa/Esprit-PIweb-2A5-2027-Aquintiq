# AQUINTIQ – Smart Agriculture Platform

## Overview
This project was developed as part of the **Projet Intégré Web (PIWeb) – 2A5 Engineering Program** at **Esprit School of Engineering** (Academic Year 2026–2027).
AQUINTIQ is a web platform linked to a solar-powered smart irrigation prototype (ESP32, soil-moisture sensor, pump, battery, solar panel). It helps small farmers manage plots, irrigation, crops, training and a marketplace with a more sustainable use of water and energy.

## Features
- Front Office: dashboard, plots and farms, irrigation, marketplace, training courses, equipment sharing
- Back Office: users and roles, farms and plots, IoT devices, crops, irrigation settings, statistics
- Role-based access (farmer, technician, administrator)

## Tech Stack
### Frontend
- HTML5, CSS3 (feuilles de style maison, couleurs tirées du logo), JavaScript, icônes et graphiques en SVG intégrés (aucune bibliothèque externe)
### Backend
- PHP 8 (MVC architecture), MySQL (PDO)

## Architecture
```
app/Controllers   -> receive requests, call the models, choose the view
app/Models        -> data access (PDO)
FrontOffice   -> layout.php + includes/ (head, spinner, navbar, footer, scripts) + pages/
BackOffice    -> layout.php + partials/ (head, sidebar, header, footer, scripts) + pages/
app/routes.php    -> page key => [Controller, method]
assets     -> css, js, img, lib
```

## Contributors
- Ahmed Hech
- Ahmed Kbaier
- Youssef Ben Ounaissa
- Hedi Aoun
- Aziz Zayeni
- Mohamed Taher Aziz Barbar

## Academic Context
Developed at **Esprit School of Engineering – Tunisia**
PIWeb 2A5 | 2026–2027

## Security
- Sessions: `session_regenerate_id(true)` at login, `use_strict_mode`, HttpOnly + SameSite cookies, 30-minute inactivity expiry, logout by POST + CSRF token (PHPSESSID cookie deleted)
- Access control: the whole Back Office requires a logged-in **Administrateur** (not logged in → redirect to login, wrong role → HTTP 403)
- CSRF token on every POST form, `htmlspecialchars` on every output, PDO prepared statements (`ATTR_EMULATE_PREPARES = false`), `password_hash` / `password_verify`
- HTTP headers: `X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy`, `Content-Security-Policy`
- Validation on all forms: JavaScript (`assets/js/validate.js`, `login.js`) **and** PHP (server side, always authoritative)

## Getting Started
### With XAMPP (Windows)
1. Install [XAMPP](https://www.apachefriends.org/) and start **Apache** and **MySQL** from the control panel.
2. Clone the repository into `C:\xampp\htdocs\`:
```bash
git clone https://github.com/yousssefbenounaissa/Esprit-PIweb-2A5-2027-Aquintiq.git
cd Esprit-PIweb-2A5-2027-Aquintiq
```
3. Open `http://localhost/phpmyadmin`, go to **Import** and import `database/schema.sql` (creates the `aquintiq` database, the tables and the 3 roles).
4. Check `config.php` (defaults for XAMPP: host `localhost`, db `aquintiq`, user `root`, empty password).
5. Open the site:
   - Front Office: `http://localhost/Esprit-PIweb-2A5-2027-Aquintiq/index.php?page=home`
   - Login / sign up: `http://localhost/Esprit-PIweb-2A5-2027-Aquintiq/index.php?page=login`
   - Back Office (administrators only): `http://localhost/Esprit-PIweb-2A5-2027-Aquintiq/index.php?page=admin-dashboard`

### Administrator account
`database/schema.sql` creates a default administrator (Ahmed Hech, `hechahmed5@gmail.com`; the password is stored hashed). If the database already exists, run `database/seed_admin.sql` in phpMyAdmin.

Other administrators: new sign-ups are always **Agriculteur**. Sign up once, then in phpMyAdmin open table `user` and set that account's `role_id` to `3` (Administrateur). From then on, admins manage users and roles in **Back Office → Utilisateurs**.

### Without XAMPP (PHP built-in server)
```bash
php -S localhost:8000
# http://localhost:8000/index.php?page=home
```
(MySQL must still be running with `database/schema.sql` imported.)

## Acknowledgments
Thanks to the Esprit School of Engineering teaching staff for their guidance.
