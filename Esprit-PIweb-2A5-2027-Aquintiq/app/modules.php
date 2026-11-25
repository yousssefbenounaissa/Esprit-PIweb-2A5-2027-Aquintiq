<?php
/**
 * Modules du projet (1 module = 2 entités jointes par clé étrangère).
 * 'front' => visible dans le Front Office ; l'équipe remplace ensuite chaque module par son vrai CRUD.
 */
return [
  'users' => ['label'=>'Utilisateurs','icon'=>'users','front'=>false,'desc'=>'Les comptes, leurs rôles et leurs droits d\'accès.',
    'entities'=>[
      ['Rôle',['id','nom','description'],[[1,'Administrateur','Gère toute la plateforme'],[2,'Agriculteur','Gère ses fermes et ses ventes'],[3,'Technicien','Suit les fermes qui lui sont affectées']]],
      ['Utilisateur',['id','nom','email','rôle','statut'],[[1,'Ahmed Hech','ahmed@mail.tn','Administrateur','Actif'],[2,'Salma Trabelsi','salma@mail.tn','Agriculteur','Actif'],[3,'Karim Jlassi','karim@mail.tn','Technicien','Actif']]]]],
  'farms' => ['label'=>'Fermes & Parcelles','icon'=>'farm','front'=>true,'desc'=>'Vos fermes et leurs parcelles : surface, type de sol, culture en place.',
    'entities'=>[
      ['Ferme',['id','nom','localisation','superficie_ha','propriétaire'],[[1,'Ferme Ben Salah','Kairouan',12.5,'Salma Trabelsi'],[2,'Domaine El Medina','Sidi Bouzid',8.0,'Salma Trabelsi']]],
      ['Parcelle',['id','nom','surface_m2','type_sol','ferme'],[[1,'Parcelle A',2400,'Argileux','Ferme Ben Salah'],[2,'Parcelle B',1800,'Sableux','Ferme Ben Salah'],[3,'Parcelle C',3100,'Limoneux','Domaine El Medina']]]]],
  'irrigation' => ['label'=>'Irrigation','icon'=>'drop','front'=>true,'desc'=>'Les pompes solaires et l\'historique de chaque arrosage.',
    'entities'=>[
      ['Pompe',['id','nom','puissance_W','mode','statut','parcelle'],[[1,'Pompe solaire 1',120,'Auto','Active','Parcelle A'],[2,'Pompe solaire 2',90,'Manuel','Arrêtée','Parcelle B']]],
      ['Événement d\'irrigation',['id','mode','début','durée_min','volume_L','pompe'],[[1,'Auto','06:30',25,180,'Pompe solaire 1'],[2,'Manuel','18:10',15,95,'Pompe solaire 2']]]]],
  'marketplace' => ['label'=>'Marketplace','icon'=>'shop','front'=>true,'desc'=>'Vendre ses récoltes et acheter local : tomates, huile d\'olive, dattes.',
    'entities'=>[
      ['Produit',['id','nom','prix','stock','statut','ferme'],[[1,'Tomates bio','2.5 DT/kg',120,'Publié','Ferme Ben Salah'],[2,'Huile d\'olive','28 DT/L',40,'Publié','Domaine El Medina'],[3,'Dattes Deglet Nour','18 DT/kg',60,'Publié','Domaine El Medina']]],
      ['Commande',['id','produit','quantité','total','statut'],[[1,'Tomates bio',10,'25 DT','Confirmée'],[2,'Huile d\'olive',2,'56 DT','En attente']]]]],
  'planting' => ['label'=>'Plans de plantation','icon'=>'calendar','front'=>true,'desc'=>'Quoi planter, sur quelle parcelle et à quelle date, avec les tâches à faire.',
    'entities'=>[
      ['Plan de plantation',['id','parcelle','culture','date_prévue','statut'],[[1,'Parcelle A','Tomate','2026-12-05','Planifié'],[2,'Parcelle C','Olivier','2027-01-15','Brouillon']]],
      ['Tâche',['id','plan','titre','échéance','terminée'],[[1,'Tomate','Préparer le sol','2026-11-30','Oui'],[2,'Tomate','Installer le goutte-à-goutte','2026-12-03','Non']]]]],
  'training' => ['label'=>'Formations','icon'=>'book','front'=>true,'desc'=>'Des cours courts pour les jeunes agriculteurs : cultures, calendrier, irrigation.',
    'entities'=>[
      ['Cours',['id','titre','niveau','durée_h','statut'],[[1,'Bases de l\'irrigation goutte-à-goutte','Débutant',3,'Publié'],[2,'Calendrier de plantation','Débutant',2,'Publié']]],
      ['Inscription',['id','cours','utilisateur','progression','terminé'],[[1,'Calendrier de plantation','Salma Trabelsi','60 %','Non'],[2,'Bases de l\'irrigation','Salma Trabelsi','100 %','Oui']]]]],
  'equipment' => ['label'=>'Partage d\'équipements','icon'=>'tool','front'=>true,'desc'=>'Prêter ou louer du matériel entre agriculteurs de la région.',
    'entities'=>[
      ['Équipement',['id','nom','type','prix_jour','statut'],[[1,'Tracteur Massey','Tracteur','80 DT','Disponible'],[2,'Pulvérisateur 200 L','Traitement','15 DT','Réservé']]],
      ['Réservation',['id','équipement','du','au','statut'],[[1,'Pulvérisateur 200 L','2026-12-01','2026-12-02','Confirmée']]]]],
];
