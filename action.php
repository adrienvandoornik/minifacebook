<?php
require_once("connexion.php");
$appliDB = new Connexion();

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
    var_dump($styles); echo "</br>";
    $hobbies = $_POST['Hobbies'];
    var_dump($hobbies); echo "</br>";
    $personnes = $_POST['personnes'];
    var_dump($personnes); echo "</br>";

foreach($styles as $style)
{
   echo "La checkbox $style a été cochée<br>";
}

if(!$_POST['genreMusical']){
    echo "Aucune checkbox n'a été cochée";
 }

foreach($hobbies as $hobby)
{
   echo "La checkbox $hobby a été cochée<br>";
}

if(!$_POST['Hobbies']){
    echo "Aucune checkbox n'a été cochée";
 }

echo "<br>";
echo "<br>";

foreach($personnes as $personne)
{
   echo "La personne $personne avec la relation ".$_POST['RelType' . $personne]." a été sélectionnée <br>";
}

echo "<br>";
echo "<br>";

$idSource = $appliDB->insertPersonne($nom,$prenom,$url_photo,$date_naissance,$statut_couple);
$appliDB->insertPersonneHobbies($idSource, $hobbies);
$appliDB->insertPersonneMusiques($idSource, $styles);
$appliDB->insertPersonneRelations($idSource,  $relationId, $type);

?>  