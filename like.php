<?php
// Connexion à la base de données (vous devrez ajuster les informations de connexion)
$servername = "localhost";
$username = "root";
$password = 'Siphhplq698LV$Kh@ehdbjud!';
$dbname = "blog";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Connexion à la base de données ...

if (isset($_POST['post_id']) && isset($_POST['user_id'])) {
  $postId = $_POST['post_id'];
  $userId = $_POST['user_id'];

  // Vérifier si l'utilisateur a déjà aimé cet article
  $checkLikeQuery = "SELECT * FROM likes WHERE user_id = ? AND article_id = ?";
  $stmt = $conn->prepare($checkLikeQuery);
  $stmt->bind_param("ii", $userId, $postId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // L'utilisateur a déjà aimé, donc supprimer le like
    $deleteLikeQuery = "DELETE FROM likes WHERE user_id = ? AND article_id = ?";
    $stmt = $conn->prepare($deleteLikeQuery);
    $stmt->bind_param("ii", $userId, $postId);
    if ($stmt->execute()) {
      // Réduire le compteur de likes dans la table articles
      $updateArticleQuery = "UPDATE article SET likes_count = likes_count - 1 WHERE id = ?";
      $stmt = $conn->prepare($updateArticleQuery);
      $stmt->bind_param("i", $postId);
      $stmt->execute();
    }
  } else {
    // L'utilisateur n'a pas encore aimé, donc ajouter le like
    $insertLikeQuery = "INSERT INTO likes (user_id, article_id) VALUES (?, ?)";
    $stmt = $conn->prepare($insertLikeQuery);
    $stmt->bind_param("ii", $userId, $postId);
    if ($stmt->execute()) {
      // Augmenter le compteur de likes dans la table articles
      $updateArticleQuery = "UPDATE article SET likes_count = likes_count + 1 WHERE id = ?";
      $stmt = $conn->prepare($updateArticleQuery);
      $stmt->bind_param("i", $postId);
      $stmt->execute();
    }
  }

  // Récupérer le nouveau nombre de likes après mise à jour
  $newLikeCountQuery = "SELECT COUNT(*) as likes_count FROM likes WHERE article_id = ?";
  $stmt = $conn->prepare($newLikeCountQuery);
  $stmt->bind_param("i", $postId);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $newLikeCount = $row['likes_count'];

  // Vérifier l'état du like pour l'utilisateur actuel
  $checkUserLikeQuery = "SELECT * FROM likes WHERE user_id = ? AND article_id = ?";
  $stmt = $conn->prepare($checkUserLikeQuery);
  $stmt->bind_param("ii", $userId, $postId);
  $stmt->execute();
  $userLikeResult = $stmt->get_result();

  if ($userLikeResult->num_rows > 0) {
    $userLikeStatus = 'liked';
  } else {
    $userLikeStatus = 'not_liked';
  }

  // Créer une réponse JSON avec le nombre total de likes et l'état du like de l'utilisateur
  $response = array(
    'likes_count' => $newLikeCount,
    'user_like_status' => $userLikeStatus
  );

  echo json_encode($response);
}

$conn->close();
