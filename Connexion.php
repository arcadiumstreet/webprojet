<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="styles/header.css"/>
  <link rel="stylesheet" href="styles/connexion.css"/>
  <title>Connexion</title>
</head>

<body class="white-text">
  
  <header>
    <div class="principale">
      <div class="logo">
        <a href="index.php"><span class="R">R</span><span class="D">d</span><span class="F">F</span></a>
      </div>
      <nav>
      <ul>
        <li><a href="Index.php">Accueil</a></li>
        <li><a href="Contribuer.php">Contribuer</a></li>
        <?php
          session_start();
          if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            echo '<li><a href="#">'.$user_id.'</a></li>';
          } else {
            echo '<li class="active"><a href="Connexion.php">Connexion</a></li>';
          }
        ?>
      </ul>
    </nav>
  </div>
    <h1 class="centre">Connectez vous pour ajouter des randonnées</h1>
  </header>

  <main>
      <section>
        <h2>Connexion : </h2>
        </br>
            <form action="ConnexionBis.php" method="post">
              Identifiant : <input type="text" size="16" name="id" />
              <input type="submit" value="Se connecter" />
              </br>
              </br>
              Première connexion : <input type="checkbox" name = "premiere" id = "premiere">
            </form>
      </section>
  </main>
  
</body>
</html>