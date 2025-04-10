<?php
require_once __DIR__ . '/../config/Connexion.php';
require_once __DIR__ . '/../models/User.php';

class UserC {
    public function AjouterUser($user) {
        $sql = "INSERT INTO user (username, email, pwd, adresse, tlf, role) 
        VALUES (:username, :email, :pwd, :adresse, :tlf, :role)";
        
        $db = Connexion::getConnexion();
        try {
            $query = $db->prepare($sql);
            return $query->execute([
                'username' => htmlspecialchars($user->getUsername()),
                'adresse' => htmlspecialchars($user->getAdresse()),
                'tlf' => htmlspecialchars($user->getTlf()),
                'email' => filter_var($user->getEmail(), FILTER_SANITIZE_EMAIL),
                'pwd' => $user->getPwd(),
                'role'=> $user->getRole()
            ]);
        } catch (PDOException $e) {
            error_log('Erreur AjouterUser: '.$e->getMessage());
            return false;
        }			
    }

    public function RecupererUserByEmail($email) {
        $sql = "SELECT * FROM user WHERE email = :email LIMIT 1";
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