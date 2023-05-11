<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="styles/header.css"/>
  <link rel="stylesheet" href="styles/index.css"/>
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
          <li class="active"><a href="Index.php">Accueil</a></li>
          <li><a href="Contribuer.php">contribuer</a></li>
          <li><a href="Connexion.php">Connexion</a></li>
        </ul>
      </nav>
    </div>
    <div class="titre">
      <h1> Besoin d'une randonnée ?</h1>
    </div>
    
    <div class="button">
    <a href="./photos/Sujet_Projet.pdf" download="Sujet_du_Projet.pdf" class="bouton-telecharger">Télécharger le sujet </a>
    </div>
  </header>
</br>

<main >
<<<<<<< HEAD

<form class="selectTri" method="get">
  <label for="tri">Trier par :</label>
  <select id="tri" name="tri">
    <option value="nom">Nom</option>
    <option value="score">Score</option>
  </select>
  <button type="submit">Trier</button>
</form>

=======
>>>>>>> ff56512c0d15b253eb9ceeb4ee83dbcee28c4334
<section class="defile">
<?php
  try {
    $dbh = new PDO("mysql:host=localhost;dbname=projetweb", "root", "");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
      echo "Erreur de connexion à la base de données: " . $e->getMessage();
  }




  // Vérifier si le bouton de tri a été cliqué
  if (isset($_GET['tri'])) {
    // Si le bouton de tri a été cliqué, trier les randonnées en fonction de l'option choisie
    if ($_GET['tri'] == 'nom') {
      $stmt = $dbh->prepare("SELECT * FROM randonne ORDER BY Nom");
    } else {
      $stmt = $dbh->prepare("SELECT * FROM randonne ORDER BY Score DESC");
    }
  } else {
    // Si le bouton de tri n'a pas été cliqué, afficher toutes les randonnées triées par nom par défaut
    $stmt = $dbh->prepare("SELECT * FROM randonne ORDER BY Nom");
  }

  $stmt->execute();
  $result = $stmt->fetchAll();
  $dbh = null;

  echo "<table style='border-collapse: separate '>";
  echo "<tr style='color: blue'> 
          <th> Nom </th>
          <th> adresse_depart </th>
          <th> Score </th>
      </tr>";
  foreach ($result as $row) {
      echo "<tr>";
      echo '<td><a href="Randonne.php?nom_rando=' . $row['Nom'] . '">' . $row['Nom'] . '</a></td>';
      echo "<td>" . $row['adresse_depart'] . "</td>";
      echo "<td>" . $row['Score'] . "</td>";
      echo "</tr>";
  }
  echo "</table>";

?>

<p>dhegfzvdge</p>
<p>dhegfzvdge</p>
<p>dhegfzvdge</p>
<p>dhegfzvdge</p>
<p>dhegfzvdge</p>

<p>dhegfzvdge</p>
<p>dhegfzvdge</p>
<p>dhegfzvdge</p>

<p>dhegfzvdge</p>
<p>dhegfzvdge</p>
<p>dhegfzvdge</p>

<p>dhegfzvdge</p>
<p>dhegfzvdge</p>
<p>dhegfzvdge</p>

</section>

  </main>
</body>
</html>