<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- test kraken push pull -->
  <title>Creer un profil</title>

  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <link href="formulaire.css" rel="stylesheet">
  <?php require('connexion.php');
  $appliDB = new Connexion();
  $allmusique = $appliDB->selectAllMusique();
  $allhobbies = $appliDB->selectAllHobbies();
  $dixpersonne = $appliDB->selectDixPersonne();
  ?>
</head>
<!---DEBUT DE LA PAGE --->
<body>
  <div class="container">

    <div class="header">
      <a href="recherche.php"><div class="logo"><h1>Mini Facebook</h1></div></a>
      <div class="barrederechercheheader">
        <input type="text" name="search" placeholder="Chercher un contact...">
      </div>
      <div class="btncreerunprofil">
        <a href="formulaire.php"><div class="button">+ Créer un profil</div></a>
      </div>
    </div>
    <div class="divNPPB">
      <form name="formulaire" action="action.php" method="post">
        <table>
          <tr>
            <th>CREER UN PROFIL</th>
            <td></td>
          </tr>
          <tr>
            <th>Nom</th>
            <td><input type="text" name="nom" placeholder="Insérer votre Nom" required></td>
          </tr>
          <tr>
            <th>Prénom</th>
            <td><input type="text" name="prenom" placeholder="Insérer votre Prénom" required></td>
          </tr>
          <tr>
            <th>Statut</th>
            <td>
               <input type="radio" name="statut" value="celibataire"> Célibataire
               <input type="radio" name="statut" value="encouple">En couple
               <input type="radio" name="statut" value="marie"> Marié
               <input type="radio" name="statut" value="marie"> Relation Libre
               <input type="radio" name="statut" value="divorce">Divorcé
          </td>
          </tr>
          <tr>
            <th>Insérer une photo</th>
            <td><input type="url" name="url" placeholder="Insérer l'url d'une photo ou image"></td>
          </tr>
          <tr>
            <th>Date de naissance</th>
            <td><input type="date" name="datedenaissance" required></td>
          </tr>
          <tr>
            <th>Préférence muscial</th>
            <?php
            echo "<td>";
            foreach ($allmusique as $musique) {
              echo "<input type='checkbox' name='genreMusical[]' value='$musique->Id' id='M$musique->Id'><label for='M$musique->Id'>$musique->Type </label>";
            }
            echo "</td>";
            ?>
          </tr>
              <tr>
                <th>Hobbies</th>
                <?php
                echo "<td>";
                foreach ($allhobbies as $hobbies) {
                  echo "<input type='checkbox' name='Hobbies[]' value='$hobbies->Id' id='H$hobbies->Id'><label for='H$hobbies->Id'>$hobbies->Type </label>";
                }
                echo "</td>";
                ?>
              </tr>
              <tr>
                <th>Ajouter des contacts</th>

                <?php
                echo "<td>";
                  foreach ($dixpersonne as $personne) {
                    echo "<input type='checkbox' name='personnes[]' value='$personne->Nom' id='P$personne->Id'><label for='P$personne->Id'>$personne->Nom $personne->Prenom </label>
                    <select id='relation' name='$personne->Id'>
                      <option label='' value=''></option>
                      <option label='famille' value='famille'>Famille</option>
                      <option label='ami' value='ami'>Ami</option>
                      <option label='collègue' value='collègue'>Collègue</option>
                    </select><br>";
                }
                echo "</td>";
                ?>
              </tr>
              <tr>
                <th>Valider</th>
                <td><input class="Submit" type="submit" value="Enregistrer mon profil"></td>
              </tr>
            </table>
          </form>
        </div> <!-- divNPPB -->
        <div class="footer">
          <p>Formation digitale - Mini Facebook by Adrien & Jonathan</p>
        </div>
      </div> <!-- container -->
       <!-- test kraken push pull -->
</body>
</html>
