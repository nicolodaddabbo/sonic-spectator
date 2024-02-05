document.addEventListener("DOMContentLoaded", function() {
    setupFollowButtons();
});

function setupFollowButtons() {
    const followButtons = document.querySelectorAll('[id^="followButton"]');
    followButtons.forEach(button => {
        const profileUserId = button.id.replace('followButton', '');
        button.addEventListener('click', function () {
            toggleFollow(profileUserId);
        });
    });
}

async function toggleFollow(profileUserId) {
    const followButton = document.getElementById('followButton' + profileUserId);
    const followersCount = document.getElementById('followers-counter');

    try {
        await fetch('/toggleFollow', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'profileUserId=' + profileUserId,
        })
        .then((res) => res.json())
        .then((data) => {
            if (data.isFollowing) {
                followButton.innerHTML = 'Following';
                followButton.classList.remove('button-not-following');
                followButton.classList.add('button-following');
                if (followersCount) {
                    followersCount.innerHTML = parseInt(followersCount.innerHTML) + 1;
                }
            } else {
                followButton.innerHTML = '+ Follow';
                followButton.classList.remove('button-following');
                followButton.classList.add('button-not-following');
                if (followersCount) {
                    followersCount.innerHTML = parseInt(followersCount.innerHTML) - 1;
                }
            }

        })
        .catch(() => {
            console.error('Failed to toggle follow status');
        })
    } catch (error) {
        console.error('Error during toggle follow:', error);
    }
}