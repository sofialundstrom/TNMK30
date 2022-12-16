var toggleModeButton = document.getElementById('toggle-mode-button');
var darkMode = localStorage.getItem('darkMode');

if (darkMode === 'true') {
  document.body.classList.add('dark-mode');
  toggleModeButton.innerText = 'Light Mode';
  document.getElementById("imageid").src="../bilder/LOGO-DARK.png";
}

toggleModeButton.addEventListener('click', function() {
  if (darkMode === 'true') {
    document.body.classList.remove('dark-mode');
    toggleModeButton.innerText = 'Dark Mode';
    darkMode = 'false';
    localStorage.setItem('darkMode', 'false');
    document.getElementById("imageid").src="../bilder/logo-light.png"
  } else {
    document.body.classList.add('dark-mode');
    toggleModeButton.innerText = 'Light Mode';
    darkMode = 'true';
    localStorage.setItem('darkMode', 'true');
    document.getElementById("imageid").src="../bilder/LOGO-DARK.png";
  }
});
