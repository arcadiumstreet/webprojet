<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="styles/header.css"/>
  <link rel="stylesheet" href="styles/connexion.css"/>
  <title>Page d'accueil</title>
</head>

<body class="white-text">
  <header>
    <div class="principale">
      <div class="logo">
        <a href="index.php"><span class="R">R</span><span>d</span><span class="F">F</span></a>
      </div>
      <nav>
      <ul>
        <li><a href="Index.php">Accueil</a></li>
        <li><a href="Randonne.php">Randonnée</a></li>
        <li><a href="Contribuer.php">Contribuer</a></li>
        <li class="active"><a href="Connexion.php">Connexion</a></li>
      </ul>
    </nav>
    <h1 class="centre">Connectez vous pour ajouter des randonnées</h1>
    </div>
  </header>
  

    <main>
      <section>
        <h2>Connexion : </h2>
            <form action="Connexion.php" method="post">
              Identifiant : <input type="text" size="16" name="iden" />
              <input type="submit" value="Se connecter" />
              </br>
              Premiere connexion : <input type="checkbox" id = "premiere">
            </form>
      </section>
    </main>
</body>
</html>