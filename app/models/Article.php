<?php
class Article
{
    private $id;
    private $idCat;
    private $nom;
    private $image;
    private $description;
    private $prix;
    private $nbStock;
    private $status;
    
    public function __construct(
        $id = null,
        $idCat = null,
        $nom = null,
        $image = null,
        $description = null,
        $prix = null,
        $nbStock = null,
        $status = null
    ) {
        $this->id = $id;
        $this->idCat = $idCat;
        $this->nom = $nom;
        $this->image = $image;
        $this->description = $description;
        $this->prix = $prix;
        $this->nbStock = $nbStock;
        $this->status = $status;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getIdCat() {
        return $this->idCat;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getNbStock() {
        return $this->nbStock;
    }

    public function getStatus() {
        return $this->status;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setIdCat($idCat) {
        $this->idCat = $idCat;
        return $this;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
        return $this;
    }

    public function setNbStock($nbStock) {
        $this->nbStock = $nbStock;
        return $this;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }
}
?>