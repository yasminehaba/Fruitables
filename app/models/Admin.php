<?php
class Admin
{
    private $id = null;
    private $username = null;
    private $email = null;
    private $pwd = null;
    
    function __construct($username, $email, $pwd, $id = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT); // Hashage du mot de passe
    }

    function getID()
    {
        return $this->id; 
    }

    function getUsername()
    {
        return $this->username;
    }

    function setUsername(string $username)
    {
        $this->username = $username;
    }

    function getEmail()
    {
        return $this->email;
    }

    function setEmail(string $email)
    {
        $this->email = $email;
    }

    function getPwd()
    {
        return $this->pwd;
    }

    function setPwd(string $pwd)
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }
}
?>