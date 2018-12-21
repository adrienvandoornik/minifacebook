<!--En-tête-->
<div class="header">
    <a href="recherche.php"><div class="logo"><h1>Mini Facebook</h1></div></a>
    <div class="btncreerunprofil">
        <a href="formulaire.php"><div class="button">+ Créer un profil</div></a>
    </div>
</div>
<!--barre de recherche-->
<div class="title">
    <div class="gigasearchbar">
    <form action="recherche.php" method="GET">
        <!-- Dans value il charge si il y a quelque chose de set dans le GET q et l'affiche dans la barre de recherche  -->
        <input type="text" name="q"  value="<?php if (isset($_GET['q'])) echo $_GET['q']; ?>" placeholder="Chercher une personne...">
    </form>
    </div>
</div>