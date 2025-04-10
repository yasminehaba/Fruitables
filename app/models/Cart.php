<?php
class Cart
{
    private $id = null;
    private $id_Client = null;
    private $id_Article = null;
    private $qte = null;
    private $ttPrix = null;
   
    
    function __construct($id = null, $id_Client,$id_Article,$qte,$ttPrix)
    {
        $this->id = $id;
        $this->id_Client = $id_Client;
        $this->id_Article = $id_Article;
        $this->qte = $qte;
        $this->ttPrix = $ttPrix;
    }

    function getID()
    {
        return $this->id; 
    }

    function getID_Client()
    {
        return $this->id_Client;
    }

    function setID_Client(int $id_Client)
    {
        $this->id_Client = $id_Client;
    }
    function getID_Article()
    {
        return $this->id_Article;
    }

    function setID_Article(int $id_Article)
    {
        $this->id_Article = $id_Article;
    }
    function getQte()
    {
        return $this->qte;
    }

    function setQte(int $qte)
    {
        $this->qte = $qte;
    } function getTtPrix()
    {
        return $this->ttPrix;
    }

    function setTtPrix(int $ttPrix)
    {
        $this->ttPrix = $ttPrix;
    }

  
}
?>