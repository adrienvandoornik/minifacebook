<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MON PROFIL</title>
  <link href="recherche.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
   <?php require_once('connexion.php');
   // connexion à la BD
  $appliDB = new Connexion();
  // Si je récupère des valeurs dans le GET q alors
  if (isset($_GET["q"])) { 
    // la je fais la recherche
    $liste_personne = $appliDB->selectPersonneByNomPrenomLike($_GET["q"]);
  } else {
    // sinon je réaffiche toutes les personnes
    $liste_personne = $appliDB->selectAllPersonne();
  }
  ?>
</head>
<body>
  <div class="container">
    <?php 
    // j'insère l'en-tete
    include 'header.php'
    ?>
    <div class="contenu">
      <div class="contenulistcontact">
      <?php
    // boucle qui implémente la liste des personnes
      foreach ($liste_personne as $personne) {
        echo "<a href='profil.php?id=$personne->Id'>
      <table>
        <tr>
          <td><img src='$personne->URL_Photo'></td>
          <td><h5>" . $personne->Prenom . " " . $personne->Nom . "</h5><h6>" . $personne->Date_Naissance . "</h6></td>
        </tr>
      </table></a>";
      }
      ?>
    </div>
  </div>
  <?php 
  // j'insère le bas de page
  include 'footer.php' ?>
  </div>
</body>
</html>
