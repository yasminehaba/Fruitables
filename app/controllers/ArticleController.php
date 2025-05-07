<?php

require_once __DIR__ . '/../config/Connexion.php';
require_once __DIR__ . '/../models/Categorie.php';
    class ArticleController {


        /////..............................Afficher............................../////
                // function AfficherArticle(){
                //     $sql="SELECT * FROM Article";
                //     $db = config::getConnexion();
                //     try{
                //         $liste = $db->query($sql);
                //         return $liste;
                //     }
                //     catch(Exception $e){
                //         die('Erreur:'. $e->getMessage());
                //     }
                // }
                function AfficherArticle(){
                    $sql="SELECT * FROM article";
                    $db = config::getConnexion();
                    try {
                        $liste = $db->query($sql);
                        return $liste->fetchAll(); // <-- très important
                    } catch(Exception $e){
                        die('Erreur:'. $e->getMessage());
                    }
                }
        
        /////..............................Supprimer............................../////
                function SupprimerArticle($idArticle){
                    $sql="DELETE FROM Article WHERE id=:idArticle";
                    $db = config::getConnexion();
                    $req=$db->prepare($sql);
                    $req->bindValue(':idArticle', $idArticle);   
                    try{
                        $req->execute();
                    }
                    catch(Exception $e){
                        die('Erreur:'. $e->getMessage());
                    }
                }
        
        /////..............................Ajouter............................../////
                function AjouterArticle($Article){
                    $sql="INSERT INTO Article (id ,idCat,nom,image ,description,prix,nbStock, status)
                    VALUES (:id ,:idCat,:nom,:image, :description, :prix , :nbStock, :status)";
                    
                    $db = config::getConnexion();
                    try{
                        $query = $db->prepare($sql);
                        $query->execute([
                            'id' => $Article->getId(),
                            'idCat' => $Article->getIdCat(),
                            'nom' => $Article->getNom(),
                            'image' => $Article->getImage(),
                            'description' =>$Article->getDescription(),
                            'prix' => $Article->getPrix(),
                            'nbStock' => $Article->getNbStock(),
                            'status' => $Article->getStatus(),




                    ]);
                                
                    }
                    catch (Exception $e){
                        echo 'Erreur: '.$e->getMessage();
                    }			
                }
        /////..............................Affichage par prix............................../////
                function RecupererArticle($prixA){
                    $sql="SELECT * from Article where prix=$prixA";
                    $db = config::getConnexion();
                    try{
                        $query=$db->prepare($sql);
                        $query->execute();
        
                        $Article=$query->fetch();
                        return $Article;
                    }
                    catch (Exception $e){
                        die('Erreur: '.$e->getMessage());
                    }
                }

               
        /////..............................Update............................../////
        function modifierArticle($Article, $id){
            try {
                $db = config::getConnexion();
                $query = $db->prepare('UPDATE Article SET  id = :id ,idCat=:idCat,nom=:nom,image=:image, description=:description, prix=:prix ,nbStock= :nbStock,status= :status WHERE id=:id');
                $query->execute([
                    'id' => $Article->getId(),
                    'idCat' => $Article->getIdCat(),
                    'nom' => $Article->getNom(),
                    'image' => $Article->getImage(),
                    'description' =>$Article->getDescription(),
                    'prix' => $Article->getPrix(),
                    'nbStock' => $Article->getNbStock(),
                    'status' => $Article->getStatus(),

                ]);
                echo $query->rowCount() . " records UPDATED successfully <br>";
            } catch (PDOException $e) {
                echo $e->getMessage(); // Afficher l'erreur PDO
            }
        }
            
/////////////////////////////getArticleById///////////////////////////////////////////////
public function getArticleById($id) {
    $sql = "SELECT * FROM Article WHERE id = :id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}
}
         