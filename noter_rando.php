<?php
    
  

  // Connexion à la base de données
  $dbh = mysqli_connect("localhost", "root", "", "projetweb");

  // Vérifier si l'utilisateur est connecté
  session_start();
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
  
  // Vérifier si l'utilisateur a soumis une note
  if (isset($_POST['note'])) {
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
    echo "la moyenne est" . $moyenne ;
    $resultat = mysqli_query($dbh, "UPDATE randonne SET Score = $moyenne WHERE Nom = '$nom_rando'");
    if ($resultat === false) {
      echo "Une erreur s'est produite lors de la mise à jour du score de popularité : " . mysqli_error($dbh);
      exit;
    }

    echo "Votre note a été ajoutée avec succès.";
  } else {
    // Afficher le formulaire de notation

  }

  mysqli_close($dbh);
    ?>