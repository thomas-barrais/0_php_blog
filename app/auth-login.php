<?php
require_once './database/database.php';
$authDB = require_once './database/security.php';

const ERROR_REQUIRED = "Veuillez renseigner ce champ";
const ERROR_PASSWORD_TOO_SHORT = "Le mot de passe doit faire au moins 6 caractères";
const ERROR_PASSWORD_MISSMATCH = "Le mot de passe n'est pas valide";
const ERROR_EMAIL_INVALID = "L'email n'est pas valide";
const ERROR_EMAIL_UNKNOWN = "L'email n'est pas enregistrée";

$errors = [
  'email' => '',
  'password' => '',
];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $input = filter_input_array(INPUT_POST, [
    'email' => FILTER_SANITIZE_EMAIL
  ]);

  $email = $input['email'] ?? '';
  $password = $_POST['password'] ?? '';

  if (!$email) {
    $errors['email'] = ERROR_REQUIRED;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = ERROR_EMAIL_INVALID;
  }

  if (!$password) {
    $errors['password'] = ERROR_REQUIRED;
  } elseif (mb_strlen($password) < 6) {
    $errors['password'] = ERROR_PASSWORD_TOO_SHORT;
  }

  if (!count(array_filter($errors, fn ($e) => $e !== ''))) {

    $user = $authDB->getUserFromEmail($email);

    if (!$user) {
      $errors['email'] = ERROR_EMAIL_UNKNOWN;
    } else {
      if (!password_verify($password, $user['password'])) {
        $errors['password'] = ERROR_PASSWORD_MISSMATCH;
      } else {
        $authDB->login($user['id']);
        header('Location: /articles.php');
      }
    }
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
  <link rel="stylesheet" href="./public/css/articles.css">
  <link rel="stylesheet" href="./public/css/header-dark.css">
  <link rel="stylesheet" href="public/css/header-anim.css">
  <link rel="stylesheet" href="public/css/footer.css">
  <script src="./public/js/header.js"></script>
  <link rel="stylesheet" href="/public/css/auth-register.css">
  <title>Connexion</title>
</head>

<body>
  <?php require_once 'include/header.php' ?>
  <div class="container">
    <div class="content">
      <div class="block p-20 form-container">
        <h1>Connexion</h1>
        <form action="/auth-login.php" , method="POST">
          <div class="form-control">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= $email ?? '' ?>">
            <?php if ($errors['email']) : ?>
              <p class="text-error"><?= $errors['email'] ?></p>
            <?php endif; ?>
          </div>
          <div class="form-control">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
            <?php if ($errors['password']) : ?>
              <p class="text-error"><?= $errors['password'] ?></p>
            <?php endif; ?>
          </div>
          <div class="form-action">
            <a href="/articles.php" class="btn btn-secondary" type="button">Annuler</a>
            <button class="btn btn-primary" type="submit">Connexion</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php require_once 'include/footer.php' ?>
</body>

</html>