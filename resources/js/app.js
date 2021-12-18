require('./bootstrap');

// toggles visibility of mobile navbar
let mobileNavDropdown = document.getElementById("mobile-nav-dropdown");

if (mobileNavDropdown) {
  
  toggleMobileNavDropdown = function () {
    if (mobileNavDropdown.style.display === "block") {
      mobileNavDropdown.style.display = "none";
    } else {
      mobileNavDropdown.style.display = "block";
    }
  }

  // closes the mobile navbar when clicking outside of it
  window.addEventListener('click', function(e) {
    if (mobileNavDropdown.style.display === "block" && !document.getElementById('mobile-nav').contains(e.target)) {
      mobileNavDropdown.style.display = "none";
    }
  });
  
}

