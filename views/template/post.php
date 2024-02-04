<article id='post-<?= $post['id'] ?>' class='post-wrapper'>
    <section class='post-container'>
        <img class='post-image' src='/assets/posts/<?= $post['image'] ?>' alt='Post Image' />
        <section class='post-bottom-container'>
            <section class='post-actions-container'>
                <div id='like-<?= $post['id'] ?>' class='post-action-container'>
                    <img class='post-action-icon <?= in_array($_SESSION['user_id'], $likes[$post['id']]) ? 'active' : '' ?>'
                        src='/assets/icons/like.svg' alt='Like Icon' />
                    <span id='like-counter-<?= $post['id'] ?>' class='post-action-label'>
                        <?= count($likes[$post['id']]) ?> likes
                    </span>
                </div>
                <div id='comments-<?= $post['id'] ?>' class='post-action-container'>
                    <img class='post-action-icon' src='/assets/icons/comment.svg' alt='Comment Icon' />
                    <span class='post-action-label'>
                        <?= count($comments[$post['id']]) ?> comments
                    </span>
                </div>
                <?php
                if ($_SERVER['REQUEST_URI'] === '/profile') {
                    ?>
                    <div id='delete-<?= $post['id'] ?>' class='post-action-container delete'>
                        <img class='post-action-icon' src='/assets/icons/delete.svg' alt='Delete Icon' />
                        <span class='post-action-label'>delete</span>
                    </div>
                    <?php
                } ?>
            </section>
            <section class='post-description-container'>
                <?php if (isset($user) || $_SERVER['REQUEST_URI'] === '/profile') { ?>
                    <header class='post-description-user'>
                        <?= $_SERVER['REQUEST_URI'] === '/profile' ? $_SESSION['user'] : $user['username'] ?>
                    </header>
                <?php } else { ?>
                    <a href='/user/<?= $post['user_id'] ?>'>
                        <header class='post-description-user'>
                            <?= $posting_users[$post['user_id']]['username'] ?>
                        </header>
                    </a>
                <?php } ?>
                <p class='post-description'>
                    <?= $post['description'] ?>
                </p>
            </section>
        </section>
    </section>
    <section id='comment-section-<?= $post['id'] ?>' class='comment-section'>
        <div class='comment-handler'>
            <div></div>
        </div>
        <header class='comment-section-header'>Comments</header>
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
                    <img src='/assets/icons/send.svg' alt='Send Icon' />
                </button>
            </section>
        </section>
    </section>
</article>
