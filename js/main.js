/*********************************/
/* TOGGLE MODE BUTTON */
/*********************************/

var toggleModeButton = document.getElementById('toggle-mode-button');
var darkMode = localStorage.getItem('darkMode');

if (darkMode === 'true') {
  document.body.classList.add('dark-mode');
  toggleModeButton.innerText = 'Light Mode';
  document.getElementById("imageId").src="../bilder/logo-dark.png";
}

toggleModeButton.addEventListener('click', function() {
  if (darkMode === 'true') {
    document.body.classList.remove('dark-mode');
    toggleModeButton.innerText = 'Dark Mode';
    darkMode = 'false';
    localStorage.setItem('darkMode', 'false');
    document.getElementById("imageId").src="../bilder/logo-light.png";
  } else {
    document.body.classList.add('dark-mode');
    toggleModeButton.innerText = 'Light Mode';
    darkMode = 'true';
    localStorage.setItem('darkMode', 'true');
    document.getElementById("imageId").src="../bilder/logo-dark.png";
  }
});

/*********************************/
/* AUTOCOMPLETE SEARCH BOX */
/*********************************/
// The search input element
const searchInput = document.getElementById('search');
console.log(searchInput)
// Add an event listener to the search input element
// to listen for when the user inputs text
searchInput.addEventListener('input', ASB);
  // Get the value of the search input
 function ASB (evt){ 
  let value = this.value.trim();
  console.log(value)
  // If the search input is empty, reset the list of suggestions
  if (value.length === 0) {
    //searchInput;
    return;
  }

  
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", 'autocompletesearchbox.php?SearchInput=' + value, true);
  xhttp.onload = function(){
    const searchdata = xhttp.response;
    
    $("#search").autocomplete({
      source: JSON.parse(searchdata),
      minLength: 1,
      delay: 600
    });
  };
  xhttp.send();
};





/*/ Get the cookie acceptance button
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
