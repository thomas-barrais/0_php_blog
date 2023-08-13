<?php
require_once __DIR__ . '/database/database.php';
$authDB = require_once __DIR__ . '/database/security.php';

$currentUser = $authDB->isLoggedin();

$articleDB = require_once './database/models/articleDB.php';

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if (!$id) {
  header('Location: /');
  exit();
}

$article = $articleDB->fetchOne($id);
$errors = [
  'content' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $currentUser) {

  $articleId = $_POST['article_id'] ?? '';
  $content = $_POST['content'] ?? '';

  $comment = [
    'article_id' => $articleId,
    'content' => $content,
    'author_id' => $currentUser['id']
  ];

  if (empty($content)) {
    $errors['content'] = "Veuillez renseigner ce champ";
  } else {
    $createdComment = $articleDB->createComment($comment);
    header('Location: /show-article.php?id=' . $articleId);
    exit();
  }
}

$comments = $articleDB->fetchComments($article['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700&family=Roboto:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./public/css/header-dark.css">
  <link rel="stylesheet" href="public/css/header-anim.css">
  <link rel="stylesheet" href="public/css/footer.css">
  <script src="https://kit.fontawesome.com/83f4286022.js" crossorigin="anonymous"></script>
  <script src="./public/js/header.js"></script>
  <link rel="stylesheet" href="/public/css/show-article.css">
  <title>Article</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://platform.linkedin.com/in.js" type="text/javascript" data-onLoad="onLinkedInLoad" data-apiKey="78jkva05fpg8ak"></script>
</head>

<body>
  <?php require_once 'include/header.php' ?>
  <div class="content">
    <div class="article-container">
      <a class="article-back" href="/articles.php">Retour à la liste des articles</a>
      <div class="article-cover-image" style="background-image:url(<?= $article['image'] ?>)"></div>
      <h1 class=article-title><?= $article['title'] ?></h1>
      <div class="separator"></div>
      <p class="article-content"><?= $article['content'] ?></p>
      <p class=article-author><?= $article['firstname'] . ' ' . $article['lastname'] ?></p>
      <?php if ($currentUser) : ?>
        <i class="fas fa-star like-btn" data-postid="<?= $article['id']; ?>"></i>
      <?php else : ?>
        <i class="fas fa-star"></i>
      <?php endif; ?>
      <span class="like-count"><?= $article['likes_count']; ?></span>
      <?php if ($currentUser && $currentUser['id'] === $article['author']) : ?>
        <script type="IN/Share" data-url="http://localhost:3000/show-article.php?id=<?= $article['id'] ?>"></script>
        <div class="action">
          <a class="btn btn-secondary" href="/delete-article.php?id=<?= $article['id'] ?>">Supprimer</a>
          <a class="btn btn-primary" href="/form-article.php?id=<?= $article['id'] ?>">Editer l'article</a>
        </div>
      <?php endif; ?>
      <?php if ($currentUser) : ?>
        <form class="comment-control" method="POST" action="/show-article.php<?= $id ? "?id=$id" : '' ?>">
          <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
          <textarea name="content" placeholder="Votre commentaire"></textarea>
          <?php if ($errors['content'] && isset($_POST['content'])) : ?>
            <p class="text-error"><?= $errors['content'] ?></p>
          <?php endif; ?>
          <button type="submit">Poster</button>
        </form>
      <?php endif; ?>
      <h2>Commentaires</h2>
      <?php foreach ($comments as $comment) : ?>
        <div class="comment" id="comment-<?php echo $comment['id']; ?>">
          <p class="comment-content"><?php echo $comment['content']; ?></p>
          <p class="comment-author"><?php echo $comment['firstname'] . ' ' . $comment['lastname']; ?></p>
          <?php
          $commentDate = new DateTime($comment['comment_date']);
          ?>
          <p class="comment-date">
            <?php echo $commentDate->format('d/m/Y'); ?>
          </p>
          <?php if ($currentUser && $currentUser['id'] === $comment['author_id']) : ?>
            <a class="btn-delete" href="/delete-comment.php<?= isset($comment['id']) ? "?id=" . $comment['id'] : '' ?>">Supprimer</a>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php require_once 'include/footer.php' ?>
  <script>
    $(document).ready(function() {
      // Récupérer l'identifiant de session utilisateur
      var sessionId = <?php echo $currentUser ? $currentUser['id'] : 'null'; ?>;

      // Vérifier les cookies existants pour déterminer l'état du like au chargement de la page
      $('.like-btn').each(function() {
        var postId = $(this).data('postid');
        if (document.cookie.indexOf("liked_article_" + postId + "_" + sessionId + "=true") !== -1) {
          $(this).addClass('gold');
        }
      });

      $('.like-btn').on('click', function() {
        var postId = $(this).data('postid');
        var likeCount = $(this).siblings('.like-count');
        var icon = $(this);

        var userId = <?php echo $currentUser ? $currentUser['id'] : 'null'; ?>;

        $.ajax({
          type: 'POST',
          url: 'like.php',
          data: {
            post_id: postId,
            user_id: userId
          },
          success: function(response) {
            var responseData = JSON.parse(response);
            likeCount.text(responseData.likes_count);
            if (responseData.user_like_status === 'liked') {
              icon.addClass('gold');
              // Ajouter un cookie pour indiquer que l'utilisateur a aimé cet article
              document.cookie = "liked_article_" + postId + "_" + sessionId + "=true; expires=Thu, 01 Jan 2099 00:00:00 UTC; path=/";
            } else {
              icon.removeClass('gold');
              // Supprimer le cookie si l'utilisateur n'aime plus l'article
              document.cookie = "liked_article_" + postId + "_" + sessionId + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            }
          }
        });
      });
    });
  </script>



</body>

</html>