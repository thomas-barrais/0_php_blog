<?php
require_once __DIR__ . '/database/database.php';
$authDB = require_once __DIR__ . '/database/security.php';

$currentUser = $authDB->isLoggedin();
if (!$currentUser) {
  header('Location: /');
}
$articleDB = require_once './database/models/articleDB.php';

const ERROR_REQUIRED = "Veuillez renseigner ce champ";
const ERROR_TITLE_TOO_SHORT = "Le titre est trop court";
const ERROR_CONTENT_TOO_SHORT = "L'article est trop court";
const ERROR_IMAGE_SIZE = "L'image est trop volumineuse";
const ERROR_IMAGE_FORMAT  = "Le format d'image n'est pas bon";

$errors = [
  'title' => '',
  'image' => '',
  'category' => '',
  'content' => ''
];
$category = '';

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';
if ($id) {

  $article = $articleDB->fetchOne($id);
  if ($article['author'] !== $currentUser['id']) {
    header('Location: /');
  }

  $title = $article['title'];
  $category = $article['category'];
  $content = $article['content'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_POST = filter_input_array(INPUT_POST, [
    'title' => FILTER_SANITIZE_SPECIAL_CHARS,
    'category' => FILTER_SANITIZE_SPECIAL_CHARS,
    'content' => [
      'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
      'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
    ]
  ]);
  $title = $_POST['title'] ?? '';
  $category = $_POST['category'] ?? '';
  $content = $_POST['content'] ?? '';

  if (!$title) {
    $errors['title'] = ERROR_REQUIRED;
  } elseif (mb_strlen($title) < 5) {
    $errors['title'] = ERROR_TITLE_TOO_SHORT;
  }

  $maxSize = 500000;
  $validExt = array('.jpg', '.png', '.jpeg', '.gif');
  $fileExt = "." . strtolower(substr(strchr($_FILES['image']['name'], "."), 1));

  $fileSize = $_FILES['image']['size'];
  if ($fileSize > $maxSize) {
    $errors['image'] = ERROR_IMAGE_SIZE;
  }

  if (!in_array($fileExt, $validExt)) {
    $errors['image'] = ERROR_IMAGE_FORMAT;
  }

  $tmpName = $_FILES['image']['tmp_name'];
  $uniqueName = md5(uniqid(rand(), true));
  $fileName = "upload/" . $uniqueName . $fileExt;
  $res = move_uploaded_file($tmpName, $fileName);

  if (!$category) {
    $errors['category'] = ERROR_REQUIRED;
  }

  if (!$content) {
    $errors['content'] = ERROR_REQUIRED;
  } elseif (mb_strlen($content) < 50) {
    $errors['content'] = ERROR_CONTENT_TOO_SHORT;
  }

  if (!count(array_filter($errors, fn ($e) => $e !== ''))) {
    if ($id) {
      $article['title'] = $title;
      $article['image'] = $fileName;
      $article['category'] = $category;
      $article['content'] = $content;
      $article['author'] = $currentUser['id'];
      $articleDB->updateOne($article);
    } else {
      $articleDB->createOne([
        'title' => $title,
        'content' => $content,
        'image' => $fileName,
        'category' => $category,
        'author' => $currentUser['id']
      ]);
    }
    header('Location: /');
  }
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
  <link rel="stylesheet" href="./public/css/header-dark.css">
  <link rel="stylesheet" href="public/css/header-anim.css">
  <link rel="stylesheet" href="public/css/footer.css">
  <script src="./public/js/header.js"></script>
  <link rel="stylesheet" href="/public/css/auth-register.css">
  <title><?= $id ? 'Editer' : 'Créer' ?> un article</title>
</head>

<body>
  <?php require_once 'include/header.php' ?>
  <div class="container">
    <div class="content">
      <div class="block p-20 form-container">
        <h1><?= $id ? "Editer" : 'Ecrire' ?> un article</h1>
        <form action="/form-article.php<?= $id ? "?id=$id" : '' ?>" , method="POST" enctype="multipart/form-data">
          <div class="form-control">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" value="<?= $title ?? '' ?>" placeholder="Nom du chantier et de l'entreprise">
            <?php if ($errors['title']) : ?>
              <p class="text-error"><?= $errors['title'] ?></p>
            <?php endif; ?>
          </div>
          <div class="form-control">
            <label for="image">Image</label>
            <input type="file" name="image" enctype="multipart/form-data" id="image" value="<?= $image ?? '' ?>">
            <?php if ($errors['image']) : ?>
              <p class="text-error"><?= $errors['image'] ?></p>
            <?php endif; ?>
          </div>
          <div class="form-control">
            <label for="category">Catégorie</label>
            <select name="category" id="category">
              <option <?= !$category || $category === 'entreprise' ? 'selected' : 'entreprise' ?> value="entreprise">Présentation d'une visite de chantier</option>
              <option <?= $category === 'eleve' ? 'selected' : '' ?> value="eleve">Participation a une visite de chantier</option>
            </select>
            <?php if ($errors['category']) : ?>
              <p class="text-error"><?= $errors['category'] ?></p>
            <?php endif; ?>
          </div>
          <div class="form-control">
            <label for="content">Content</label>
            <textarea name="content" id="content"><?= $content ?? '' ?></textarea>
            <?php if ($errors['content']) : ?>
              <p class="text-error"><?= $errors['content'] ?></p>
            <?php endif; ?>
          </div>
          <div class="form-action">
            <a href="/articles.php" class="btn btn-secondary" type="button">Annuler</a>
            <button class="btn btn-primary" type="submit"><?= $id ? 'Modifier' : 'Sauvegarder' ?></button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php require_once 'include/footer.php' ?>
  <script src="public/js/form-article.js"></script>
</body>

</html>