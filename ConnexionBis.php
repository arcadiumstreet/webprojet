<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="styles/header.css"/>
  <link rel="stylesheet" href="styles/connexion.css"/>
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
        <li><a href="Index.php">Accueil</a></li>
        <li><a href="Randonne.php">Randonnée</a></li>
        <li><a href="Contribuer.php">Contribuer</a></li>
        <li class="active"><a href="Connexion.php">Connexion</a></li>
      </ul>
    </nav>
  </div>    
    </div>
  </header>
    <main>
      <section>
        <h2>
        <?php 
      try {
     $pdo = new PDO("mysql:host=localhost;dbname=projetweb", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
       echo "Erreur de connexion à la base de données: " . $e->getMessage();
    }

    if(!isset($_POST['premiere']) && $_POST['premiere'] != 'on'){
    //si il est deja inscrit
    $stmt = $pdo->prepare("SELECT * FROM id");
    $stmt->execute();
    $result = $stmt->fetchAll();
    $id = $_POST['id'];
    $query = $pdo->prepare("SELECT COUNT(*) FROM id WHERE identifiant = :identifiant");
  $query->execute(array(':identifiant' => $id));
  $count = $query->fetchColumn();
  
  if ($count ==1 ) {
      // Le nom de randonnée est déjà présent dans la base de données
      echo "Bienvenue " . $id . " ,ca fait plaisir de vous revoir.";
  }else {
    echo "Vous vous etes jamais connecter veillez créer un compte en cochant la case premiere connexion.";
  }
}else {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("INSERT INTO id (identifiant) VALUES (:identifiant)");
    $stmt->bindParam(':identifiant', $id);
    $stmt->execute();
    echo "Bienvenu " . $id . ", vous etes connecté bienvenue sur votre site ";
}
        ?>
        </h2>
      </section>
    </main>
</body>
</html>