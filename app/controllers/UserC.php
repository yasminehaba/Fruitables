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
public function loginUser($username, $password) {
    $db = Config::getConnexion();
    try {
        $sql = "SELECT * FROM user WHERE username = :username OR email = :email LIMIT 1";
        $query = $db->prepare($sql);
        $query->execute([
            'username' => $username,
            'email' => $username
        ]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            error_log("User not found: " . $username);
            return false;
        }

        // Debug output
        error_log("Stored hash: " . $user['pwd']);
        error_log("Input password: " . $password);
        error_log("Verification result: " . password_verify($password, $user['pwd']));

        if (password_verify($password, $user['pwd'])) {
            unset($user['pwd']);
            return $user;
        }
        
        return false;
    } catch (PDOException $e) {
        error_log('Login error: '.$e->getMessage());
        return false;
    }
}
public function RecupererUserByUsername($username) {
    $sql = "SELECT * FROM user WHERE username = :username LIMIT 1";
    $db = Config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute(['username' => $username]);
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Error RecupererUserByUsername: '.$e->getMessage());
        return false;
    }
}
}