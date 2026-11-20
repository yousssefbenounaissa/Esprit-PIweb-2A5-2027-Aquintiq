-- AQUINTIQ – schéma MySQL (aligné sur le diagramme de classes). Import : phpMyAdmin > Importer
CREATE DATABASE IF NOT EXISTS aquintiq CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE aquintiq;

CREATE TABLE role (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30) NOT NULL UNIQUE) ENGINE=InnoDB;
INSERT INTO role (name) VALUES ('Agriculteur'),('Technicien'),('Administrateur');

CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY, role_id INT NOT NULL, name VARCHAR(80) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE, password_hash VARCHAR(255) NOT NULL, phone VARCHAR(20),
  FOREIGN KEY (role_id) REFERENCES role(id)
) ENGINE=InnoDB;

-- Module Fermes
CREATE TABLE farm (
  id INT AUTO_INCREMENT PRIMARY KEY, owner_id INT NOT NULL, technician_id INT NULL,
  name VARCHAR(80) NOT NULL, region VARCHAR(60), area_ha DECIMAL(8,2),
  FOREIGN KEY (owner_id) REFERENCES user(id), FOREIGN KEY (technician_id) REFERENCES user(id) ON DELETE SET NULL
) ENGINE=InnoDB;
CREATE TABLE crop (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(60) NOT NULL, water_need_mm INT) ENGINE=InnoDB;
CREATE TABLE plot (
  id INT AUTO_INCREMENT PRIMARY KEY, farm_id INT NOT NULL, crop_id INT NULL, label VARCHAR(40) NOT NULL,
  area_ha DECIMAL(8,2), soil_moisture TINYINT UNSIGNED,
  FOREIGN KEY (farm_id) REFERENCES farm(id) ON DELETE CASCADE, FOREIGN KEY (crop_id) REFERENCES crop(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Module Irrigation
CREATE TABLE pump (
  id INT AUTO_INCREMENT PRIMARY KEY, farm_id INT NOT NULL, model VARCHAR(60), power_w INT,
  mode ENUM('Auto','Manuel') DEFAULT 'Auto', status ENUM('Actif','Inactif') DEFAULT 'Actif',
  FOREIGN KEY (farm_id) REFERENCES farm(id) ON DELETE CASCADE
) ENGINE=InnoDB;
CREATE TABLE irrigation_event (
  id INT AUTO_INCREMENT PRIMARY KEY, pump_id INT NOT NULL, plot_id INT NULL, started_at DATETIME NOT NULL,
  duration_min INT, volume_l INT, trigger_type ENUM('Auto','Manuel') DEFAULT 'Auto',
  FOREIGN KEY (pump_id) REFERENCES pump(id) ON DELETE CASCADE, FOREIGN KEY (plot_id) REFERENCES plot(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Module Marketplace
CREATE TABLE product (
  id INT AUTO_INCREMENT PRIMARY KEY, seller_id INT NOT NULL, name VARCHAR(80) NOT NULL,
  price_dt DECIMAL(8,3) NOT NULL, stock INT DEFAULT 0, status ENUM('Publié','Brouillon') DEFAULT 'Publié',
  FOREIGN KEY (seller_id) REFERENCES user(id)
) ENGINE=InnoDB;
CREATE TABLE shop_order (
  id INT AUTO_INCREMENT PRIMARY KEY, product_id INT NOT NULL, buyer_id INT NOT NULL, quantity INT NOT NULL DEFAULT 1,
  status ENUM('En attente','Confirmée','Livrée','Annulée') DEFAULT 'En attente', ordered_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (product_id) REFERENCES product(id), FOREIGN KEY (buyer_id) REFERENCES user(id)
) ENGINE=InnoDB;

-- Module Plantation
CREATE TABLE planting_plan (
  id INT AUTO_INCREMENT PRIMARY KEY, farm_id INT NOT NULL, crop_id INT NOT NULL, season VARCHAR(30),
  start_date DATE, end_date DATE,
  FOREIGN KEY (farm_id) REFERENCES farm(id) ON DELETE CASCADE, FOREIGN KEY (crop_id) REFERENCES crop(id)
) ENGINE=InnoDB;
CREATE TABLE plan_task (
  id INT AUTO_INCREMENT PRIMARY KEY, plan_id INT NOT NULL, title VARCHAR(120) NOT NULL, due_date DATE, done TINYINT(1) DEFAULT 0,
  FOREIGN KEY (plan_id) REFERENCES planting_plan(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Module Formation
CREATE TABLE course (
  id INT AUTO_INCREMENT PRIMARY KEY, trainer_id INT NOT NULL, title VARCHAR(120) NOT NULL,
  level ENUM('Débutant','Intermédiaire','Avancé') DEFAULT 'Débutant', duration_h INT,
  FOREIGN KEY (trainer_id) REFERENCES user(id)
) ENGINE=InnoDB;
CREATE TABLE enrollment (
  id INT AUTO_INCREMENT PRIMARY KEY, course_id INT NOT NULL, user_id INT NOT NULL,
  status VARCHAR(20) DEFAULT 'Inscrit', enrolled_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  UNIQUE (course_id, user_id),
  FOREIGN KEY (course_id) REFERENCES course(id) ON DELETE CASCADE, FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Module Équipement
CREATE TABLE equipment (
  id INT AUTO_INCREMENT PRIMARY KEY, owner_id INT NOT NULL, name VARCHAR(80) NOT NULL, type VARCHAR(40),
  daily_rate_dt DECIMAL(8,3), status ENUM('Disponible','Loué','Maintenance') DEFAULT 'Disponible',
  FOREIGN KEY (owner_id) REFERENCES user(id)
) ENGINE=InnoDB;
CREATE TABLE booking (
  id INT AUTO_INCREMENT PRIMARY KEY, equipment_id INT NOT NULL, renter_id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL,
  status ENUM('En attente','Confirmée','Terminée','Annulée') DEFAULT 'En attente',
  FOREIGN KEY (equipment_id) REFERENCES equipment(id) ON DELETE CASCADE, FOREIGN KEY (renter_id) REFERENCES user(id)
) ENGINE=InnoDB;

-- Formulaire de contact (Front Office)
CREATE TABLE contact_message (
  id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(80), email VARCHAR(120), subject VARCHAR(120), message TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
