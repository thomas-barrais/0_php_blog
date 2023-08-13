// JavaScript code for handling the profile card overlay
document.addEventListener("DOMContentLoaded", function() {
  // Get the overlay element and close button
  const overlay = document.querySelector(".overlay");
  const closeBtn = document.querySelector("#closeBtn");

  // Get the elements for displaying the profile information in the overlay
  const fullProfileImg = document.querySelector("#fullProfileImg");
  const fullProfileInfo = document.querySelector("#fullProfileInfo");

  // Add click event listeners to all profile cards
  const profileCards = document.querySelectorAll(".profile-card");
  profileCards.forEach((card) => {
    card.addEventListener("click", function() {
      // Get the profile information from the data-description attribute
      const description = this.dataset.description;
      // Get the profile image and info from the clicked card
      const profileImg = this.querySelector(".profile-img").src;
      const profileName = this.querySelector(".profile-name").textContent;
      const profileWork = this.querySelector(".profile-work").textContent;

      // Set the overlay content with the profile information
      fullProfileImg.src = profileImg;
      fullProfileInfo.innerHTML = `
    <p class="profile-name">${profileName}</p>
    <p class="profile-work">${profileWork}</p>
    <p>${description}</p>
  `;

      // Show the overlay
      overlay.style.display = "flex";
    });
  });

  // Close the overlay when the close button is clicked
  closeBtn.addEventListener("click", function() {
    overlay.style.display = "none";
  });
});