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
        <li class="active"><a href="Contribuer.php">Contribuer</a></li>
        <li><a href="Connexion.php">Connexion</a></li>
      </ul>
    </nav> 
    <section>
      <h2>Ajouter une randonnée</h2>
      <form action="#" method="post" enctype="multipart/form-data">
  <p>
    <label for="form-description">Nom de la randonnée :</label>
    <input id="form-description" type="text" name="description" size="40" />
  </p>
  <p>
    <label for="form-description">Description de la randonnée :</label>
    <input id="form-description" type="text" name="description" size="40" />
  </p>
  <p>
    <label for="form-description">Adresse du point de départ :</label>
    <input id="form-description" type="text" name="description" size="40" />
  </p>
  <p>
    <label for="form-image">Image :</label>
    <input id="form-image" type="file" name="image" size="40" />
  </p>
  <p><button type="submit">AJOUTER</button></p>
</form>
    </section>
  </div>
</body>
</html>