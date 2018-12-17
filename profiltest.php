<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>MON PROFIL</title>

  <link href="profil.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <?php require_once('connexion.php');
    $appliDB = new Connexion();
    $personne = $appliDB->selectPersonneById(4);
    $liste_relations = $appliDB->getRelationPersonne(4) ?>
</head>

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

    <div class="title">
    <?php
    echo '<div class="titleprofil"><p>PROFIL:' . $personne->Nom . $personne->Prenom . '</p></div>';
    ?>
      <div class="titlelistcontact"><p>Liste de personne en relation</p></div>
    </div>

    <div class="contenu">
      <div class="contenuprofil">
          <img src="image/profil.png" alt="photo profil">
          <?php
            echo "<table>
            <tr>
              <th>Nom</th>
              <td>$personne->Nom</td>
            </tr>
            <tr>
              <th>Prénom</th>
              <td>$personne->Prenom</td>
            </tr>
            <tr>
              <th>Statut</th>
              <td>$personne->Statut_couple</td>
            </tr>
            <tr>
              <th>Date de Naissance</th>
              <td>$personne->Date_Naissance</td>
            </tr>"; ?>
            <?php
            $allMusiquePerson = $appliDB->getPersonneMusique(4);
            $first = true;
            foreach ($allMusiquePerson as $value) {
                echo "<tr>";
                if ($first) {
                    echo "<th>Style musciaux</th>";
                    $first = false;
                } else {
                    echo "<th></th>";
                }
                echo '<td>' . $value->Type . '</td>';
                echo '</tr>';
            }
            ?>
            <?php 
            $allHobbiesPerson = $appliDB->getPersonneHobby(4);
            $first = true;
            foreach ($allHobbiesPerson as $value) {
                echo "<tr>";
                if ($first) {
                    echo "<th>Hobbies</th>";
                    $first = false;
                } else {
                    echo "<th></th>";
                }
                echo '<td>' . $value->Type . '</td>';
                echo '</tr>';
            }
            ?>
          </table>
          
          </div>
    <div class="contenulistcontact">
    <?php
    foreach ($liste_relations as $relation) {
        echo "<a href='profil.php'>
        <table>
         <tr>
          <td><img src='image/profil.png' height='70' width='70' alt='photo profil'></td>
          <td>" . $relation->Prenom . $relation->Nom . "<br>" . $relation->Type . "</td>
        </tr>
      </table></a>"
        ?>
      <a href="profil.php"><table>
         <tr>
          <td><img src="image/profil.png" height="70" width="70" alt="photo profil"></td>
          <td>Nom Prenom<br>
              Type de relation (Famille,Ami,Collegue)
          </td>
        </tr>
      </table></a>
      <a href="profil.php"><table>
         <tr>
          <td><img src="image/profil.png" height="70" width="70" alt="photo profil"></td>
          <td>Nom Prenom<br>
              Type de relation (Famille,Ami,Collegue)
          </td>
        </tr>
      </table></a>
      <a href="profil.php"><table>
         <tr>
          <td><img src="image/profil.png" height="70" width="70" alt="photo profil"></td>
          <td>Nom Prenom<br>
              Type de relation (Famille,Ami,Collegue)
          </td>
        </tr>
      </table></a>
      <a href="profil.php"><table>
         <tr>
          <td><img src="image/profil.png" height="70" width="70" alt="photo profil"></td>
          <td>Nom Prenom<br>
              Type de relation (Famille,Ami,Collegue)
          </td>
        </tr>
      </table></a>
      <a href="profil.php"><table>
         <tr>
          <td><img src="image/profil.png" height="70" width="70" alt="photo profil"></td>
          <td>Nom Prenom<br>
              Type de relation (Famille,Ami,Collegue)
          </td>
        </tr>
      </table></a>
      <a href="profil.php"><table>
         <tr>
          <td><img src="image/profil.png" height="70" width="70" alt="photo profil"></td>
          <td>Nom Prenom<br>
              Type de relation (Famille,Ami,Collegue)
          </td>
        </tr>
      </table></a>
      <a href="profil.php"><table>
         <tr>
          <td><img src="image/profil.png" height="70" width="70" alt="photo profil"></td>
          <td>Nom Prenom<br>
              Type de relation (Famille,Ami,Collegue)
          </td>
        </tr>
      </table></a>
    </div>

    <div class="footer">
      <p>Formation digitale - Mini Facebook by Adrien & Jonathan</p>
    </div>
  </div>
</body>
</html>
