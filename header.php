<div class="header">
    <a href="recherche.php"><div class="logo"><h1>Mini Facebook</h1></div></a>
    <div class="btncreerunprofil">
        <a href="formulaire.php"><div class="button">+ Créer un profil</div></a>
    </div>
</div>

<div class="title">
    <div class="gigasearchbar">
    <form action="recherche.php" method="GET">
        <input type="text" name="q"  value="<?php if (isset($_GET['q'])) echo $_GET['q']; ?>" placeholder="Chercher une personne...">
    </form>
    </div>
</div>