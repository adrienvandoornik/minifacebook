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
  $appliDB = new Connexion();
  $liste_personne = $appliDB->selectAllPersonne() ?>
</head>

<body>
  <div class="container">

    <div class="header">
        <a href="recherche.php"><div class="logo"><h1>Mini Facebook</h1></div></a>
      <div class="btncreerunprofil">
         <a href="formulaire.php"><div class="button">+ Créer un profil</div></a>
      </div>
    </div>

    <div class="title">
      <div class="gigasearchbar">
         <input type="text" name="gigasearch" placeholder="Chercher un contact...">
      </div>
    </div>

    <div class="contenu">
      <div class="contenulistcontact">
      <?php
    foreach ($liste_personne as $personne) {
      echo "<a href='profil.php?id=$personne->Id'>
      <table>
      <tr>
       <td><img src='$personne->URL_Photo'></td>
       <td><h5>" . $personne->Prenom ." ". $personne->Nom . "</h5><h6>" . $personne->Date_Naissance . "</h6></td>
     </tr>
   </table></a>";
    }
      ?>
    </div>
  </div>

    <div class="footer">
      <p>Formation digitale - Mini Facebook by Adrien & Jonathan</p>
    </div>

  </div>

</body>
</html>
