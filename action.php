<?php
require_once("connexion.php");
// connexion à la base de donnée
$appliDB = new Connexion();

// Les variables qui récupèrent les valeurs du formulaire Poster
$nom = $_POST['nom'];
echo "Nom : $nom <br>";
$prenom = $_POST['prenom'];
echo "Prenom : $prenom <br>";
$statut_couple = $_POST['statut'];
echo "Statut : $statut_couple <br>";
$url_photo = $_POST['url'];
echo "URL photo : $url_photo <br>";
$date_naissance = date('Y-m-d', strtotime($_POST['datedenaissance']));
echo "Date de naissance : $date_naissance <br>";
$styles = $_POST['genreMusical'];
var_dump($styles);
echo "</br>";
$hobbies = $_POST['Hobbies'];
var_dump($hobbies);
echo "</br>";
$personnes = $_POST['personnes'];
// var_dump = Affiche les informations d'une variable
var_dump($personnes); 
echo "</br>";

// la boucle parcours le tableau des style de musique et affiche les styles selectionné 
foreach ($styles as $style) {
   echo "La checkbox $style a été cochée<br>";
}

if (!$_POST['genreMusical']) {
   echo "Aucune checkbox n'a été cochée";
}
// parcours la table des hobbies et affiche les hobbies selectionné
foreach ($hobbies as $hobby) {
   echo "La checkbox $hobby a été cochée<br>";
}

if (!$_POST['Hobbies']) {
   echo "Aucune checkbox n'a été cochée";
}
// j'appelle la base de donnée et les functions pour insérer les données du nouveau profil
$idSource = $appliDB->insertPersonne($nom, $prenom, $url_photo, $date_naissance, $statut_couple);
$appliDB->insertPersonneHobbies($idSource, $hobbies);
$appliDB->insertPersonneMusiques($idSource, $styles);

// Insérer les relations
foreach ($personnes as $relationId) {
   $type = $_POST["relation$relationId"];
   echo "id de personne: " . $relationId . "<br>";
   echo "type de relation: " . $type . "<br>";
   $appliDB->insertPersonneRelation($idSource, $relationId, $type);
}

// je redirige sur la page du nouveau profil
header("Location: profil.php?id=$idSource");
?>  