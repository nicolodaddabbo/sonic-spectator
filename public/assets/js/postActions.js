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
                    // console.log('Post liked successfully');
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

        document.getElementById('comment-submit-' + postId).addEventListener('click', function () {
            const commentInput = document.getElementById('comment-input-' + postId);
            const comment = commentInput.value;
            commentInput.value = '';
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
                            // Create new comment element
                            const commentContainer = commentSection.querySelector('.comment-list-container');
                            const newComment = document.createElement('section');
                            newComment.className = 'comment-container';

                            // User info container
                            const userInfo = document.createElement('span');
                            userInfo.className = 'user-info-container';
                            const userImg = document.createElement('img');
                            userImg.src = '/assets/profiles/' + data.new_comment.profile_img;
                            userImg.alt = 'Profile Image';
                            userImg.onerror = function () {
                                handleImageError(this, 'profile');
                            };
                            const userName = document.createElement('header');
                            userName.textContent = data.new_comment.username;
                            userInfo.appendChild(userImg);
                            userInfo.appendChild(userName);

                            // Comment text
                            const commentText = document.createElement('span');
                            commentText.className = 'comment';
                            commentText.textContent = data.new_comment.text;

                            // Assemble the comment element
                            newComment.appendChild(userInfo);
                            newComment.appendChild(commentText);
                            commentContainer.prepend(newComment);
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

const deleteButtons = document.querySelectorAll('[id^=delete-]');

deleteButtons.forEach(deleteButton => {
    deleteButton.addEventListener('click', function () {
        const post_id = this.id.split('-')[1];
        fetch('/deletePost', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'post_id=' + post_id,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    const post = document.getElementById(`post-${post_id}`);
                    post.remove();
                    // console.log('Post deleted successfully');
                } else {
                    showNotification('error', 'Error deleting post');
                }
            })
            .catch(error => {
                console.error('Failed to delete post', error);
            });
    });
});