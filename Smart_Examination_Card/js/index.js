
//Smart examination card javascript codes

// Get the Sidebar
var mySidebar = document.getElementById("secs_mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("secs_myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_secs_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_secs_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}

function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}


