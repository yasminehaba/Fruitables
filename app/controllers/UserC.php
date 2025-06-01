<?php
require_once __DIR__ . '/../config/Connexion.php';
require_once __DIR__ . '/../models/User.php';

class UserC {
public function AjouterUser($user) {
        $db = Config::getConnexion();
        try {
            $sql = "INSERT INTO user (username, email, pwd, adresse, tlf, role)
                    VALUES (:username, :email, :pwd, :adresse, :tlf, :role)";
            
            $query = $db->prepare($sql);
            $success = $query->execute([
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'pwd' => $user->getPwd(), 
                'adresse' => $user->getAdresse(),
                'tlf' => $user->getTlf(),
                'role' => $user->getRole()
            ]);
            
            if (!$success) {
                error_log("Insert failed: " . print_r($query->errorInfo(), true));
            }
            
            return $success;
        } catch (PDOException $e) {
            error_log("Erreur AjouterUser : " . $e->getMessage());
            return false;
        }
    }




public function RecupererUserByEmail($email) {  // Make sure it's exactly this capitalization
    $sql = "SELECT * FROM user WHERE email = :email LIMIT 1";
    $db = Config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute(['email' => filter_var($email, FILTER_SANITIZE_EMAIL)]);
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Error RecupererUserByEmail: '.$e->getMessage());
        return false;
    }
}
}