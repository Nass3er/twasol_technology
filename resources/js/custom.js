const navbar = document.getElementById('navbar');
const floatingBtn = document.getElementById('main-fab');

// --- Navbar State Update ---
function updateNavbar() {
  if (!navbar) return;
  // Check if the user has scrolled past the top (scrollY > 0)
  if (window.scrollY > 0) {
      // SCROLLED DOWN: Solid background (bg-base-100, shadow-lg, text-black)
      navbar.classList.remove('bg-transparent', 'text-white', 'nav-dark');
      navbar.classList.add('bg-base-100', 'shadow-lg', 'text-black', 'nav-light');
  } else {
      // AT TOP: Transparent background (bg-transparent, text-white)
      navbar.classList.remove('bg-base-100', 'shadow-lg', 'text-black', 'nav-light');
      navbar.classList.add('bg-transparent', 'text-white', 'nav-dark');
  }
}

// --- Floating Button State Update (using opacity for smooth fade) ---
function updateFloatingBtn() {
  if (!floatingBtn) return;
  // Uses opacity-0 / opacity-100 for a smooth fade transition.
  // 'pointer-events-none' prevents clicking the invisible button.
  if (window.scrollY > 0) {
      // SCROLLED DOWN: Show button (opacity-100)
      floatingBtn.classList.remove('opacity-0', 'pointer-events-none');
      floatingBtn.classList.add('opacity-100', 'pointer-events-auto');
  } else {
      // AT TOP: Hide button (opacity-0)
      floatingBtn.classList.remove('opacity-100', 'pointer-events-auto');
      floatingBtn.classList.add('opacity-0', 'pointer-events-none');
  }
}

// Run on scroll
window.addEventListener('scroll', updateNavbar);
window.addEventListener('scroll', updateFloatingBtn);

// Run immediately on page load
document.addEventListener('DOMContentLoaded', updateNavbar);
document.addEventListener('DOMContentLoaded', updateFloatingBtn);

document.querySelectorAll('.details-group').forEach((detail) => {
  detail.addEventListener('toggle', function() {
      if (this.open) {
          document.querySelectorAll('.details-group').forEach((other) => {
              if (other !== this) {
                  other.open = false;
              }
          });
      }
  });
});
