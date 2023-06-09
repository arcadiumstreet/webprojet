<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="styles/header.css"/>
  <link rel="stylesheet" href="styles/randonne.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Randonnée</title>
</head>

<body class="white-text">
  <header>
    <div class="principale">
      <div class="logo">
        <a href="index.php"><span class="R">R</span><span class="D">d</span><span class="F">F</span></a>
      </div>
      <nav>
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="Contribuer.php">contribuer</a></li>
          <?php
          session_start();
          if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            echo '<li><a href="#">'.$user_id.'</a></li>';
          } else {
            echo '<li><a href="Connexion.php">Connexion</a></li>';
          }
        ?>
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
          echo "<br>";
          echo "<p>Description </p> : " . $row["Description"] . "<br>";
          echo "<br>";
          echo "<p>Adresse Point de départ </p> : " . $row["adresse_depart"]. "<br>";
          echo "<br>";

          $rando_nom = $_GET['nom_rando'];
          $images = glob("imagerando/{$rando_nom}.*");

          if (count($images) > 0) {
            $image = $images[0];
            echo "<img src='{$image}' alt='Image de la randonnée'>" . "<br>";
          } else {
            echo "Aucune image trouvée pour cette randonnée" . "<br>";
          }

          echo "</br>";
          
          $score = $row["Score"];
          echo "<p>Score de popularité </p> : ";
          for ($i = 1; $i <= 5; $i++) {
            if ($i <= floor($score)) {
              // Afficher une étoile pleine
              echo '<span class="fas fa-star"></span>';
            } else if ($i - $score <= 0.5) {
              // Afficher une étoile à moitié remplie
              echo '<span class="fas fa-star-half-alt"></span>';
            } else {
              // Afficher une étoile vide
              echo '<span class="far fa-star"></span>';
            }
          }
          echo "<br>";
        } else {
          // Aucun ou plusieurs résultats ont été trouvés
          echo "Aucun ou plusieurs résultats trouvés.";
        }
      }

      // Fermeture de la connexion à la base de données
      mysqli_close($dbh);

      ?>

      </br>

      <table>
      <tr>
      <td rowspan="2" style="border : 1px solid #333 "></td>
      </tr>
      <form method="post" action="noter_rando.php?nom_rando=<?php echo $row['Nom']; ?>">
      <label for="note"><p>Pour noter </p> : </label>
      <select name="note" id="note">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
      </select>
        <span> >>> </span>
      <input type="submit" value="Noter">
      </form>
      
      </table>

    </section>

    </br>

    <div class="deconnect">
      <?php
        if(isset($_SESSION['user_id'])){
          $user_id = $_SESSION['user_id'];
              
              echo '<form method="post" action="logout.php"><button class="deconnexion" type="submit">Déconnexion</button></form>';
            } else {

            }
      ?>
    </div>
          </br>
          </br>

  </main>    

</body>
</html>