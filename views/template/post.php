<div class='post-wrapper'>
    <div class='post-container'>
        <img class='post-image' src='assets/posts/<?= $post['image'] ?>' alt='' />
        <div class='post-bottom-container'>
            <div class='post-actions-container'>
                <div class='post-action-container'>
                    <img class='post-action-icon' src='assets/icons/like.svg' alt='' />
                    <span class='post-action-label'>Likes</span>
                </div>
                <div class='post-action-container'>
                    <img class='post-action-icon' src='assets/icons/comment.svg' alt='' />
                    <span class='post-action-label'>Comments</span>
                </div>
            </div>
            <div class='post-description-container'>
                <div class='post-description-user'>
                    <?= $post['user_id'] ?>
                </div>
                <div class='post-description'>
                    <?= $post['description'] ?>
                </div>
            </div>
        </div>
    </div>
</div>