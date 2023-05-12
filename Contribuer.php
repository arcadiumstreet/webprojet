<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: Connexion.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="styles/header.css"/>
  <link rel="stylesheet" href="styles/contribuer.css"/>
  <title>Contribuer</title>
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
          <li class="active"><a href="Contribuer.php">contribuer</a></li>
          <?php
          if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            echo '<li><a href="#">'.$user_id.'</a></li>';
          } else {
            echo '<li class="active"><a href="Connexion.php">Connexion</a></li>';
          }
        ?>
        </ul>
      </nav>
      <br>
      <h1 class="centre">Parcours de randonnée</h1>
    </div>
  </header>
  
    <main>
      
      <section>
        
        <h2>Ajouter une randonnée : </h2>
          
        <form action="ContribuerBis.php" method="post" enctype="multipart/form-data">
            <p>
              <label for="form-description">Nom de la randonnée :</label>
              <input id="form-nom" type="text" name="nom" size="40" />
            </p>
            <p>
              <label for="form-description">Description de la randonnée :</label>
              <input id="form-description" type="text" name="description" size="40" />
            </p>
            <p>
              <label for="form-adresse">Adresse du point de départ :</label>
              <input id="form-adresse" type="text" name="adresse_depart" size="40" />
            </p>
            <p>
              <label for="form-image">Image :</label>
              <input id="form-image" type="file" name="image" size="40" />
            </p>
            <p><button type="submit" class="btnAjout">AJOUTER</button></p>
        </form>
          
      </section>
      
      <div class="deconnect">
      <?php
        if(isset($_SESSION['user_id'])){
          $user_id = $_SESSION['user_id'];
              
              echo '<form method="post" action="logout.php"><button class="deconnexion" type="submit">Déconnexion</button></form>';
            } else {

            }
      ?>
    </div>

    </main>  
</body>
</html>