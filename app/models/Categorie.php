<?php
class Categorie
{
    private $id = null;
    private $name = null;
   
    
    function __construct($name,$id = null)
    {
        $this->id = $id;
        $this->name = $name;
       
    }

    function getID()
    {
        return $this->id; 
    }

    function getName()
    {
        return $this->name;
    }

    function setName(string $name)
    {
        $this->name = $name;
    }

  
}
?>