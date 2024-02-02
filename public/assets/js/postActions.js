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

const commentButtons = document.querySelectorAll('[id^=comments-]');

commentButtons.forEach(commentButton => {
    commentButton.addEventListener('click', function () {
        const postId = this.id.split('-')[1];
        const commentSection = document.getElementById('comment-section-' + postId);
        commentSection.classList.toggle('active');
        commentSection.querySelector('.comment-handler').addEventListener('click', function () {
            commentSection.classList.remove('active');
        });
        const commentForm = commentSection.querySelector('.comment-form-container');
        commentForm.querySelector('.comment-submit').addEventListener('click', function () {
            const commentInput = commentForm.querySelector('.comment-input');
            const comment = commentInput.value;
            if (comment) {
                const formData = new FormData();
                formData.append('post_id', postId);
                formData.append('text', comment);
                fetch('/newComment', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            commentInput.value = '';
                            const commentContainer = commentSection.querySelector('.comment-list-container');
                            const newComment = document.createElement('section');
                            newComment.className = 'comment-container';
                            const commentUser = document.createElement('span');
                            commentUser.className = 'comment-user';
                            commentUser.textContent = data.new_comment.username + " ";
                            newComment.appendChild(commentUser);
                            const commentText = document.createElement('span');
                            commentText.className = 'comment';
                            commentText.textContent = data.new_comment.text;
                            newComment.appendChild(commentText);
                            commentContainer.prepend(newComment);
                            console.log('Comment added successfully');
                        } else {
                            showNotification('error', 'Error adding comment');
                        }
                    })
                    .catch(error => {
                        console.error('Failed to add comment', error);
                    });
            }
        });
    });
});