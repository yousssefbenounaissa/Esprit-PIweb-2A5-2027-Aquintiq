AQUINTIQ – Smart Agriculture Platform
Overview
This project was developed as part of the PIWeb – 2nd Year Engineering Program at Esprit School of Engineering (Academic Year 2026–2027).

AQUINTIQ is a web platform for smart, sustainable and resource-efficient agriculture. It combines smart irrigation, solar energy, the Internet of Things (IoT) and an AI assistant in a single application designed for small farmers.

Problem solved: existing solutions (FarmLogs, Rain Bird, Huawei FusionSolar) each cover only one domain. AQUINTIQ brings plots, irrigation and energy together, with low-cost sensors and hardware.

Key innovation: irrigation decisions that take soil moisture, available energy and weather conditions into account at the same time.

Features
Front Office (farmers)
Dashboard: soil moisture, temperature, water level and consumption
Plot and farming zone tracking
Smart irrigation control and scheduling
Soil quality monitoring (pH and salinity)
AI assistant with personalized recommendations
Real-time alerts and notifications (low battery, soil too dry, failure)
Back Office (administrators)
User and role management
Farm and plot management
Sensor and IoT device configuration
Crop and irrigation parameter management
Water and energy consumption statistics
Device, alert and AI recommendation monitoring
Tech Stack
Frontend
HTML5, CSS3, JavaScript
Bootstrap
Chart.js
Templates: eLEARNING (Front Office), TailAdmin / PlainAdmin (Back Office) 
Backend
PHP (MVC architecture)
MySQL
ESP32 (sensors and IoT)
Architecture
The project follows the MVC pattern, with reusable partials (includes/ for the Front Office, partials/ + layout.php for the Back Office).

Esprit-PIweb-2A5-2027-Aquintiq/
├── Controllers/        # Receive requests, call models, choose views
├── Models/             # Data classes
├── Views/
│   ├── assets/         # css, img, js, lib
│   ├── includes/       # head, spinner, navbar, footer, scripts (Front Office)
│   └── pages/          # index, about, courses, ...
├── app/                # Back Office (Controllers, Models, Views/partials, layout.php)
├── config.php
└── index.php

Contributors
Youssef Ben Ounaissa – Esprit School of Engineering
Academic Context
Developed at Esprit School of Engineering – Tunisia

PIWeb – 2A5 | 2026–2027

The project also contributes to the UN Sustainable Development Goals: SDG 2, 4, 6, 7, 12, 13 and 17.

Getting Started
Prerequisites
PHP 8+
MySQL
XAMPP / WAMP (optional)
Git
Installation
Clone the repository:
bash
git clone https://github.com/yousssefbenounaissa/Esprit-PIweb-2A5-2027-Aquintiq.git
cd Esprit-PIweb-2A5-2027-Aquintiq
Configure the database: create a MySQL database and update the credentials in config.php.
Run the project:
With XAMPP / WAMP: place the folder in htdocs (XAMPP) or www (WAMP), then open http://localhost/Esprit-PIweb-2A5-2027-Aquintiq/index.php
With the PHP built-in server:
bash
php -S localhost:8000
then open http://localhost:8000/index.php

Acknowledgments
Esprit School of Engineering and our PIWeb supervisors for their guidance
Free templates used for the interface integration (eLEARNING, TailAdmin / PlainAdmin)
The open-source community behind PHP, Bootstrap and Chart.js

Claude a terminé sa réponse.
