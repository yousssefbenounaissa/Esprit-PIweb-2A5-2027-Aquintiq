-- Compte administrateur par défaut (à exécuter si la base existe déjà : phpMyAdmin > onglet SQL)
USE aquintiq;
INSERT INTO user (role_id, name, email, password_hash)
VALUES (3, 'Ahmed Hech', 'hechahmed5@gmail.com', '$2y$10$pEva5Xv7zkXsy7ZTGqr3ceYl9C38nE7ZKTIu0.GCwuVQLUZQYgRCi')
ON DUPLICATE KEY UPDATE role_id = 3, password_hash = VALUES(password_hash);
