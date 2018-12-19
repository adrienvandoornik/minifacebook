<?php
require_once("connexion.php");
// je crée mon objet connexion
$appliDB = new Connexion();

$query = $_POST['gigasearch']; 
$min_length = 1;
if (strlen ($query) < $min_length){
    header('Location: recherche.php');
}else{
    $personnes = $appliDB->selectPersonneByNomPrenomLike($query);
    foreach ($personnes as $personne) {
        echo "$personne->Nom <br>";
    }
}
?>