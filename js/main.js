/*********************************/
/* TOGGLE MODE BUTTON */
/*********************************/

//Get the toggle mode button element
var toggleModeButton = document.getElementById('toggle-mode-button');

//Get the value of the 'darkMode' item from local storage
var darkMode = localStorage.getItem('darkMode');

//Check if  the dark mode is enabled
if (darkMode === 'true') {
  //Add the 'dark-mode' class to the body element
  document.body.classList.add('dark-mode');
  //Change the text of the toggle mode button to 'Light Mode'
  toggleModeButton.innerText = 'Light Mode';
  //Change the source of the image with id 'ImageId' to the dark mode logo
  document.getElementById("imageId").src="../bilder/logo-dark.png";
}

//Add an event listener to the toggle mode button
toggleModeButton.addEventListener('click', function() {
  //Check if the dark mode is currently enabled
  if (darkMode === 'true') {
    // For when darkMode is NOT enable
    document.body.classList.remove('dark-mode');
    toggleModeButton.innerText = 'Dark Mode';
    darkMode = 'false';
    localStorage.setItem('darkMode', 'false');
    document.getElementById("imageId").src="../bilder/logo-light.png";
  } else {
    // For when darkMode is enable
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
// Add an event listener to the search input element to listen for when the user inputs text
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
  
  //Creating a new request
  var xhttp = new XMLHttpRequest();
  //Define what type of data that will be sent
  xhttp.open("GET", 'autocompletesearchbox.php?SearchInput=' + value, true);
  //When the request finishes loading, excute the following fintion
  xhttp.onload = function(){
    //Store the response from the server as a variable
    const searchdata = xhttp.response;
    
    //Use jQuery's autocomplete function to add autocomplete functionality to the search input field
    $("#search").autocomplete({
      //Use the server's resoinse as the source for the autocomplete options
      source: JSON.parse(searchdata),
      //Set the minimum number of characters needed before the autocomplete options appear
      minLength: 1,
      //Set the delay before the autocomplete options appear
      delay: 600
    });
  };
  //Send the request
  xhttp.send();
};
