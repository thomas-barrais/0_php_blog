<?php
require __DIR__ . '/database/database.php';

$authDB = require __DIR__ . '/database/security.php';
$currentUser = $authDB->isLoggedin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once 'include/head.php' ?>
  <link rel="stylesheet" href="/public/css/team.css">
  <title>Notre équipe - Passion BTP</title>
  <script src="./public/js/overlay.js"></script>
</head>

<body>
  <?php require_once 'include/header.php' ?>

  <section class="home">
    <img src="./public/img/team.jpg" alt="">

    <div class="content active">
      <h1>Notre<br><span>équipe 2023-2024</span></h1>
      <div class="center">
        <a href="#bureau">
          <h2>Le bureau</h2>
        </a>
        <a href="#commerce">
          <h2>Le pôle commercial</h2>
        </a>
        <a href="#comm">
          <h2>Le pôle communication</h2>
        </a>
        <a href="#event">
          <h2>Le pôle event</h2>
        </a>
      </div>
    </div>
  </section>

  <div class="team-container">
    <div class="overlay" id="cardOverlay">
      <div class="profile-card-overlay">
        <span class="close-btn" id="closeBtn">&times;</span>
        <div class="profile-img-container">
          <img src="" alt="Profile" class="profile-img-full" id="fullProfileImg">
        </div>
        <div class="profile-info-full" id="fullProfileInfo">
        </div>
      </div>
    </div>
    <ul class="gallery">
      <div id="bureau" class="section-heading">
        Le Bureau
        <p>Ajoutez une courte description</p>
      </div>
      <div class="flex-section">
        <li class="profile-card" data-description="Il est à la tête de l’association, il représente passion BTP à tous les niveaux, surtout pour l’événement, et se charge des décisions les plus importantes avec le bureau.">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="https://www.linkedin.com/in/mehdy-boutes-020723192">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Mehdy BOUTES</p>
            <p class="profile-work">Président</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Romaric ONESTI</p>
            <p class="profile-work">Vice président</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Alexandre MARTIN</p>
            <p class="profile-work">Trésorier</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Dimitri VOLKOFF</p>
            <p class="profile-work">Secrétaire</p>
          </div>
        </li>
      </div>

      <div id="commerce" class="section-heading">Le Pôle Commercial</div>
      <div class="flex-section">
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Cenzo MOUSSAOUI</p>
            <p class="profile-work">Chef de pôle</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Axel PAULIN</p>
            <p class="profile-work">Commercial</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Jeanette KERVOAS</p>
            <p class="profile-work">Commercial</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Quentin DAMBLEMONT</p>
            <p class="profile-work">Commercial</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Matthieu LAMBERT</p>
            <p class="profile-work">Commercial</p>
          </div>
        </li>
      </div>
      <div id="comm" class="section-heading">Le Pôle Communication</div>
      <div class="flex-section">
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Laura GARBI</p>
            <p class="profile-work">Chef de pôle</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Lucile DIRAND</p>
            <p class="profile-work">Graphiste</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Thomas BARRAIS</p>
            <p class="profile-work">Developpeur web</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Thibault GODZINSKI</p>
            <p class="profile-work">Rédacteur</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Noémie GALMICHE</p>
            <p class="profile-work">Community Manager</p>
          </div>
        </li>
      </div>

      <div id="event" class="section-heading">Le Pôle Event</div>
      <div class="flex-section">
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Apolline MATHIOT</p>
            <p class="profile-work">Chef de pôle</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Feyten CHAA</p>
            <p class="profile-work">Respo cérémonie</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Batoul ALAMEDDINE</p>
            <p class="profile-work">Respo cérémonie</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Virgile MAILLART</p>
            <p class="profile-work">Respo entreprise partenaires</p>
          </div>
        </li>
        <li class="profile-card">
          <img src="./public/img/profile.jpg" alt="profil" class="profile-img">
          <ul class="side-social">
            <a href="#">
              <img src="./public/icon/linkedin.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/google.svg" alt="linkedin">
            </a>
            <a href="#">
              <img src="./public/icon/facebook.svg" alt="linkedin">
            </a>
          </ul>
          <div class="profile-info">
            <p class="profile-name">Ylane FITOUSSI</p>
            <p class="profile-work">Respo entreprise partenaires</p>
          </div>
        </li>
      </div>
    </ul>
  </div>
  <?php require_once 'include/footer.php' ?>
</body>

</html>