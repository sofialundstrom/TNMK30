// When the user clics the dark mode button, it changes the color for the header and the footer and as well the background
const button = document.getElementById('toggle-mode-button');
button.addEventListener('click', toggleMode);

function toggleMode() {
  const body = document.body;

  body.classList.toggle('dark-mode');

  if (button.innerText === 'Dark Mode') {
    button.innerText = 'Light Mode';
  } else {
    button.innerText = 'Dark Mode';
  }

  var currentMode = Cookies.get("mode");
  if (!currentMode) {
    currentMode = "light-mode";

  }

    // Set the body's class based on the current mode
    document.body.className = currentMode;

    // Toggle the mode and set the new value in the cookie
    var newMode = currentMode == "dark-mode" ? "light-mode" : "dark-mode";
    Cookies.set("mode", newMode);
}




// Get the cookie acceptance button
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


//if (cookie) {
  //  body.classList.toggle('dark-mode');
  //  button.innerText = 'Light Mode';
  //}