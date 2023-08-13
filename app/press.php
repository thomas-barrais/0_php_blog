<?php
require __DIR__ . '/database/database.php';

$authDB = require __DIR__ . '/database/security.php';
$currentUser = $authDB->isLoggedin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/295ed6ef9d.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700&family=Roboto:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="public/css/press.css">
  <link rel="stylesheet" href="./public/css/header-dark.css">
  <link rel="stylesheet" href="public/css/header-anim.css">
  <link rel="stylesheet" href="public/css/footer.css">
  <script src="./public/js/header.js"></script>
  <title>Press</title>
</head>

<body>
  <?php require_once 'include/header.php' ?>
  <div class="container">
    <h1 class="title">Nos Réalisations en Lumière</h1>
    <section class="showcase">
      <article>
        <img src="public/img/désigné-LMCF.jpg" alt="bloc-1" />
        <h3>Qui sera désigné Meilleur Chantier de France 2023 ?</h3>
        <p class="article-content">
          CONCOURS. Passion BTP, association formée par des étudiants de l'ESTP, a organisé pour la première fois en 2023 un concours
          pour trouver le Meilleur Chantier de France, en partenariat avec Batiactu.<br> Pour cette première édition, 11 projets étaient
          candidats. Le lauréat sera connu le 22 mai 2023. ls sont onze. Onze projets à prétendre au titre de Meilleur Chantier de France
          2023.<br> Ce concours, dont Batiactu est partenaire, a été lancé cette année par Passion BTP, association d'étudiants de l'ESTP
          en charge d'organiser tout au long de l'année universitaire les visites de chantier auxquelles assistent les futurs ingénieurs
          de l'école...
        </p>
        <a href="https://www.batiactu.com/edito/qui-sera-designe-meilleur-chantier-france-2023-66293.php" target="_blank" class="text-hint">
          Lire plus <i class="fa-solid fa-link"></i>
        </a>
        <p class="article-author">Batiactu</p>
        <p class="text-hint">
          17 Mai 2023 - 10 min read
        </p>
      </article>
      <article class="article-small">
        <img src="public/img/alumni.jpeg" alt="bloc-2" />
        <h3>Le meilleur chantier de France : carton plein pour les élèves de Passion BTP</h3>
        <p class="article-content">
          Lundi 22 mai a eu lieu la cérémonie de remise des prix du concours Le Meilleur Chantier de France, une belle initiative
          lancée par l'association de l'ESTP Passion BTP, dont l'objectif était clair : redonner aux élèves le goût des visites de
          chantier et donner une véritable envergure à leur association...
        </p>
        <a href="https://www.estp-alumni.org/news/le-meilleur-chantier-de-france-carton-plein-pour-les-eleves-de-passion-btp-337" target="_blank" class="text-hint">
          Lire plus <i class="fa-solid fa-link"></i>
        </a>
        <p class="article-author">Alumni ESTP</p>
        <p class="text-hint">
          01 Juin 2023 - 5 min read
        </p>
      </article>
      <article class="article-small">
        <img src="public/img/estp-lmcf.jpg" alt="bloc-3" />
        <h3>
          Remise des prix aux lauréats du concours « Le meilleur chantier de France »
        </h3>
        <p class="article-content">
          BRAVO À PASSION BTP POUR CETTE PREMIÈRE ÉDITION RÉUSSIE !<br> Le 22 mai dernier, s’est tenue au siège de la FNTP, en présence
          de son président Bruno Cavagné, la cérémonie de remise de prix du concours « Le meilleur chantier de France » imaginé et organisé
          par l’association étudiante ESTPienne PassionBTP.<br>
          Après la visite, durant plusieurs mois et dans toute la France, de 11 chantiers auscultés par un panel d’étudiants à travers
          différents critères environnementaux, humains ou encore de sécurité, Passion BTP a remis le trophée à Spie Batignolles pour
          son chantier du village des athlètes, tandis que la Sade arrivait en 2e position pour la réalisation du bassin d’Austerlitz.
          Un prix « révélation » a été attribué à la société Travaux publics des Pays de la Loire pour leur chantier de terrassement
          situé près de Seiches-sur-le-Loir.<br>
          La 1re édition du concours « Le Meilleur chantier de France » est une belle réussite dont peuvent se targuer les élèves de l’association PassionBTP, qui ont été soutenus dans ce projet inédit et ambitieux par l’école, l’association ESTP Alumni et des partenaires professionnels comme la FNTP, mais aussi batiactu.
        </p>
        <a href="https://twitter.com/estpparis/status/1580186984806768641" target="_blank" class="text-hint">
          Lire plus <i class="fa-solid fa-link"></i>
        </a>
        <p class="article-author">ESTP Paris</p>
        <p class="text-hint">
          12 Oct 2022 - 2 min read
        </p>
      </article>
      <article class="article-small">
        <img src="public/img/fntp.jpg" alt="bloc-4" />
        <h3><i class="fa-solid fa-quote-left"></i> J'ai été très heureux d'accompagner Passion BTP <i class="fa-solid fa-quote-right"></i></h3>
        <p class="article-author">Bruno Cavagné, FNTP</p>
      </article>
      <article>
        <img src="public/img/lauréat.jpg" alt="bloc-5" />
        <h3>Et le lauréat du concours du "Meilleur chantier de France" est...</h3>
        <p class="article-content">
          PALMARÈS. La cérémonie de remise des prix du "Meilleur chantier de France" s'est déroulée ce 22 mai 2023, à Paris.<br>
          Trois distinctions ont été remises. La première place a ainsi été décernée à Spie Batignolles pour son chantier du village
          des athlètes, la deuxième à la Sade pour la réalisation du bassin d'Austerlitz, à Paris. Enfin, un prix "révélation" a été
          remis à la société Travaux publics des Pays de la Loire (TPPL) pour son chantier de terrassement situé au sud de
          Seiches-sur-le-Loir.<br> Les lauréats ont été désignés sur la base de notes attribuées par un panel d'étudiants de l'ESTP...
        </p>
        <a href="https://www.batiactu.com/edito/et-meilleur-chantier-france-est-66316.php" target="_blank" class="text-hint">
          Lire plus <i class="fa-solid fa-link"></i>
        </a>
        <p class="article-author">Batiactu</p>
        <p class="text-hint">
          25 Mai 2023 - 2 min read
        </p>
      </article>
    </section>
  </div>
  <?php require_once 'include/footer.php' ?>
</body>

</html>