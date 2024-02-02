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
                <div id='comments-<?= $post['id'] ?>' class='post-action-container'>
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
                        : $posting_users[$post['user_id']]['username'] ?>
                </header>
                <p class='post-description'>
                    <?= $post['description'] ?>
                </p>
            </div>
        </div>
    </section>
    <section id='comment-section-<?= $post['id'] ?>' class='comment-section'>
        <div class='comment-handler'>
            <div></div>
        </div>
        <span class='comment-section-header'>Comments</span>
        <section class='comment-list-container'>
            <?php
            if (isset($comments[$post['id']])) {
                foreach ($comments[$post['id']] as $comment) {
                    ?>
                    <section class='comment-container'>
                        <span class='comment-user'>
                            <?= $commenting_users[$comment['user_id']]['username'] ?>
                        </span>
                        <span class='comment'>
                            <?= $comment['text'] ?>
                        </span>
                    </section>
                    <?php
                }
            }
            ?>
        </section>
        <section class='comment-form-container'>
            <section id='comment-form-<?= $post['id'] ?>' class='comment-form'>
                <input type='text' name='comment' class='comment-input' placeholder='Add a comment...' />
                <button type='submit' class='comment-submit'>
                    <img src='assets/icons/send.svg' alt='' />
                </button>
            </section>
        </section>
    </section>
</article>