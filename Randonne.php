<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="styles/header.css"/>
  <link rel="stylesheet" href="styles/randonne.css"/>
  <title>Liste des randos</title>
</head>
<body class="white-text">
    <header>
    <div class="principale">
      <div class="logo">
        <a href="index.php"><span class="R">R</span><span>d</span><span class="F">F</span></a>
      </div>
      <nav>
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="Contribuer.php">contribuer</a></li>
          <li><a href="Connexion.php">Connexion</a></li>
        </ul>
      </nav>
    <h1 class="centre">Randonnée : " <?php echo $_GET['nom_rando'] ?> "</h1>
    </div>
    </header>

    <main>
      <section>
      <?php
    
      // Récupérer le nom de la randonnée à partir d'un paramètre GET
      $nom_rando = $_GET['nom_rando'];

      // Connexion à la base de données
      $dbh = mysqli_connect("localhost", "root", "", "projetweb");

      // Requête SQL pour récupérer la randonnée avec le nom donné
      $resultat = mysqli_query($dbh, "SELECT * FROM randonne WHERE Nom = '$nom_rando'");

      // Vérifier si la requête a échoué
      if ($resultat === false) {
        echo "Une erreur s'est produite lors de l'exécution de la requête : " . mysqli_error($dbh);
      } else {
        // Vérifier si une seule randonnée a été trouvée
        if (mysqli_num_rows($resultat) == 1) {
          // Un seul résultat a été trouvé
          $row = mysqli_fetch_assoc($resultat);
          // Utilisez les données du résultat ici
                                            //echo "Nom randonnée : " . $row["Nom"] . ", Description : " . $row["Description"];
          echo "<br>";
          echo "Description : " . $row["Description"] . "<br>";
          echo "<br>";
          echo "Adresse Point de départ : " . $row["adresse_depart"]. "<br>";
          echo "<br>";

          $rando_nom = $_GET['nom_rando'];
          $images = glob("imagerando/{$rando_nom}.*");

          if (count($images) > 0) {
            $image = $images[0];
            echo "<img src='{$image}' alt='Image de la randonnée'>" . "<br>";
          } else {
            echo "Aucune image trouvée pour cette randonnée";
          }

          
          echo "score de popularité : " . $row["Score"];
          echo "<br>";
        } else {
          // Aucun ou plusieurs résultats ont été trouvés
          echo "Aucun ou plusieurs résultats trouvés.";
        }
      }

// Fermeture de la connexion à la base de données
mysqli_close($dbh);



      ?>

      <table>
      <tr>

      <td rowspan="2" style="border : 1px solid #333 "></td>
      </tr>
      <tr>
      <td ></td>

      </table>

      </section>
    </main>    
</body>
</html>