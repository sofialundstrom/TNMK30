var toggleModeButton = document.getElementById('toggle-mode-button');
var darkMode = localStorage.getItem('darkMode');

if (darkMode === 'true') {
  document.body.classList.add('dark-mode');
  toggleModeButton.innerText = 'Light Mode';
}

toggleModeButton.addEventListener('click', function() {
  if (darkMode === 'true') {
    document.body.classList.remove('dark-mode');
    toggleModeButton.innerText = 'Dark Mode';
    darkMode = 'false';
    localStorage.setItem('darkMode', 'false');
  } else {
    document.body.classList.add('dark-mode');
    toggleModeButton.innerText = 'Light Mode';
    darkMode = 'true';
    localStorage.setItem('darkMode', 'true');
  }
});

/*// Get the cookie acceptance button
const acceptCookiesBtn = document.getElementById("accept-cookies-btn");

// Add an event listener to the button to handle clicks
acceptCookiesBtn.addEventListener("click", function() {
  // Set a cookie to indicate that the user has accepted cookies
  document.cookie = "accepts-cookies=true";
  
 // Get the cookie box element
  const cookieBox = document.getElementById("Cookiebox");

  // Hide the cookie acceptance button
  //acceptCookiesBtn.style.display = "none";

      // Hide the cookie box
      cookieBox.style.display = "none";
});
*/