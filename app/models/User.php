<?php
class User {
    private $idUser = null;
    private $username = null;
    private $email = null;
    private $tlf = null;
    private $adresse = null;
    private $pwd = null;
    private $role=null;
    
    public function __construct($username, $email, $password, $adresse, $tlf, $role) {
    $this->username = $username;
    $this->email = $email;
    $this->pwd = $this->hashPassword($password); // Use dedicated method
    $this->adresse = $adresse;
    $this->tlf = $tlf;
    $this->role = $role;
}

    // Getters
    public function getID() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getAdresse() { return $this->adresse; }
    public function getTlf() { return $this->tlf; }
    public function getEmail() { return $this->email; }
    public function getPwd() { return $this->pwd; }
    public function getRole() { return $this->role; }

    // Setters
    public function setUsername($username) { $this->username = $username; }
    public function setAdresse($adresse) { $this->adresse = $adresse; }
    public function setTlf($tlf) { $this->tlf = $tlf; }
    public function setEmail($email) { 
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }
    private function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}
    public function setPwd($password) {
    $this->pwd = $this->hashPassword($password);
}
    public function setRole($role) { $this->role = $role; }
}
?>