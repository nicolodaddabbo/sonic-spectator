const likeButtons = document.querySelectorAll('[id^=like-]');

likeButtons.forEach(likeButton => {
    likeButton.addEventListener('click', function () {
        const postId = this.id.split('-')[1];
        const likeCount = document.getElementById(`like-counter-${postId}`);
        fetch(`/likePost`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'postId=' + postId,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    likeCount.textContent = data.likes + " Likes";
                    this.querySelector('.post-action-icon').classList.toggle('active');
                    console.log('Post liked successfully');
                } else {
                    showNotification('error', 'Error liking post');
                }
            })
            .catch(error => {
                console.error('Failed to like post', error);
            });
    });
});