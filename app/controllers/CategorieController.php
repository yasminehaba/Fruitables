<?php
require_once __DIR__ . '/../config/Connexion.php';
require_once __DIR__ . '/../models/Categorie.php';

class CategorieController
{
    /////..............................Afficher............................../////
    function AfficherCategorie()
    {
        $sql = "SELECT * FROM categorie";
        $db = Config::getConnexion();  // Changed from config to Config
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll();  // Added fetchAll() to get all results
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    /////..............................Supprimer............................../////
    function SupprimerCategorie($id)
    {
        $sql = "DELETE FROM categorie WHERE id=:id";
        $db = Config::getConnexion();  // Changed from config to Config
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            return $req->execute();  // Return execution result
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    /////..............................Ajouter............................../////
    function AjouterCategorie($categorie)
    {
        $sql = "INSERT INTO categorie (name) VALUES (:name)";
        $db = Config::getConnexion();  // Changed from config to Config
        try {
            $query = $db->prepare($sql);
            return $query->execute([
                'name' => $categorie->getName()
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    /////..............................Affichage par la cle Primaire............................../////
    function RecupererCategorie($id)
    {
        $sql = "SELECT * from categorie where id=:id";  // Fixed SQL injection vulnerability
        $db = Config::getConnexion();  // Changed from config to Config
        try {
            $query = $db->prepare($sql);
            $query->execute([':id' => $id]);
            return $query->fetch();  // Fixed variable name from $offre to return
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    /////..............................Update............................../////
    function modifierCat($categorie, $id)
    {
        try {
            $db = Config::getConnexion();  // Changed from config to Config
            $query = $db->prepare('UPDATE categorie SET name = :name WHERE id = :id');  // Removed comma after :name
            return $query->execute([
                'name' => $categorie->getName(),
                'id' => $id,
            ]);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    /////..............................recherche par nom ............................../////
    function Recherche($name)
    {
        $sql = "SELECT * from categorie where name like :name";
        $db = Config::getConnexion();  // Changed from config to Config
        try {
            $query = $db->prepare($sql);
            $query->execute([':name' => $name . '%']);
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}
/////////////////////////////////get nom par id ///////////////////////////////
public function getNomCategorieParId($idCat) {
    require_once __DIR__ . '/../config/database.php'; // Connexion DB
    $sql = "SELECT name FROM categorie WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idCat]);
    $categorie = $stmt->fetch(PDO::FETCH_ASSOC);
    return $categorie ? $categorie['name'] : 'Catégorie inconnue';
}