<?php
class Ordr
{
    private $id = null;
 
    private $date = null;
    private $status = null;
    private $id_Client = null;
    private $id_Cart = null;
   
    
    function __construct($id = null, $id_Client,$id_Cart,$date,$status)
    {
        $this->id = $id;
        $this->id_Client = $id_Client;
        $this->id_Cart = $id_Cart;
        $this->date = $date;
        $this->status = $status;
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
    function getID_Cart()
    {
        return $this->id_Cart;
    }

    function setID_Cart(int $id_Cart)
    {
        $this->id_Cart = $id_Cart;
    }
    function getDate()
    {
        return $this->date;
    }

    function setDate(Date $date)
    {
        $this->date = $date;
    } function getStatus()
    {
        return $this->status;
    }

    function setStatus(int $status)
    {
        $this->status = $status;
    }

  
}
?>