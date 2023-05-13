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
        <a href="index.php"><span class="R">R</span><span  class="D">d</span><span class="F">F</span></a>
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
      <h2>
      <?php
      // Connexion à la base de données
      $dbh = mysqli_connect("localhost", "root", "", "projetweb");

      // Vérifier si l'utilisateur est connecté
      if (!isset($_SESSION['user_id'])) {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        header('Location: Connexion.php');
        exit();
      }


      if (!isset($_GET['nom_rando'])) {
        echo "Le nom de la randonnée n'a pas été fourni.";
        exit;
      }
      // Récupérer le nom de la randonnée à partir d'un paramètre GET
      $nom_rando = $_GET['nom_rando'];

      // Vérifier si l'utilisateur a déjà noté cette randonnée

      $utilisateur = $_SESSION['user_id'];
      $resultat = mysqli_query($dbh, "SELECT * FROM note WHERE nom_rando = '$nom_rando' AND utilisateur = '$utilisateur'");

      if (mysqli_num_rows($resultat) > 0) {
        echo "Vous avez déjà noté cette randonnée.";
        exit;
      }

        // Récupérer la note soumise par l'utilisateur
        $note = $_POST['note'];
        // Vérifier si la note est valide
        if ($note < 1 || $note > 5) {
          echo "La note doit être comprise entre 1 et 5.";
          exit;
        }

        // Ajouter la note à la base de données
        $resultat = mysqli_query($dbh, "INSERT INTO note (nom_rando, utilisateur, notes) VALUES ('$nom_rando', '$utilisateur', $note)");
        if ($resultat === false) {
          echo "Une erreur s'est produite lors de l'ajout de la note : " . mysqli_error($dbh);
          exit;
        }

        // Mettre à jour le score de popularité de la randonnée
        $resultat = mysqli_query($dbh, "SELECT AVG(notes) AS moyenne FROM note WHERE nom_rando = '$nom_rando'");
        $row = mysqli_fetch_assoc($resultat);
        $moyenne = $row['moyenne'];
        $resultat = mysqli_query($dbh, "UPDATE randonne SET Score = $moyenne WHERE Nom = '$nom_rando'");
        if ($resultat === false) {
          echo "Une erreur s'est produite lors de la mise à jour du score de popularité : " . mysqli_error($dbh);
          exit;
        }

        echo "Votre note a été ajoutée avec succès.";


      mysqli_close($dbh);
        ?>
      </h2>
    </section>
  </main>   

</body>
</html>