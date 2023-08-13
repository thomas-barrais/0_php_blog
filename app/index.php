<?php
require __DIR__ . '/database/database.php';

$authDB = require __DIR__ . '/database/security.php';
$currentUser = $authDB->isLoggedin();
$articleDB = require_once './database/models/articleDB.php';

$articles = $articleDB->fetchAll();
$categories = [];

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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
}

$recentEnterpriseArticles = $articleDB->fetchRecentByCategory('entreprise', 4);

$targetUserID = 16;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once 'include/head.php' ?>
  <script src="https://kit.fontawesome.com/83f4286022.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond|Staatliches&display=swap" rel="stylesheet" />
  <script src="public/js/slider.js" async></script>
  <script src="public/js/overlay_slider.js"></script>
  <link rel="stylesheet" href="./public/css/slider.css">
  <title>Blog</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <?php require_once 'include/header.php' ?>

  <section class="home">

    <video class="video-slide active" src="public/video/presentation.mp4" autoplay muted loop></video>
    <video class="video-slide" src="public/video/visite.mov" autoplay muted loop></video>
    <video class="video-slide" src="public/video/lmcf.mov" autoplay muted loop></video>
    <video class="video-slide" src="public/video/ceremonie.mov" autoplay muted loop></video>
    <video class="video-slide" src="public/video/ecologie.mov" autoplay muted loop></video>

    <div class="content active">
      <h1>Passion<br><span>BTP ESTP</span></h1>
      <p>
        Passion BTP est une association étudiante de l'ESTP Paris organisatrice d'événements professionnalisants destinés aux futurs diplômés de l'école.<br><br>
        Au-delà d'un enrichissement de la vie étudiante Estpienne, nos événements permettent aux entreprises de se faire connaître et de démonter leur expertise. De plus, l'association permet aux étudiants de rencontrer des professionnels du secteur et d'accroître leurs connaissances du BTP.<br><br>
      </p>
    </div>
    <div class="content">
      <h1>Visite de<br><span>chantier</span></h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed quibusdam ipsum minus in doloremque debitis modi iste ab dolorem recusandae?</p>
    </div>
    <div class="content">
      <h1>Le meilleur chantier<br><span>de france</span></h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed quibusdam ipsum minus in doloremque debitis modi iste ab dolorem recusandae?</p>
    </div>
    <div class="content">
      <h1>Notre<br><span>Cérémonie</span></h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed quibusdam ipsum minus in doloremque debitis modi iste ab dolorem recusandae?</p>
    </div>
    <div class="content">
      <h1>Nos<br><span>Valeurs</span></h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed quibusdam ipsum minus in doloremque debitis modi iste ab dolorem recusandae?</p>
    </div>
    <div class="slider-navigation">
      <div class="nav-btn active"></div>
      <div class="nav-btn"></div>
      <div class="nav-btn"></div>
      <div class="nav-btn"></div>
      <div class="nav-btn"></div>
    </div>
  </section>

  <section class="main-article-container">
    <div class="main-article">
      <h2>La prochaine visite de chantier</h2>
      <?php
      $firstArticleDisplayed = false;

      foreach (array_reverse($articles) as $article) :
        if ($article['author'] === $targetUserID && !$firstArticleDisplayed) {
          $firstArticleDisplayed = true;
      ?>
          <article>
            <img src="<?= $article['image']; ?>" alt="bloc-6" />
            <h3><?= $article['title']; ?></h3>
            <p><?= $article['content']; ?></p>
            <p><?= ucfirst($article['lastname']) . ' ' . ucfirst($article['firstname']) ?></p>
            <p class="text-hint">
              Oct 26
              <?php if ($currentUser) : ?>
                <i class="fas fa-star like-btn" data-postid="<?= $article['id']; ?>"></i>
              <?php else : ?>
                <i class="fas fa-star"></i>
              <?php endif; ?>
              <span class="like-count"><?= $article['likes_count']; ?></span>
            </p>
          </article>
      <?php
        }
      endforeach; ?>
    </div>
  </section>

  <div class="overlay" id="cardOverlay">
    <div class="profile-card-overlay">
      <div class="profile-img-container">
        <img src="" alt="Profile" class="profile-img-full" id="fullProfileImg">
      </div>
      <div class="profile-info-full" id="fullProfileInfo"></div>
      <span class="close-btn" id="closeBtn">&times;</span>
    </div>
  </div>

  <div class="slider-container">
    <div class="title">Les participants au meilleur chantier de France</div>
    <div id="carousel">
      <?php
      foreach (array_reverse($articles) as $article) {
        if ($article['author'] === $targetUserID && $article['category'] === 'eleve') {
      ?>
          <div class="item">
            <div class="item__image">
              <img src="<?= $article['image']; ?>" alt="article">
            </div>
            <div class="item__body">
              <div class="item__title"><?= $article['title']; ?></div>
              <div class="item__description"><?= $article['content'] ?></div>
              <div class="item__button">Voir plus</div>
            </div>
          </div>
      <?php
        }
      }
      ?>
    </div>
  </div>

  <div class="recent-title">Les lauréats 2022 - 2023</div>
  <div class="recent-container">
    <div class="item">
      <div class="item__image">
        <img src="public/img/concours-sade.jpeg" alt="">
      </div>
      <div class="item__body">
        <div class="recent-item__title">
          <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48">
            <path d="M298-120v-60h152v-148q-54-11-96-46.5T296-463q-74-8-125-60t-51-125v-44q0-25 17.5-42.5T180-752h104v-88h392v88h104q25 0 42.5 17.5T840-692v44q0 73-51 125t-125 60q-16 53-58 88.5T510-328v148h152v60H298Zm-14-406v-166H180v44q0 45 29.5 78.5T284-526Zm196 141q57 0 96.5-40t39.5-97v-258H344v258q0 57 39.5 97t96.5 40Zm196-141q45-10 74.5-43.5T780-648v-44H676v166Zm-196-57Z" fill="#c0c0c0" />
          </svg>
          <span>SADE</span>
        </div>
        <div class="recent-description">
          La société SADE remporte la deuxième place du concours avec son chantier d’Austerlitz et ses travaux en vue de
          la baignabilité de la Seine.
        </div>
      </div>
    </div>

    <div class="item">
      <div class="item__image">
        <img src="public/img/concours-spie.jpeg" alt="">
      </div>
      <div class="item__body">
        <div class="recent-item__title">
          <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48">
            <path d="M298-120v-60h152v-148q-54-11-96-46.5T296-463q-74-8-125-60t-51-125v-44q0-25 17.5-42.5T180-752h104v-88h392v88h104q25 0 42.5 17.5T840-692v44q0 73-51 125t-125 60q-16 53-58 88.5T510-328v148h152v60H298Zm-14-406v-166H180v44q0 45 29.5 78.5T284-526Zm196 141q57 0 96.5-40t39.5-97v-258H344v258q0 57 39.5 97t96.5 40Zm196-141q45-10 74.5-43.5T780-648v-44H676v166Zm-196-57Z" fill="#FFD700" />
          </svg>
          <span>Spie Batignolles</span>
        </div>
        <div class="recent-description">
          La première place est revenue à l'entreprise Spie Batignolles, avec son chantier Universeine : un projet de 10 bâtiments
          incluant la tour Signal qui marque l'entrée du futur village des athlètes pour les Jeux olympiques et paralympiques de Paris 2024.
        </div>
      </div>
    </div>

    <div class="item">
      <div class="item__image">
        <img src="public/img/concours-tppl.jpeg" alt="">
      </div>
      <div class="item__body">
        <div class="recent-item__title">
          <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48">
            <path d="M298-120v-60h152v-148q-54-11-96-46.5T296-463q-74-8-125-60t-51-125v-44q0-25 17.5-42.5T180-752h104v-88h392v88h104q25 0 42.5 17.5T840-692v44q0 73-51 125t-125 60q-16 53-58 88.5T510-328v148h152v60H298Zm-14-406v-166H180v44q0 45 29.5 78.5T284-526Zm196 141q57 0 96.5-40t39.5-97v-258H344v258q0 57 39.5 97t96.5 40Zm196-141q45-10 74.5-43.5T780-648v-44H676v166Zm-196-57Z" fill="#cd7f32" />
          </svg>
          <span>TPPL</span>
        </div>
        <div class="recent-description">
          TPPL a remporté le prix révélation avec son chantier de terrassement à Seiches-Sur-Le-Loir. Celui-ci vise à honorer les plus petites
          entreprises engagées dans le concours.
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <section class="content2">
      <div class="articles">
        <h2 class="underline">Actualités</h2>
        <?php
        $firstArticleDisplayed = false;

        foreach (array_reverse($articles) as $article) :
          if ($article['author'] === $targetUserID) {
            if (!$firstArticleDisplayed) {
              $firstArticleDisplayed = true;
              continue;
            }
        ?>
            <article>
              <img src="<?= $article['image']; ?>" alt="article" />
              <h3><?= $article['title']; ?></h3>
              <p class="article-content"><?= $article['content']; ?></p>
              <p class="see-more">Voir plus</p>
              <p class="see-less">Voir moins</p>
              <p class="text-hint">
                Oct 26
                <?php if ($currentUser) : ?>
                  <i class="fas fa-star like-btn" data-postid="<?= $article['id']; ?>"></i>
                <?php else : ?>
                  <i class="fas fa-star"></i>
                <?php endif; ?>
                <span class="like-count"><?= $article['likes_count']; ?></span>
              </p>
            </article>
        <?php
          }
        endforeach;
        ?>
      </div>

      <div class="popular">
        <h2 class="underline">Récents</h2>
        <?php
        $order = 1;
        foreach ($recentEnterpriseArticles as $article) :
          if ($article['author'] !== $targetUserID) :
        ?>
            <ul>
              <li>
                <div>0<?= $order++; ?></div>
                <div>
                  <h3><?= $article['title']; ?></h3>
                  <p class="article-author"><?= ucfirst($article['lastname']) . ' ' . ucfirst($article['firstname']) ?></p>
                  <a href="/show-article.php?id=<?= $article['id'] ?>" class="see-article">
                    <p>Voir l'article</p>
                  </a>
                </div>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>
            </ul>
      </div>
    </section>
  </div>
  <?php require_once 'include/footer.php' ?>
  <script type="text/javascript">
    const menuBtn = document.querySelector(".menu-btn");
    const navigation = document.querySelector(".navigation");

    menuBtn.addEventListener("click", () => {
      navigation.classList.toggle("active");
      menuBtn.classList.toggle("active");

    });

    const btns = document.querySelectorAll(".nav-btn");
    const slides = document.querySelectorAll(".video-slide");
    const contents = document.querySelectorAll(".content");

    let currentSlide = 0;
    const slideInterval = 5000;
    let autoSlideInterval;

    function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      sliderNav(currentSlide);
    }

    function sliderNav(index) {
      btns.forEach((btn) => btn.classList.remove("active"));
      slides.forEach((slide) => slide.classList.remove("active"));
      contents.forEach((content) => content.classList.remove("active"));

      btns[index].classList.add("active");
      slides[index].classList.add("active");
      contents[index].classList.add("active");

      currentSlide = index;
      resetAutoSlideInterval();
    }

    function resetAutoSlideInterval() {
      clearInterval(autoSlideInterval);
      autoSlideInterval = setInterval(nextSlide, slideInterval);
    }

    let touchStartX = 0;
    let touchEndX = 0;

    const home = document.querySelector(".home");

    home.addEventListener("touchstart", (e) => {
      touchStartX = e.touches[0].clientX;
    });

    home.addEventListener("touchend", (e) => {
      touchEndX = e.changedTouches[0].clientX;
      handleSwipe();
    });

    function handleSwipe() {
      if (touchEndX < touchStartX) {
        nextSlide();
      } else if (touchEndX > touchStartX) {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        sliderNav(currentSlide);
      }
    }

    autoSlideInterval = setInterval(nextSlide, slideInterval);

    btns.forEach((btn, i) => {
      btn.addEventListener("click", () => {
        sliderNav(i);
      });
    });

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