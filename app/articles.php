<?php
require __DIR__ . '/database/database.php';

$authDB = require __DIR__ . '/database/security.php';
$currentUser = $authDB->isLoggedin();
$articleDB = require_once './database/models/articleDB.php';

$targetUserID = 16;
$articles = $articleDB->fetchAll();
$categories = [];
$selectedCat = '';

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$selectedCat = $_GET['cat'] ?? '';

if (count($articles)) {
  $cattmp = array_map(fn ($a) => $a['category'], $articles);
  $categories = array_reduce($cattmp, function ($acc, $cat) {
    if (isset($acc[$cat])) {
      $acc[$cat]++;
    } else {
      $acc[$cat] = 1;
    }
    return $acc;
  }, []);
  foreach ($articles as $article) {
    if ($article['author'] === $targetUserID) {
      $categories[$article['category']]--;
    }
  }
  $arcticlePerCategories = array_reduce($articles, function ($acc, $article) {
    if (isset($acc[$article['category']])) {
      $acc[$article['category']] = [...$acc[$article['category']], $article];
    } else {
      $acc[$article['category']] = [$article];
    }
    return $acc;
  }, []);
}

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
  <link rel="stylesheet" href="./public/css/articles.css">
  <link rel="stylesheet" href="./public/css/header-dark.css">
  <link rel="stylesheet" href="public/css/header-anim.css">
  <link rel="stylesheet" href="public/css/footer.css">
  <script src="./public/js/header.js"></script>
  <title>Blog</title>
</head>

<body>
  <?php require_once 'include/header.php' ?>
  <section id="blog">
    <ul class="blog-heading">
      <h3 class="my_b">Blog</h3>
      <div class="flex">
        <li class=<?= $selectedCat ? '' : 'cat-active' ?>><a href="/articles.php"><span class="mx">Tous les articles (<?= count($articles) ?>)</span></a></li>
        <?php foreach ($categories as $catName => $catNum) : ?>
          <li class=<?= $selectedCat === $catName ? 'cat-active' : '' ?>><a href="/articles.php?cat=<?= $catName ?>"><span class="mx"> <?= $catName ?> (<?= $catNum ?>)</span></a></li>
        <?php endforeach; ?>
      </div>
    </ul>
    <div class="blog-container">
      <?php if (!$selectedCat) : ?>
        <?php foreach (array_reverse($articles) as $a) : ?>
          <div class="blog-box">
            <div class="blog-img">
              <img src="<?= $a['image'] ?>" alt="">
            </div>
            <div class="blog-text">
              <span><?= $a['firstname'] . ' ' . $a['lastname'] ?></span>
              <a href="/show-article.php?id=<?= $a['id'] ?>" class="blog-title"><?= $a['title'] ?></a>
              <p><?= $a['content'] ?></p>
              <a href="/show-article.php?id=<?= $a['id'] ?>">Read More</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <?php foreach (array_reverse($arcticlePerCategories[$selectedCat]) as $a) : ?>
          <?php if ($a['author'] !== $targetUserID) : ?>
            <div class="blog-box">
              <div class="blog-img">
                <img src="<?= $a['image'] ?>" alt="">
              </div>
              <div class="blog-text">
                <span><?= $a['firstname'] . ' ' . $a['lastname'] ?></span>
                <a href="/show-article.php?id=<?= $a['id'] ?>" class="blog-title"><?= $a['title'] ?></a>
                <p><?= $a['content'] ?></p>
                <a href="/show-article.php?id=<?= $a['id'] ?>">Read More</a>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </section>
  <?php require_once 'include/footer.php' ?>
</body>

</html>