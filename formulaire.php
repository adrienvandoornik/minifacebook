<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Creer un profil</title>
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <link href="formulaire.css" rel="stylesheet">
  <!--permet d'utiliser les fonctions de connexion.php-->
  <?php require('connexion.php');
  $appliDB = new Connexion();
  $allmusique = $appliDB->selectAllMusique();
  $allhobbies = $appliDB->selectAllHobbies();
  $dixpersonne = $appliDB->selectDixPersonne();
  ?>
</head>
<body>
  <!---la page commence ici--->
  <div class="container">
    <div class="header">
      <a href="recherche.php"><div class="logo"><h1>Mini Facebook</h1></div></a>
      <div class="btncreerunprofil">
        <a href="formulaire.php"><div class="button">+ Créer un profil</div></a>
      </div>
    </div>
    <!--Debut du Formulaire d'inscription-->
    <div class="divNPPB">
      <form name="formulaire" action="action.php" method="post">
        <table>
          <tr>
            <th>CREER UN PROFIL</th>
            <td></td>
          </tr>
          <tr><!--champs pour insèrer le nom-->
            <th>Nom</th>
            <td><input type="text" name="nom" placeholder="Insérer votre Nom" required></td>
          </tr>
          <tr><!--champs pour insérer le prénom-->
            <th>Prénom</th>
            <td><input type="text" name="prenom" placeholder="Insérer votre Prénom" required></td>
          </tr>
          <tr><!--champs pour choisir son statut-->
            <th>Statut</th>
            <td>
               <input type="radio" name="statut" value="celibataire"> Célibataire
               <input type="radio" name="statut" value="encouple">En couple
               <input type="radio" name="statut" value="marie"> Marié
               <input type="radio" name="statut" value="marie"> Relation Libre
               <input type="radio" name="statut" value="divorce">Divorcé
          </td>
          </tr>
          <tr><!--champs pour insèrer la photo-->
            <th>Insérer une photo</th>
            <td><input type="url" name="url" placeholder="Insérer l'url d'une photo ou image"></td>
          </tr>
          <tr><!--champs pour insèrer la date de naissance-->
            <th>Date de naissance</th>
            <td><input type="date" name="datedenaissance" required></td>
          </tr>
          <tr><!---boucle qui affiche la checkbox pour selectionné les genres musicaux--->
            <th>Préférence muscial</th> 
            <?php
            echo "<td>";
            foreach ($allmusique as $musique) {
              echo "<input type='checkbox' name='genreMusical[]' value='$musique->Id' id='M$musique->Id'><label for='M$musique->Id'>$musique->Type </label>";
            }
            echo "</td>";
            ?>
          </tr>
              <tr><!--boucle qui affiche la checkbox pour selectionné le type de Hobbies-->
                <th>Hobbies</th> 
                <?php
                echo "<td>";
                foreach ($allhobbies as $hobbies) {
                  echo "<input type='checkbox' name='Hobbies[]' value='$hobbies->Id' id='H$hobbies->Id'><label for='H$hobbies->Id'>$hobbies->Type </label>";
                }
                echo "</td>";
                ?>
              </tr>
              <tr><!--affiche les dix première personne de la base de donnée dans une checkbox pour selectionné le type de relation en commun -->
                <th>Ajouter des contacts</th>
                <?php
                echo "<td>";
                foreach ($dixpersonne as $personne) {
                  echo "<input type='checkbox' name='personnes[]' value='$personne->Id' id='P$personne->Id'><label for='P$personne->Id'>$personne->Nom $personne->Prenom </label>
                    <select id='relation' name='relation$personne->Id''>
                      <option label='' value=''></option>
                      <option label='famille' value='famille'>Famille</option>
                      <option label='ami' value='ami'>Ami</option>
                      <option label='collègue' value='collègue'>Collègue</option>
                    </select><br>";
                }
                echo "</td>";
                ?>
              </tr>
              <tr> <!--envoi les données dans le formulaire-->
                <th>Valider</th>
                <td><input class="Submit" type="submit" value="Enregistrer mon profil"></td>
              </tr>
            </table>
          </form>
        </div> 
        <!--link vers le ficher footer.php pour le bas de page-->
          <?php include 'footer.php' ?>
      </div> 
</body>
</html>
