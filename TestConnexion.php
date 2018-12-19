<?php

require_once("connexion.php");
// je crée mon objet connexion
$appliDB = new Connexion();
// j'appelle la function get Hobbies de l'objet appliDB
// cette fonction est définie dans la classe Connexion
$appliDB->selectAllHobbies();

/*
//ex2
if ($appliDB->getConnexion() == null) {
    echo "Connection BD échouée";
}  else {
    echo "Connection BD réussie";
}

//ex1
// $retourConnexion = connexionBD();

//ex3
$appliDB->insertHobby("VideoGame");
$appliDB->insertHobby("Design");
$appliDB->insertHobby("Art");
$appliDB->insertHobby("Sport");
$appliDB->insertHobby("Gloubiboulga");

//ex4
$appliDB->insertMusique("Rock");
$appliDB->insertMusique("Hip-Hop");
$appliDB->insertMusique("Blues");

//ex5
$hobby = $appliDB->insertHobby2("");
$appliDB->insertHobby2("YeahYeahYo");

if (!$hobby) {
    echo "False";
} else {
    echo "True";
}

//ex6
$appliDB->insertPersonne('Pablo','Escobar','http://www.google.ch','1965.12.31','polygame');
$appliDB->insertPersonne('Jennifer','Lopez','http://www.jennifer.ch','1932.12.31','en couple');
$appliDB->insertPersonne('Steve','Job','http://www.apple.ch','1987.03.13','divorce');

//ex8
echo "<p>Hobbies</p><br>";
echo "<ul>";
$resultat = $appliDB->selectAllHobbies();{
    foreach($resultat as $hobby){
        echo "<li>".($hobby->Type."</li>");
    } 
}
echo "</ul>";

//ex9
echo "Musique:<br>";
$musiques = $appliDB->selectAllMusique();{
    foreach($musiques as $m){
        echo "<input type='checkbox'>".$m->Type."</input>";
        echo "<br>";
    }

}

//ex10
$personnes = $appliDB->selectPersonneByNomPrenomLike("LopezJennifer");
*/

//ex8
/* echo "<p>Liste des hobbies</p>";
echo "<ul>";
$resultat = $appliDB->getPersonneHobby(4);{
    foreach($resultat as $hobbies){
        echo "<li>".($hobbies->Type."</li>");
    } 
}
echo "</ul>";

//ex11
echo "<p>Liste des relations</p>";

echo"<table>";
echo"<tr>";
echo"<th>Nom</th>";
echo"<th>Prenom</th>";
echo"<th>Type de relation</th>";
echo"</tr>";
$liste_relations = $appliDB->getRelationPersonne(4);{
    foreach($liste_relations as $relation){
        echo "<tr><td>".$relation->Prenom."</td></tr>";
        echo "<tr><td>".$relation->Nom."</td></tr>";
        echo "<tr><td>".$relation->Type."</td></tr>";
    } 
}
echo"</table"; */
/*
echo "<ul>";
$liste_relations = $appliDB->getRelationPersonne(4);{
    foreach($liste_relations as $relation){
        echo "<li>".var_dump($relation)."</li>";
    } 
}
echo "</ul>";
*/


/* 
echo "<p>Liste de la personne</p>";
echo "<ul>";
$resultat = $appliDB->selectPersonneById(4);
    foreach($resultat as $personne){
        echo "<li>".($personne->Nom ."</li>");
    } 
echo "</ul>"; */

// Affichage en une liste non ordonnée de Musique
/*  $personne_Id = 1;
$allMusiquePerson = $appliBD->getPersonneMusique ($personne_Id);
echo "<ul>";
foreach ($allMusiquePerson as $value){
    echo "<li>" . $value -> Type . "</li>";
}
echo "</ul>"; */


$pattern = "ang";
$personnes = $appliDB->selectPersonneByNomPrenomLike($pattern);
var_dump ($personnes);
foreach ($personnes as $personne){
    echo $personne->Nom;
    echo "<br>";
}

?>