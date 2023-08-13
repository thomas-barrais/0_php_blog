<?php
$pdo = require_once './database/database.php';
$authDB = require_once './database/security.php';

const ERROR_REQUIRED = 'Veuillez renseigner ce champ';
const ERROR_TOO_SHORT = 'Ce champ est trop court';
const ERROR_PASSWORD_TOO_SHORT = 'Le mot de passe doit faire au moins 6 caractères';
const ERROR_PASSWORD_MISMATCH = 'Le mot de passe de confirmation est différent';
const ERROR_EMAIL_INVALID = 'L\'email n\'est pas valide';
$errors = [
  'category' => '',
  'firstname' => '',
  'lastname' => '',
  'email' => '',
  'password' => '',
  'confirmpassword' => ''
];
$category = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $input = filter_input_array(INPUT_POST, [
    'category' => FILTER_SANITIZE_SPECIAL_CHARS,
    'firstname' => FILTER_SANITIZE_SPECIAL_CHARS,
    'lastname' => FILTER_SANITIZE_SPECIAL_CHARS,
    'email' => FILTER_SANITIZE_EMAIL,
  ]);
  $category = $input['category'] ?? '';
  $firstname = $input['firstname'] ?? '';
  $lastname = $input['lastname'] ?? '';
  $email = $input['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $confirmpassword = $_POST['confirmpassword'] ?? '';

  if (!$category) {
    $errors['category'] = ERROR_REQUIRED;
  }
  if (!$firstname) {
    $errors['firstname'] = ERROR_REQUIRED;
  } elseif (mb_strlen($firstname) < 2) {
    $errors['firstname'] = ERROR_TOO_SHORT;
  }
  if (!$lastname) {
    $errors['lastname'] = ERROR_REQUIRED;
  } elseif (mb_strlen($lastname) < 2) {
    $errors['lastname'] = ERROR_TOO_SHORT;
  }
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
  if (!$confirmpassword) {
    $errors['confirmpassword'] = ERROR_REQUIRED;
  } elseif ($confirmpassword !== $password) {
    $errors['confirmpassword'] = ERROR_PASSWORD_MISMATCH;
  }

  if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
    $authDB->register([
      'category' => $category,
      'firstname' => $firstname,
      'lastname' => $lastname,
      'email' => $email,
      'password' => $password
    ]);
    header('Location: /auth-login.php');
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
  <title>Inscription</title>
</head>

<body>
  <?php require_once 'include/header.php' ?>
  <div class="container">
    <div class="content">
      <div class="block p-20 form-container">
        <h1>Inscription</h1>
        <form action="auth-register.php" , method="POST">
          <div class="form-control">
            <label for="category">Vous êtes</label>
            <select name="category" id="category">
              <option <?= !$category || $category === 'entreprise' ? 'selected' : 'entreprise' ?> value="entreprise">Une entreprise</option>
              <option <?= $category === 'eleve' ? 'selected' : '' ?> value="eleve">Un élève</option>
            </select>
            <?php if ($errors['category']) : ?>
              <p class="text-error"><?= $errors['category'] ?></p>
            <?php endif; ?>
          </div>
          <div class="form-control">
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" value="<?= $firstname ?? '' ?>">
            <?php if ($errors['firstname']) : ?>
              <p class="text-error"><?= $errors['firstname'] ?></p>
            <?php endif; ?>
          </div>
          <div class="form-control">
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" value="<?= $lastname ?? '' ?>">
            <?php if ($errors['lastname']) : ?>
              <p class="text-error"><?= $errors['lastname'] ?></p>
            <?php endif; ?>
          </div>
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
          <div class="form-control">
            <label for="confirmpassword">Confirmation du mot de passe</label>
            <input type="password" name="confirmpassword" id="confirmpassword">
            <?php if ($errors['confirmpassword']) : ?>
              <p class="text-error"><?= $errors['confirmpassword'] ?></p>
            <?php endif; ?>
          </div>
          <div class="form-action">
            <a href="/articles.php" class="btn btn-secondary" type="button">Annuler</a>
            <button class="btn btn-primary" type="submit">Valider</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php require_once 'include/footer.php' ?>
</body>

</html>