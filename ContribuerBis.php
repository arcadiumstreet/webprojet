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


  // Si tout est correct, télécharger le fichier
    }else{
        // Upload de l'image
        function redimensionneImageJpeg($sourceImageName, $destWidth, $destHeight) {
          $destHeight = intval($destHeight);
          $destWidth = intval($destWidth);
          // crée une ressource image correspondant au fichier jpeg $sourceImageName
          $sourceImage = imagecreatefromjpeg($sourceImageName); 
          // crée une ressource image noire (pour le moment) correspondante 
          // pour accueillir l'image destination
          $destImage = imagecreatetruecolor($destWidth,$destHeight); 
          // recopie l'image source en la redimensionnant dans $destImage
          imagecopyresampled($destImage,$sourceImage,0,0,0,0,
              $destWidth,$destHeight,imagesx($sourceImage),imagesy($sourceImage)); 
          // retourne la ressource image $destImage
          return $destImage;
      }
        //redimensionne l'image 
      $imageredim = $_FILES['image']['tmp_name'];
      list($width, $height) = getimagesize($imageredim);
      echo "La taille de l'image est de : " . $width . " x " . $height;
      if ($width > 700 || $height > 700) {
        while ($width > 700 || $height > 700) {
          $width = $width * 95 / 100;
          $height = $height * 95 / 100;
        }
        $width=(int) $width;
        $height=(int) $height;
        echo "</br>La taille de l'image est de : " . $width . " x " . $height;
        $imageredim=redimensionneImageJpeg($imageredim,$width, $height);
      }
        $nom_rando = $_POST['nom'];
        $extension = pathinfo($image, PATHINFO_EXTENSION);

        $target_dir = "imagerando/";
        $target_file = $target_dir . $nom_rando . '.' . $extension;

        // sauvegarde l'image redimensionnée dans un fichier temporaire
        $tmp_file = $target_dir . 'rando_' . uniqid() . '.' . $extension;
         imagejpeg($imageredim, $tmp_file);
         if (rename($tmp_file, $target_file)) {
          
          echo "</br>Le fichier a été téléchargé avec succès.";
          $stmt = $pdo->prepare("INSERT INTO randonne (nom, description, adresse_depart) VALUES (:nom, :description, :adresse_depart)");
              $stmt->bindParam(':nom', $nom);
              $stmt->bindParam(':description', $description);
              $stmt->bindParam(':adresse_depart', $adresse_depart);
              $stmt->execute();
              echo "</br>La randonnée a été ajoutée avec succès !";
              imagedestroy($imageredim);
        } else {
          echo "Une erreur s'est produite lors du téléchargement du fichier.";
        }

          }
  }
}
?> 
</h2>
    </main>  
</body>
</html>

