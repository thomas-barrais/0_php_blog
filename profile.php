<?php
require_once __DIR__ . '/database/database.php';
$authDB = require_once __DIR__ . '/database/security.php';
$articleDB = require_once __DIR__ . '/database/models/articleDB.php';

$articles = [];
$currentUser = $authDB->isLoggedin();
if (!$currentUser) {
  header('Location: /');
}

$articles = $articleDB->fetchUserArticle($currentUser['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/83f4286022.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700&family=Roboto:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./public/css/header-dark.css">
  <link rel="stylesheet" href="public/css/header-anim.css">
  <link rel="stylesheet" href="public/css/footer.css">
  <script src="./public/js/header.js"></script>
  <link rel="stylesheet" href="/public/css/profile.css">
  <title>Mon espace</title>
</head>

<body>
  <?php require_once 'include/header.php' ?>
  <div class="container">
    <div class="content">
      <h1>Mon espace</h1>
      <h2>Mes informations</h2>
      <div class="info-container">
        <ul>
          <li>
            <strong>Prénom :</strong>
            <p><?= $currentUser['firstname'] ?></p>
          </li>
          <li>
            <strong>Nom :</strong>
            <p><?= $currentUser['lastname'] ?></p>
          </li>
          <li>
            <strong>Email :</strong>
            <p><?= $currentUser['email'] ?></p>
          </li>
        </ul>
      </div>
      <h2>Mes articles</h2>
      <div class="articles-list">
        <ul>
          <?php foreach ($articles as $a) : ?>
            <li>
              <span><?= $a['title'] ?></span>
              <div class="article-actions">
                <a href="./delete-article.php?id=<?= $a['id'] ?>" class="btn btn-secondary btn-small">Supprimer</a>
                <a href="./form-article.php?id=<?= $a['id'] ?>" class="btn btn-primary btn-small">Modifier</a>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
  <?php require_once 'include/footer.php' ?>
</body>

</html>