const followButtons = document.querySelectorAll('[id^="followButton"]');
followButtons.forEach(button => {
    const profileUserId = button.id.replace('followButton', '');
    button.innerHTML = 'Following';
    button.addEventListener('click', function() {
        toggleFollow(profileUserId);
    });
});

document.getElementById('clearButton').addEventListener('click', function () {
    document.getElementById('searchInput').value = '';
    document.getElementById("searchResults").innerHTML = "";
});

document.getElementById('searchInput').addEventListener('keyup', function() {
    liveSearch(this.value);
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

/*async function toggleFollow(profileUserId) {
    console.log('Code entered: Toggle Follow Function');
    const followButton = document.getElementById('followButton' + profileUserId);
    followButton.innerHTML = 'Following';

    try {
        const response = await fetch('/models/followToggle.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'profileUserId=' + profileUserId,
        });

        if (response.ok) {
            const data = await response.json();
            if (data.isFollowing) {
                followButton.innerHTML = 'Following';
                followButton.classList.remove('button-not-following');
                followButton.classList.add('button-following');
            } else {
                followButton.innerHTML = '+ Follow';
                followButton.classList.remove('button-following');
                followButton.classList.add('button-not-following');
            }
        } else {
            console.error('Failed to toggle follow status');
        }
    } catch (error) {
        console.error('Error during toggle follow:', error);
    }
}*/