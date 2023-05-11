<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="styles/header.css"/>
  <link rel="stylesheet" href="styles/randonne.css"/>
  <title>Liste des randos</title>
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
          <li><a href="Contribuer.php">contribuer</a></li>
          <li><a href="Connexion.php">Connexion</a></li>
        </ul>
      </nav>
    <h1 class="centre">Mais à quoi sert cette page ??</h1>
    </div>
    </header>

    <main>
      <section>
      <?php
      try {
        $dbh = new PDO("mysql:host=localhost;dbname=projetweb", "root", "");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
          echo "Erreur de connexion à la base de données: " . $e->getMessage();
      }
      $rando_nom = $_GET['nom_rando'];
      echo $rando_nom;
      ?>
        <p>Randonne</p>
        <p>je pense qu'on peut essayer de faire dans un tableau pour avoir l'image qui se palce bien</p>
      <table>
      <tr>
      <td>je suis la description </td>
      <td rowspan="2" style="border : 1px solid #333 ">je suis l'image</td>
      </tr>
      <tr>
      <td >je pense pas exactement genre autre chose </td>

      </table>

      </section>
    <a href="#haut">haut de page</a>
    </main>    
</body>
</html>