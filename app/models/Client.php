<?php
class Client {
    private $id = null;
    private $nomPrenom = null;
    private $adresse = null;
    private $tlf = null;
    private $email = null;
    private $pwd = null;
    
    public function __construct($nomPrenom, $email, $password, $adresse, $tlf, $id = null) {
        $this->id = $id;
        $this->nomPrenom = $nomPrenom;
        $this->email = $email;
        $this->pwd = password_hash($password, PASSWORD_DEFAULT);
        $this->adresse = $adresse;
        $this->tlf = $tlf;
    }

    // Getters
    public function getID() { return $this->id; }
    public function getNomPrenom() { return $this->nomPrenom; }
    public function getAdresse() { return $this->adresse; }
    public function getTlf() { return $this->tlf; }
    public function getEmail() { return $this->email; }
    public function getPwd() { return $this->pwd; }

    // Setters
    public function setNomPrenom($nomPrenom) { $this->nomPrenom = $nomPrenom; }
    public function setAdresse($adresse) { $this->adresse = $adresse; }
    public function setTlf($tlf) { $this->tlf = $tlf; }
    public function setEmail($email) { 
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }
    public function setPwd($password) { 
        $this->pwd = password_hash($password, PASSWORD_DEFAULT); 
    }
}
?>