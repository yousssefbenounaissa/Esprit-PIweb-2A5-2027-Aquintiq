# AQUINTIQ – Smart Agriculture Platform

## Overview
This project was developed as part of the **[PI] – [Nth] Year Engineering Program** at **Esprit School of Engineering** (Academic Year 2026–2027).
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
app/Views/front   -> layout.php + includes/ (head, spinner, navbar, footer, scripts) + pages/
app/Views/back    -> layout.php + partials/ (head, sidebar, header, footer, scripts) + pages/
app/routes.php    -> page key => [Controller, method]
app/Views/assets     -> css, js, img, lib
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
[PI] – [2A5] | 2026–2027

## Getting Started
```bash
git clone https://github.com/<owner>/Esprit-[PI]-[Classe]-2026-AQUINTIQ.git
cd Esprit-[PI]-[Classe]-2026-AQUINTIQ
php -S localhost:8000
# Front Office: http://localhost:8000/index.php?page=home
# Back Office : http://localhost:8000/index.php?page=admin-dashboard
```
Or copy the folder into `htdocs` (XAMPP) / `www` (WAMP). Configure the database in `config.php`.

## Acknowledgments
Thanks to the Esprit School of Engineering teaching staff for their guidance.
