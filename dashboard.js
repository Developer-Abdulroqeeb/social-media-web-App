// theme-toggle.js
const light = document.getElementById('light');
const toggleButton = document.getElementById('toggle-button');
const body = document.body;

// Check for saved theme in localStorage and apply it on page load
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
  body.classList.add(savedTheme);
  light.innerHTML = savedTheme === 'light-mode' ? 'Light Mode' : 'Dark Mode';
} else {
  // Default to light mode if no theme is set in localStorage
  body.classList.add('light-mode');
  light.innerHTML = 'Light Mode';
}

// Toggle theme when button is clicked
toggleButton.addEventListener('click', () => {
  if (body.classList.contains('light-mode')) {
    body.classList.remove('light-mode');
    body.classList.add('dark-mode');
    light.innerHTML = 'Dark Mode';
    light.style.color = "black";
    // Save the dark mode preference in localStorage
    localStorage.setItem('theme', 'dark-mode');
  } else {
    body.classList.remove('dark-mode');
    body.classList.add('light-mode');
    light.innerHTML = 'Light Mode';
    // Save the light mode preference in localStorage
    localStorage.setItem('theme', 'light-mode');
  }
});

  






