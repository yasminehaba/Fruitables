<?php
require_once __DIR__ . '/../config/Connexion.php';
require_once __DIR__ . '/../models/Client.php';

class ClientController {
     function AjouterUser($client) {
        $sql = "INSERT INTO client (nomPrenom, adresse, tlf, email, pwd) 
                VALUES (:nomPrenom, :adresse, :tlf, :email, :pwd)";
        
        $db = Connexion::getConnexion();
        try {
            $query = $db->prepare($sql);
            return $query->execute([
                'nomPrenom' => htmlspecialchars($client->getNomPrenom()),
                'adresse' => htmlspecialchars($client->getAdresse()),
                'tlf' => htmlspecialchars($client->getTlf()),
                'email' => filter_var($client->getEmail(), FILTER_SANITIZE_EMAIL),
                'pwd' => $client->getPwd()
            ]);
        } catch (PDOException $e) {
            error_log('Erreur AjouterUser: '.$e->getMessage());
            return false;
        }			
    }

function RecupererUserByEmail($email) {
        $sql = "SELECT * FROM client WHERE email = :email LIMIT 1";
        $db = Connexion::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['email' => filter_var($email, FILTER_SANITIZE_EMAIL)]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erreur RecupererUserByEmail: '.$e->getMessage());
            return false;
        }
    }
}