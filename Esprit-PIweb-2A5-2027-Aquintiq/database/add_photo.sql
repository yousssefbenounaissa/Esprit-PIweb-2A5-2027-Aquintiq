-- À exécuter UNE SEULE FOIS dans phpMyAdmin (base aquintiq) si vous aviez déjà importé schema.sql
ALTER TABLE user ADD COLUMN photo VARCHAR(255) NULL AFTER phone;
