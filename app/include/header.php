<?php

$currentUser = $currentUser ?? false;

?>

<header>
  <a href="/" class="brand slide-link">
    <span>Passion BTP</span>
    <span>Passion BTP</span>
  </a>

  <div class="menu-btn">

  </div>

  <div class="navigation">
    <div class="navigation-items">
      <a href="/">Acceuil</a>
      <a href="../articles.php">Les visites</a>
      <a href="../team.php">L'équipe</a>
      <a href="../press.php">Presse</a>
      <a href="../partners.php">Partenaires</a>
      <a href="#Contact">Contact</a>
      <div style="margin-bottom:0.8rem;"></div>
      <?php if ($currentUser) : ?>
        <a href="../profile.php">Mon Espace</a>
        <a href="../form-article.php">Ecrire un article</a>
        <a href="../auth-logout.php">Déconnexion</a>
      <?php else : ?>
        <a href="../auth-login.php">Connexion</a>
        <a href="../auth-register.php">Inscription</a>
      <?php endif; ?>
    </div>
  </div>
</header>