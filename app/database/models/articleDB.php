<?php

class ArticleDB
{
  private PDOstatement $statementCreateOne;
  private PDOstatement $statementUpdateOne;
  private PDOstatement $statementDeleteOne;
  private PDOstatement $statementReadOne;
  private PDOstatement $statementReadAll;
  private PDOStatement $statementReadUserAll;
  private PDOStatement $statementCreateComment;
  private PDOStatement $statementReadComments;
  private PDOStatement $statementReadOneComment;
  private PDOStatement $statementDeleteOneComment;

  function __construct(private PDO $pdo)
  {
    $this->statementCreateOne = $pdo->prepare('
    INSERT INTO article (
      title,
      category,
      content,
      image,
      author
    ) VALUES (
      :title,
      :category,
      :content,
      :image,
      :author
    )
    ');

    $this->statementUpdateOne = $pdo->prepare('
      UPDATE article
      SET
        title=:title,
        category=:category,
        content=:content,
        image=:image,
        author=:author
      WHERE id=:id
    ');

    $this->statementReadOne = $pdo->prepare('SELECT article.*, user.firstname, user.lastname FROM article LEFT JOIN user ON article.author = user.id WHERE article.id=:id');
    $this->statementReadAll = $pdo->prepare('SELECT article.*, user.firstname, user.lastname FROM article LEFT JOIN user ON article.author = user.id');
    $this->statementDeleteOne = $pdo->prepare('DELETE FROM article WHERE id=:id');
    $this->statementReadUserAll = $pdo->prepare('SELECT * FROM article WHERE author=:authorId');

    $this->statementCreateComment = $pdo->prepare('
    INSERT INTO comments (
      article_id, 
      content, 
      author_id, 
      created_at
    ) VALUES (
      :article_id,
      :content,
      :author_id,
      :created_at
    )
    ');

    $this->statementReadComments = $pdo->prepare('
      SELECT comments.*, DATE(comments.created_at) AS comment_date, user.firstname, user.lastname
      FROM comments
      LEFT JOIN user ON comments.author_id = user.id
      WHERE comments.article_id = :article_id
      ORDER BY comments.created_at DESC
    ');

    $this->statementReadOneComment = $pdo->prepare('
    SELECT comments.*, user.firstname, user.lastname
    FROM comments
    LEFT JOIN user ON comments.author_id = user.id
    WHERE comments.id=:id
  ');

    $this->statementDeleteOneComment = $pdo->prepare('DELETE FROM comments WHERE id=:id');
  }

  public function deleteComment(string $id): string
  {
    $this->statementDeleteOneComment->bindValue(':id', $id);
    $this->statementDeleteOneComment->execute();
    return $id;
  }

  public function createComment($comment): array
  {
    $this->statementCreateComment->bindValue(':article_id', $comment['article_id']);
    $this->statementCreateComment->bindValue(':content', $comment['content']);
    $this->statementCreateComment->bindValue(':author_id', $comment['author_id']);
    $this->statementCreateComment->bindValue(':created_at', date('Y-m-d H:i:s'));
    $this->statementCreateComment->execute();
    return $this->fetchOneComment($this->pdo->lastInsertId());
  }


  public function fetchComments(int $articleId): array
  {
    $this->statementReadComments->bindValue(':article_id', $articleId);
    $this->statementReadComments->execute();
    return $this->statementReadComments->fetchAll();
  }

  public function fetchOneComment(int $id): array
  {
    $this->statementReadOneComment->bindValue(':id', $id);
    $this->statementReadOneComment->execute();
    return $this->statementReadOneComment->fetch();
  }

  public function fetchAll(): array
  {
    $this->statementReadAll->execute();
    return $this->statementReadAll->fetchAll();
  }

  public function fetchOne(int $id): array
  {
    $this->statementReadOne->bindValue(':id', $id);
    $this->statementReadOne->execute();
    return $this->statementReadOne->fetch();
  }

  public function deleteOne(string $id): string
  {
    // Supprimer les commentaires associés à l'article
    $this->deleteCommentsByArticleId($id);
    $this->deleteLikesByArticleId($id);

    // Supprimer l'article
    $this->statementDeleteOne->bindValue(':id', $id);
    $this->statementDeleteOne->execute();
    return $id;
  }

  private function deleteCommentsByArticleId(string $articleId)
  {
    $comments = $this->fetchComments($articleId);
    foreach ($comments as $comment) {
      $this->deleteComment($comment['id']);
    }
  }
  private function deleteLikesByArticleId(string $articleId)
  {
    // Supprime les likes associés à l'article
    $sql = 'DELETE FROM likes WHERE article_id = :article_id';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':article_id', $articleId);
    $stmt->execute();
  }


  public function createOne($article): array
  {
    $this->statementCreateOne->bindValue(':title', $article['title']);
    $this->statementCreateOne->bindValue(':category', $article['category']);
    $this->statementCreateOne->bindValue(':image', $article['image']);
    $this->statementCreateOne->bindValue(':content', $article['content']);
    $this->statementCreateOne->bindValue(':author', $article['author']);
    $this->statementCreateOne->execute();
    return $this->fetchOne($this->pdo->lastInsertId());
  }

  public function updateOne($article): array
  {
    $this->statementUpdateOne->bindValue(':title', $article['title']);
    $this->statementUpdateOne->bindValue(':category', $article['category']);
    $this->statementUpdateOne->bindValue(':image', $article['image']);
    $this->statementUpdateOne->bindValue(':content', $article['content']);
    $this->statementUpdateOne->bindValue(':id', $article['id']);
    $this->statementUpdateOne->bindValue(':author', $article['author']);
    $this->statementUpdateOne->execute();
    return $article;
  }

  public function fetchUserArticle(string $authorId): array
  {
    $this->statementReadUserAll->bindValue(':authorId', $authorId);
    $this->statementReadUserAll->execute();
    return $this->statementReadUserAll->fetchAll();
  }

  public function fetchRecentByCategory(string $category, int $limit): array
  {
    $sql = 'SELECT article.*, user.firstname, user.lastname
            FROM article
            LEFT JOIN user ON article.author = user.id
            WHERE article.category = :category
            ORDER BY id DESC
            LIMIT :limit';

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':category', $category);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
  }
}

return new ArticleDB($pdo);
