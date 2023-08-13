<?php
require __DIR__ . '/database/database.php';

$authDB = require __DIR__ . '/database/security.php';
$currentUser = $authDB->isLoggedin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once 'include/head.php' ?>
  <link rel="stylesheet" href="/public/css/articles.css">
  <link rel="stylesheet" href="/public/css/index.css">
  <title>Blog</title>
</head>

<body>
  <div class="container">
    <?php require_once 'include/header.php' ?>


    <nav class="header-menu-static">
      <a href="/">ACCEUIL</a>
      <a href="../projects.php">LES PROJETS</a>
      <a href="../articles.php">LES VISITES</a>
      <a href="/team.php">L'EQUIPE</a>
      <a href="/press.php">PRESSE</a>
      <a href="/partners.php" class="nav-active">PARTENAIRES</a>
      <a href="#contact">CONTACT</a>
    </nav>
    <div class="vp-content">

    </div>
    <?php require_once 'include/footer.php' ?>

  </div>
</body>

</html>