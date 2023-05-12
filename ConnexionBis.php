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
        <a href="index.php"><span class="R">R</span><span>d</span><span class="F">F</span></a>
      </div>
      <nav>
      <ul>
        <li><a href="Index.php">Accueil</a></li>
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

        session_start();

      try {
      $pdo = new PDO("mysql:host=localhost;dbname=projetweb", "root", "");
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
      }

      if (isset($_POST['premiere']) && $_POST['premiere'] == 'on') {
        //Si le nom est deja présent dans la base de données

        $stmt = $pdo->prepare("SELECT * FROM id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $id = $_POST['id'];
        $query = $pdo->prepare("SELECT COUNT(*) FROM id WHERE identifiant = :identifiant");
      $query->execute(array(':identifiant' => $id));
      $count = $query->fetchColumn();
      if ($count > 0) {
          // Le nom de l'utlisateur est déjà présent dans la base de données
          echo "Votre identifiant est déja utilisée <br><nav><ul><li><a href='Connexion.php'>reéssayer</a></li></ul></nav>";
      }else {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("INSERT INTO id (identifiant) VALUES (:identifiant)");
        $stmt->bindParam(':identifiant', $id);
        $stmt->execute();

        $_SESSION['user_id']=$id; // ici enregistre l'identifiant de l'utilisateur dans la variable de session

        echo "Bienvenue " . $id . ", vous etes connecté bienvenue sur votre site ";
        }
      }else {
       //si il est deja inscrit
       $stmt = $pdo->prepare("SELECT * FROM id");
       $stmt->execute();
       $result = $stmt->fetchAll();
       $id = $_POST['id'];
       $query = $pdo->prepare("SELECT COUNT(*) FROM id WHERE identifiant = :identifiant");
      $query->execute(array(':identifiant' => $id));
      $count = $query->fetchColumn();
      if ($count ==1 ) {
          // Le nom de l'utilisateur est déjà présent dans la base de données
          $_SESSION['user_id'] = $id;  // pareil que plus haut : on enregistre l'identifiant de l'utilisateur dans la variable session
          echo "Bienvenue " . $id . " ,ca fait plaisir de vous revoir.";
      }else {
        echo "Vous vous etes jamais connecter veillez créer un compte en cochant la case premiere connexion.";
      }
}
        ?>
        </h2>
      </section>
    </main>
</body>
</html>