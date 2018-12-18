<?php
// Déclaration de la classe
class Connexion
{
    private $connexion;
    public function __construct()
    {

        // le chemin vers le serveur
        $PARAM_hote = 'localhost';
        //Le port de connexion à la base de données
        $PARAM_port = '3306';
        // Le nom de votre base de données
        $PARAM_nom_bd = 'minifacebook';
        // nom d'utilisateur pour se connecter
        $PARAM_utilisateur = 'adminMiniFacebook';
        // mot de passe de l'utilisateur pour se connecter
        $PARAM_mot_passe = 'minifacebook';

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

    //ex3
    function insertHobby(string $hobby)
    {

         // On prépare notre requête
        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO Hobby (Type) values (:hobby)"
        );
         // On exécute la requête en remplaçant
          // :hobby par la variable $hobby qui est appelé dans testconnexion.php insertHobby("VideoGame");
        $requete_prepare->execute(
            array('hobby' => $hobby)
        );

    }

    //ex4
    function insertMusique(string $style)
    {
        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO Musique (Type) values (:musique)"
        );
        $requete_prepare->execute(
            array('musique' => $style)
        );
    }

    //ex5
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

    //ex6
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

    //SELECTIONNER TOUTES LES PERSONNES DE LA BDD
    function selectAllPersonne()
    {
        // Je prépare ma requete SQL
        $requete_prepare = $this->connexion->prepare(
            "SELECT * from Personne"
        );
        //J'execute la requete en passant la valeur
        $requete_prepare->execute();
        //Je recupere le resultat de la requete
        $liste_personne = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        //je retourne/renvoie la liste des relations
        return $liste_personne;
    }

    function selectDixPersonne()
    {
        // Je prépare ma requete SQL
        $requete_prepare = $this->connexion->prepare(
            "SELECT * from Personne LIMIT 10"
        );
        //J'execute la requete en passant la valeur
        $requete_prepare->execute();
        //Je recupere le resultat de la requete
        $liste_personne = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        //je retourne/renvoie la liste des relations
        return $liste_personne;
    }

    function selectAllHobbies()
    {

         //sélectionner tous les hobbies de la table Hobby
        $requete_prepare = $this->connexion->prepare(
            "SELECT * FROM Hobby"
        );
         //Exécution de la requête
        $requete_prepare->execute();
        //Met un tableau d'objet dans la variable
        // résultat. Le nom de chaque colonne correspond à une propriété objet
        $resultat = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    //ex9
    function selectAllMusique()
    {
        $requete_prepare = $this->connexion->prepare(
            "SELECT * FROM Musique"
        );
        $requete_prepare->execute();
        $resultat = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    //ex 10
    function selectPersonneById($Id)
    {
        $requete_prepare = $this->connexion->prepare(
            "SELECT * FROM Personne WHERE Id = :Id"
        );
        $requete_prepare->execute(array("Id" => $Id));
        $resultat = $requete_prepare->fetch(PDO::FETCH_OBJ);
        return $resultat;
    }

    //ex11
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

    //ex6 les relations one to many - many to many
    function getPersonneHobby($personneId)
    {
        // Je prépare ma requete SQL
        $requete_prepare = $this->connexion->prepare(
            "SELECT Type from RelationHobby
            INNER JOIN Hobby ON Hobby_Id = Id
            WHERE Personne_Id = :id"
        );
        //J'execute la requete en passant la valeur
        $requete_prepare->execute(
            array("id" => $personneId)
        );
        //Je recupere le resultat de la requete
        $hobbies = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        //je retourne/renvoie la liste hobby
        return $hobbies;
    }

    function getPersonneMusique($personne_Id)
    {
    // Je prépare ma requête 
        $requete_prepare = $this->connexion->prepare(
            "SELECT m.Type 
        FROM Musique m
        INNER JOIN RelationMusique r
        ON m.Id = r.Musique_Id
        WHERE r.Personne_Id = :personne_Id"
        );
    // J'execute la requête en passant la valeur
        $requete_prepare->execute(
            array('personne_Id' => $personne_Id)
        );
    // Je récupère le résultat de la requête
        $musique = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
    // Je retourne la liste de musique
        return $musique;
    }

    //ex11 les relations one to many - many to many
    function getRelationPersonne($personneId)
    {
        // Je prépare ma requete SQL
        $requete_prepare = $this->connexion->prepare(
            "SELECT * from RelationPersonne
            INNER JOIN Personne ON Personne_Id = Id
            WHERE Personne_Id = :id"
        );
        //J'execute la requete en passant la valeur
        $requete_prepare->execute(
            array("id" => $personneId)
        );
        //Je recupere le resultat de la requete
        $liste_relations = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        //je retourne/renvoie la liste des relations
        return $liste_relations;
    }

    /**
     * $personId : l'id de la personne source
     * $hobbies : un tableau de hobby ids
     */
    function insertPersonneHobbies($personId, $hobbies)
    {
        // Preparer la requete pour inserer une relation hobby
        try {
            $requete_prepare = $this->connexion->prepare(
                "INSERT INTO `RelationHobby` (`Personne_Id`, `Hobby_Id`) VALUES(:Personne_Id,:Hobby_Id);"
            );
            // Iterer sur chaque hobby et a chaque boucle executer la requete preparee
            $requete_prepare->execute(
                array('hobby' => $hobby)
            );
            $requete_prepare->execute(
                array("id" => $personneId)
            );
            return true;
        } catch (Exception $e) {
            return false;
        }

        $hobbies = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $hobbies;

    }

    /**
     * $personId : l'id de la personne source
     * $musiques : un tableau de musiques ids
     */
    function insertPersonneMusique($personId, $musiques)
    {
        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO `RelationMusique` (`Personne_Id`, `Musique_Id`) VALUES(:Personne_Id,:Musique_Id);"
        );
    }

    /**
     * $personId : l'id de la personne source
     * $relationId : l'id de la personne en relation avec la personne source
     * $type : le type de relation
     */
    function insertPersonneRelation($personId, $relationId, $type)
    {
        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO `RelationPersonne` (`Personne_Id`, `Relation_Id`,`Type`) VALUES(:Personne_Id,:Relation_Id,`:Type`);"
        );
    }

}
?>