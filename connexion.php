<?php
class Connexion
{
    private $connexion;
    public function __construct()
    {
        $PARAM_hote = 'localhost';
        $PARAM_port = '3306';
        $PARAM_nom_bd = 'minifacebook';
        $PARAM_utilisateur = 'adminMiniFacebook';
        // mot de passe de l'utilisateur pour se connecter
        $PARAM_mot_passe = 'miniFacebook';

        try {
            $this->connexion = new PDO(
                'mysql:host=' . $PARAM_hote . ';dbname=' . $PARAM_nom_bd,
                $PARAM_utilisateur,
                $PARAM_mot_passe
            );
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
        }
    }

    public function getConnexion()
    {
        return $this->connexion;
    }

    function insertHobby(string $hobby)
    {
        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO Hobby (Type) values (:hobby)"
        );
        $requete_prepare->execute(
            array('hobby' => $hobby)
        );

    }

    function insertMusique(string $style)
    {
        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO Musique (Type) values (:musique)"
        );
        $requete_prepare->execute(
            array('musique' => $style)
        );
    }

    function insertHobby2(string $hobby)
    {

        try {
            $requete_prepare = $this->connexion->prepare(
                "INSERT INTO Hobby (Type) values (:hobby)"
            );
            $requete_prepare->execute(
                array('hobby' => $hobby)
            );
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function insertPersonne($nom, $prenom, $url_photo, $date_naissance, $statut_couple)
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                "INSERT INTO Personne (Nom, Prenom, URL_Photo, Date_Naissance, Statut_couple) 
                           values (:Nom, :Prenom, :URL_Photo, :Date_Naissance, :Statut_couple)"
            );
            $requete_prepare->execute(
                array('Nom' => $nom, 'Prenom' => $prenom, 'URL_Photo' => $url_photo, 'Date_Naissance' => $date_naissance, 'Statut_couple' => $statut_couple)
            );
            return $this->connexion->lastInsertId();
        } catch (Exception $e) {
            return 0;
        }
    }

    function selectAllPersonne()
    {
        $requete_prepare = $this->connexion->prepare(
            "SELECT * from Personne"
        );
        $requete_prepare->execute();
        $liste_personne = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $liste_personne;
    }

    function selectDixPersonne()
    {
        $requete_prepare = $this->connexion->prepare(
            "SELECT * from Personne LIMIT 10"
        );
        $requete_prepare->execute();
        $liste_personne = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $liste_personne;
    }

    function selectAllHobbies()
    {
        $requete_prepare = $this->connexion->prepare(
            "SELECT * FROM Hobby"
        );
        $requete_prepare->execute();
        $resultat = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    function selectAllMusique()
    {
        $requete_prepare = $this->connexion->prepare(
            "SELECT * FROM Musique"
        );
        $requete_prepare->execute();
        $resultat = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    function selectPersonneById($Id)
    {
        $requete_prepare = $this->connexion->prepare(
            "SELECT * FROM Personne WHERE Id = :Id"
        );
        $requete_prepare->execute(array("Id" => $Id));
        $resultat = $requete_prepare->fetch(PDO::FETCH_OBJ);
        return $resultat;
    }

    function selectPersonneByNomPrenomLike($pattern)
    {
        $requete_prepare = $this->connexion->prepare(
            "SELECT * FROM Personne 
            WHERE Nom LIKE :nom
            OR Prenom LIKE :prenom"
        );
        $requete_prepare->execute(array("nom" => "%$pattern%", "prenom" => "%$pattern%"));
        $resultat = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    function getPersonneHobby($personneId)
    {
        $requete_prepare = $this->connexion->prepare(
            "SELECT Type from RelationHobby
            INNER JOIN Hobby ON Hobby_Id = Id
            WHERE Personne_Id = :id"
        );
        $requete_prepare->execute(
            array("id" => $personneId)
        );
        $hobbies = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $hobbies;
    }

    function getPersonneMusique($personne_Id)
    {
        $requete_prepare = $this->connexion->prepare(
            "SELECT m.Type 
        FROM Musique m
        INNER JOIN RelationMusique r
        ON m.Id = r.Musique_Id
        WHERE r.Personne_Id = :personne_Id"
        );
        $requete_prepare->execute(
            array('personne_Id' => $personne_Id)
        );
        $musique = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $musique;
    }

    function getRelationPersonne($personneId)
    {
        $requete_prepare = $this->connexion->prepare(
            "SELECT * from RelationPersonne
            INNER JOIN Personne ON Personne_Id = Id
            WHERE Personne_Id = :id"
        );
        $requete_prepare->execute(
            array("id" => $personneId)
        );
        $liste_relations = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $liste_relations;
    }

    function insertPersonneHobbies($personId, $hobbies)
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                "INSERT INTO `RelationHobby` (`Personne_Id`, `Hobby_Id`) VALUES(:Personne_Id,:Hobby_Id);"
            );
            foreach($hobbies as $hobby){
                $requete_prepare->execute(
                    array("Personne_Id" => $personId,'Hobby_Id' => $hobby)
                );
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function insertPersonneMusiques($personId, $styles)
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                "INSERT INTO `RelationMusique` (`Personne_Id`, `Musique_Id`) VALUES(:Personne_Id,:Musique_Id);"
            );
            foreach($styles as $style){
                $requete_prepare->execute(
                    array("Personne_Id" => $personId,'Musique_Id' => $style)
                );
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function insertPersonneRelations($personId, $relationId, $type)
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                "INSERT INTO `RelationPersonne` (`Personne_Id`, `Relation_Id`,`Type`) VALUES(:Personne_Id,:Relation_Id,`:Type`);"
            );
            foreach($relations as $relation){
                $requete_prepare->execute(
                    array("Personne_Id" => $personId,"Relation_Id" => $relationId,"Type" => $type)
                );
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


}
?>