<?php
require_once("connexion.php");
// je crée mon objet connexion
$appliDB = new Connexion();
// je récupère la valeur du gigasearch dans la variable query
$query = $_POST['gigasearch'];
$min_length = 1;
// si la longueur de la valeur query est plus petite que le minimum de longueur défini
if (strlen($query) < $min_length) {
    // je redirige sur la page de recherche
    header('Location: recherche.php');
} else {
    // sinon je charge les personnes par leur nom et prénom
    $personnes = $appliDB->selectPersonneByNomPrenomLike($query);
    foreach ($personnes as $personne) {
        echo "$personne->Nom <br>";
    }
}
?>