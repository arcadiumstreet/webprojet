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
          <?php
          session_start();
          if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            echo '<li><a href="#">'.$user_id.'</a></li>';
            echo '<form method="post" action="logout.php"><button type="submit">Déconnexion</button></form>';
          } else {
            echo '<li><a href="Connexion.php">Connexion</a></li>';
          }
         
        ?>
          <!-- <li><a href="Connexion.php">Connexion</a></li> -->
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

<form class="selectTri" method="get">
  <button class="tributton" type="submit" name="tri_nom">Trier par nom</button>
  <button class="tributton" type="submit" name="tri_score">Trier par score</button>
</form>

<section class="defile">
<?php
  try {
    $dbh = new PDO("mysql:host=localhost;dbname=projetweb", "root", "");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
      echo "Erreur de connexion à la base de données: " . $e->getMessage();
  }


 // Vérifier si un des boutons de tri a été cliqué
 if (isset($_GET['tri_nom']) || isset($_GET['tri_score'])) {
  // Déterminer quel bouton de tri a été cliqué et trier les randonnées en conséquence
  if (isset($_GET['tri_nom'])) {
    $stmt = $dbh->prepare("SELECT * FROM randonne ORDER BY Nom");
  } else {
    $stmt = $dbh->prepare("SELECT * FROM randonne ORDER BY Score DESC");
  }
} else {
  // Si aucun bouton de tri n'a été cliqué, afficher toutes les randonnées triées par nom par défaut
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


</section>

  </main>
</body>
</html>