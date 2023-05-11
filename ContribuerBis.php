<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="styles/header.css"/>
  <link rel="stylesheet" href="styles/contribuer.css"/>
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
          <li><a href="index.php">Accueil</a></li>
          <li class="active"><a href="Contribuer.php">contribuer</a></li>
          <li><a href="Connexion.php">Connexion</a></li>
        </ul>
      </nav>
      <br>
      
      </div>
    </header>

    <main>
    <div>
       <h1>Parcours de randonnée</h1>
      </div>
    <h2>
<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=projetweb", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $adresse_depart = $_POST['adresse_depart'];
    $image = $_FILES['image']['name'];

    $extension = pathinfo($image, PATHINFO_EXTENSION);

    if(empty($nom) || empty($description) || empty($adresse_depart) || empty($image)) {
        echo "Veuillez remplir tous les champs obligatoires.";  
        echo "<br><nav><ul><li><a href='Contribuer.php'>reéssayer</a></li></ul></nav>";
    } else {

      //controle image
      $target_file = "imagerando/" . basename($_FILES['image']['name']);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      if (file_exists($target_file)) {
        echo "Le fichier image existe déjà.";
        $uploadOk = 0;
    }

    // Autoriser certains formats de fichiers
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
      $uploadOk = 0;
  }
  //controle si le nom de la rando est present
  $query = $pdo->prepare("SELECT COUNT(*) FROM randonne WHERE nom = :nom");
  $query->execute(array(':nom' => $nom));
  $count = $query->fetchColumn();
  
  if ($count > 0) {
      // Le nom de randonnée est déjà présent dans la base de données
      echo "Le nom de randonnée est déjà utilisé.";
      $uploadOk = 0;
  }
    // Vérification si $uploadOk est égal à 0
    if ($uploadOk == 0) {
      echo "<br>Le fichier n'a pas été téléchargé.";
      echo "<br><nav><ul><li><a href='Contribuer.php'>reéssayer</a></li></ul></nav>" ;

      //redimensionne l'image de

  // Si tout est correct, télécharger le fichier
    }else{
        // Upload de l'image
        /*
        $target_dir = "imagerando/";
        //$target_file = $target_dir . basename($_FILES['image']['name']);
        $target_file = $target_dir . $nom . '.' . $extension;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        */
        $image = $_FILES['image']['name'];
        $nom_rando = $_POST['nom'];
        $extension = pathinfo($image, PATHINFO_EXTENSION);

        $target_dir = "imagerando/";
        $target_file = $target_dir . $nom_rando . '.' . $extension;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
          echo "Le fichier a été téléchargé avec succès.";
        } else {
          echo "Une erreur s'est produite lors du téléchargement du fichier.";
        }

              $stmt = $pdo->prepare("INSERT INTO randonne (nom, description, adresse_depart) VALUES (:nom, :description, :adresse_depart)");
              $stmt->bindParam(':nom', $nom);
              $stmt->bindParam(':description', $description);
              $stmt->bindParam(':adresse_depart', $adresse_depart);
              $stmt->execute();
              echo "La randonnée a été ajoutée avec succès !";
          }
  }
}
?> 
</h2>
    </main>  
</body>
</html>

