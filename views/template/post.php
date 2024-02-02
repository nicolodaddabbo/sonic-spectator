<article class='post-wrapper'>
    <section class='post-container'>
        <img class='post-image' src='assets/posts/<?= $post['image'] ?>' alt='' />
        <div class='post-bottom-container'>
            <div class='post-actions-container'>
                <div id='like-<?= $post['id'] ?>' class='post-action-container'>
                    <img class='post-action-icon <?= in_array($_SESSION['user_id'], $likes[$post['id']]) ? 'active' : '' ?>'
                        src='assets/icons/like.svg' alt='' />
                    <span id='like-counter-<?= $post['id'] ?>' class='post-action-label'>
                        <?= count($likes[$post['id']]) ?> Likes
                    </span>
                </div>
                <div class='post-action-container'>
                    <img class='post-action-icon' src='assets/icons/comment.svg' alt='' />
                    <span class='post-action-label'>
                        <?= count($comments[$post['id']]) ?> Comments
                    </span>
                </div>
            </div>
            <div class='post-description-container'>
                <header class='post-description-user'>
                    <?= $_SERVER['REQUEST_URI'] === "/profile" ?
                        $_SESSION['user']
                        : $users[$post['user_id']]['username'] ?>
                </header>
                <p class='post-description'>
                    <?= $post['description'] ?>
                </p>
            </div>
        </div>
    </section>
</article>