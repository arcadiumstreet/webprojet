<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="styles/Randonnée.css"/>
  <title>Page d'accueil</title>
</head>
<body>
  <div id="wrapper">
    <header>
      <h1>Parcours de randonnée</h1>
    </header>
    <nav>
      <ul>
        <li><a href="Index.php">Accueil</a></li>
        <li><a href="Randonne.php">Randonnée</a></li>
        <li><a href="Contribuer.php">Contribuer</a></li>
        <li><a href="Connexion.php">Connexion</a></li>
      </ul>
    </nav> 
    <section>
      <h2>Connexion : </h2>
          <form action="Connexion.php" method="post">
            Identifiant : <input type="text" size="16" name="iden" />
            <input type="submit" value="Se connecter" />
            </br>
            Premiere connexion : <input type="checkbox" id = "premiere">
          </form>
    </section>
  </div>
</body>
</html>