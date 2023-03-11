//Flag to indicate if a dropdown menu is visible
var isShowing = false;

//Reference to the current dropdown menu
var dropdownMenu = null;

var isDarkMode = false;

//Show the drop-down menu with the given id, if it exists, and set flag
function show(id)
{
    hide(); /* First hide any previously showing dropdown menu */
    dropdownMenu = document.getElementById(id);
    if (dropdownMenu != null)
    {
        dropdownMenu.style.visibility = 'visible';
        isShowing = true;
    }
}

//Hide the currently visible dropdown menu and set flag
function hide()
{       
    if (isShowing) dropdownMenu.style.visibility = 'hidden';
    isShowing = false;
}

function changeModes()
{
    if(isDarkMode){
        isDarkMode = false;
        document.getElementById('modebutton').innerText = "Switch to Dark Mode";
        document.body.style.backgroundColor = "lightblue";
    }else{
        isDarkMode = true;
        document.getElementById('modebutton').innerText = "Switch to Light Mode"
        document.body.style.backgroundColor = "darkblue"
    }
}
