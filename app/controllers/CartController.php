<?php

require_once __DIR__ . '/../config/Connexion.php';
require_once __DIR__ . '/../models/Cart.php';

class CartController
{
    // Afficher tous les paniers
    function AfficherCart()
    {
        $sql = "SELECT * FROM Cart";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Ajouter un panier
    function AjouterCart($cart)
    {
        $sql = "INSERT INTO Cart (id_Client, id_Article, qte, ttPrix)
                VALUES (:id_Client, :id_Article, :qte, :ttPrix)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_Client' => $cart->getID_Client(),
                'id_Article' => $cart->getID_Article(),
                'qte' => $cart->getQte(),
                'ttPrix' => $cart->getTtPrix(),
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    // Supprimer un panier par son ID
    function SupprimerCart($id)
    {
        $sql = "DELETE FROM Cart WHERE id = :id";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Modifier un panier
    function ModifierCart($cart, $id)
    {
        $sql = "UPDATE Cart SET id_Client = :id_Client, id_Article = :id_Article, qte = :qte, ttPrix = :ttPrix 
                WHERE id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'id_Client' => $cart->getID_Client(),
                'id_Article' => $cart->getID_Article(),
                'qte' => $cart->getQte(),
                'ttPrix' => $cart->getTtPrix(),
            ]);
            echo $query->rowCount() . " enregistrement(s) mis à jour avec succès<br>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Récupérer un panier spécifique
    function RecupererCart($id)
    {
        $sql = "SELECT * FROM Cart WHERE id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            $cart = $query->fetch();
            return $cart;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>
