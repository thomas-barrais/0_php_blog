// JavaScript code for handling the profile card overlay
document.addEventListener("DOMContentLoaded", function() {
  // Get the overlay element and close button
  const overlay = document.querySelector(".overlay");
  const closeBtn = document.querySelector("#closeBtn");

  // Get the elements for displaying the profile information in the overlay
  const fullProfileImg = document.querySelector("#fullProfileImg");
  const fullProfileInfo = document.querySelector("#fullProfileInfo");

  // Add click event listeners to all profile cards
  const profileCards = document.querySelectorAll(".item");
  profileCards.forEach((card) => {
    card.addEventListener("click", function() {
      // Get the profile image and info from the clicked card
      const articleImg = this.querySelector(".item__image img").src;
      const articleTitle = this.querySelector(".item__title").textContent;
      const articleContent = this.querySelector(".item__description").textContent;

      // Set the overlay content with the profile information
      fullProfileImg.src = articleImg;
      fullProfileInfo.innerHTML = `
    <p class="profile-name">${articleTitle}</p>
    <p class="profile-content-overlay">${articleContent}</p>
    `;
    document.body.classList.add("no-scroll");
      overlay.style.display = "flex";
    });
  });
  closeBtn.addEventListener("click", function() {
    document.body.classList.remove("no-scroll");
    overlay.style.display = "none";
  });

// Sélectionnez tous les liens "Voir plus"
const seeMoreLinks = document.querySelectorAll('.see-more');

// Ajoutez un gestionnaire d'événement à chaque lien
seeMoreLinks.forEach(link => {
  link.addEventListener('click', function() {
    // Trouvez l'article parent de ce lien
    const article = this.closest('article');
    
    // Sélectionnez le contenu de l'article
    const articleContent = article.querySelector('.article-content');
    
    // Sélectionnez les boutons "Voir plus" et "Voir moins"
    const seeMoreButton = article.querySelector('.see-more');
    const seeLessButton = article.querySelector('.see-less');

    // Modifiez la visibilité des boutons
    seeMoreButton.style.display = 'none';
    seeLessButton.style.display = 'inline';

    // Étendez le contenu de l'article
    articleContent.style.maxHeight = 'none';
  });

  // Trouvez le bouton "Voir moins" correspondant au lien "Voir plus"
  const seeLessButton = link.parentElement.querySelector('.see-less');

  // Ajoutez un gestionnaire d'événement pour "Voir moins"
  seeLessButton.addEventListener('click', function() {
    // Trouvez l'article parent de ce bouton
    const article = this.closest('article');
    
    // Sélectionnez le contenu de l'article
    const articleContent = article.querySelector('.article-content');
    
    // Sélectionnez les boutons "Voir plus" et "Voir moins"
    const seeMoreButton = article.querySelector('.see-more');
    const seeLessButton = article.querySelector('.see-less');

    // Modifiez la visibilité des boutons
    seeMoreButton.style.display = 'inline';
    seeLessButton.style.display = 'none';

    // Réduisez le contenu de l'article
    articleContent.style.maxHeight = '6rem';
  });
});
});


