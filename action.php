<?php
require_once("connexion.php");
// je crée mon objet connexion
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
    $style = $_POST['genreMusical'];
    $hobby = $_POST['Hobbies'];
    $relation = $_POST['relation'];

// Le tableau $_POST['genreMuscial'] contient les valeurs des checkbox cochées
foreach($_POST['genreMusical'] as $style)
{
   echo "La checkbox $style a été cochée<br>";
}

/*
Si l'utilisateur coche des styles musicaux, 
cet exemple va afficher:
La checkbox HipHop a été cochée
La checkbox Rock a été cochée
*/

if(!$_POST['genreMusical']){
    echo "Aucune checkbox n'a été cochée";
 }

 /*
Si l'utilisateur ne coche rien, 
cet exemple va afficher:
Aucune checkbox n'a été cochée
*/

// Le tableau $_POST['Hobbies'] contient les valeurs des checkbox cochées
foreach($_POST['Hobbies'] as $hobby)
{
   echo "La checkbox $hobby a été cochée<br>";
}

/*
Si l'utilisateur coche des hobbies, 
cet exemple va afficher:
La checkbox ami a été cochée
La checkbox famille a été cochée
*/

if(!$_POST['Hobbies']){
    echo "Aucune checkbox n'a été cochée";
 }

 /*
Si l'utilisateur ne coche rien, 
cet exemple va afficher:
Aucune checkbox n'a été cochée
*/
echo "<br>";
echo "<br>";
foreach($_POST['personnes'] as $personne)
{
   echo "La personne $personne a été sélectionnée <br>";
}
echo "<br>";
echo "<br>";
// Le tableau $_POST['relation'] contient les valeurs des checkbox cochées
foreach($_POST['relation'] as $relation)
{
   echo "La relation $relation a été sélectionnée <br>";
   
}

/*
Si l'utilisateur coche des relation, 
cet exemple va afficher:
La checkbox relation amis a été cochée
La checkbox relation famille a été cochée
*/

if(!$_POST['relation']){
    echo "Aucune checkbox n'a été cochée";
 }

 /*
Si l'utilisateur ne coche rien, 
cet exemple va afficher:
Aucune checkbox n'a été cochée
*/

    $appliDB->insertPersonne($nom,$prenom,$statut_couple,$url_photo,$date_naissance,$style,$hobby,$relation);

?>  