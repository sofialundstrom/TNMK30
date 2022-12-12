// Get the modal
var modal = document.getElementById("mymodal");

// Get the button that opens the modal
var btn = document.getElementById("help_btn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
// When the user clics the dark mode button, it changes the color for the header and the footer and as well the background
var button = document.getElementById("dark-mode-button");

function toggleDarkMode() {
  var header = document.getElementById("header");
  var footer = document.getElementById("footer");
  var body = document.body;
  var button = document.getElementById("dark-mode-button");

  if (body.classList.contains("dark-mode")) {
    body.classList.remove("dark-mode");
    header.classList.remove("dark-header");
    footer.classList.remove("dark-footer");
    button.innerHTML = "Dark Mode";
  } else {
    body.classList.add("dark-mode");
    header.classList.add("dark-header");
    footer.classList.add("dark-footer");
    button.innerHTML = "Light Mode";
  }
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
