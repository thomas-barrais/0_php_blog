<?php
require_once 'database/database.php';
$authDB = require_once 'database/security.php';

$currentUser = $authDB->isLoggedin();

$articleDB = require_once 'database/models/articleDB.php';

$commentId = $_GET['id'] ?? '';

if (!$commentId) {
  header('Location: /');
  exit();
}

$comment = $articleDB->fetchOneComment($commentId);

if (!$comment) {
  header('Location: /');
  exit();
}

if ($currentUser && $currentUser['id'] === $comment['author_id']) {
  $articleDB->deleteComment($commentId);
}

header("Location: /show-article.php?id={$comment['article_id']}");
exit();
