document.getElementById('clearButton').addEventListener('click', function () {
    document.getElementById('searchInput').value = '';
    document.getElementById("searchResults").innerHTML = "";
});

document.getElementById('searchButton').addEventListener('click', function () {
    const searchTerm = document.getElementById('searchInput').value;
    const newUrl = '/search/' + encodeURIComponent(searchTerm);
    window.history.pushState({ path: newUrl }, '', newUrl);
});

function liveSearch(searchTerm) {
    // Check if the search term is empty
    if (searchTerm.length == 0) {
        // If it is, clear the content of the "searchResults" element and return
        document.getElementById("searchResults").innerHTML = "";
        return;
    }
    // Create a new XMLHttpRequest object
    const xmlhttp = new XMLHttpRequest();
    // Define a callback function to be executed when the readyState changes
    xmlhttp.onreadystatechange = function() {
        // Check if the request is complete (readyState == 4) and successful (status == 200)
        if (this.readyState == 4 && this.status == 200) {
            // If successful, update the content of the "searchResults" element with the response text
            document.getElementById("searchResults").innerHTML = this.responseText;
        }
    }
    // Initialize the request by specifying the method (GET), URL, and asynchronous flag (true)
    xmlhttp.open("GET", "/search/" + encodeURIComponent(searchTerm), true);
    // Send the request to the server
    xmlhttp.send();
}