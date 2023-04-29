<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="styles/header.css"/>
  <link rel="stylesheet" href="styles/contribuer.css"/>
  <title>Page d'accueil</title>
</head>
<body>
<div class="principale">
    <header>
      <div class="logo">
        <a href="index.php"><span class="R">R</span><span>d</span><span class="F">F</span></a>
      </div>
      <nav>
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="Randonne.php">Randonnée</a></li>
          <li class="active"><a href="Contribuer.php">contribuer</a></li>
          <li><a href="Connexion.php">Connexion</a></li>
        </ul>
      </nav>
      <br>
      <div>
       <h1 >Parcours de randonnée</h1>
      </div>
    </header>
    <main>
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

  

    if(empty($nom) || empty($description) || empty($adresse_depart) || empty($image)) {
        echo "Veuillez remplir tous les champs obligatoires.";
       
    } else {
        // Upload de l'image
        $target_dir = "imagerando/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      }
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
              $stmt = $pdo->prepare("INSERT INTO randonne (nom, description, adresse_depart) VALUES (:nom, :description, :adresse_depart)");
              $stmt->bindParam(':nom', $nom);
              $stmt->bindParam(':description', $description);
              $stmt->bindParam(':adresse_depart', $adresse_depart);
              $stmt->execute();
              echo "La randonnée a été ajoutée avec succès !";
            } else {
                echo "Il y a eu une erreur lors du téléchargement du fichier.";
            }
        }
    
?> </h2>
    </main>
    
  </div>  
</body>
</html>

