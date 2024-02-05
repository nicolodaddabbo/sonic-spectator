<article id='post-<?= $post['id'] ?>' class='post-wrapper'>
    <section class='post-container'>
        <?php if ($post['artist'] !== ''): ?>
            <section class='concert-container'>
                <span>
                    @
                    <?= $post['artist'] ?>
                    <?= substr($post['artist'], -1) === 's' ? "'" : "'s" ?> concert
                </span>
            </section>
        <?php endif; ?>
        <img class='post-image' src='/assets/posts/<?= $post['image'] ?>' alt='Post Image'
            onerror='handleImageError(this, "post")'>
        <section class='post-bottom-container'>
            <section class='post-actions-container'>
                <div id='like-<?= $post['id'] ?>' class='post-action-container'>
                    <img class='post-action-icon <?= in_array($_SESSION['user_id'], $likes[$post['id']]) ? 'active' : '' ?>'
                        src='/assets/icons/like.svg' alt='Like Icon'>
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
                    <section class='user-info-container'>
                        <img src='/assets/profiles/<?= $profileImage; ?>' alt='Profile Image'
                            onerror='handleImageError(this, "profile")'>
                        <span>
                            <?= $_SERVER['REQUEST_URI'] === '/profile' ? $_SESSION['user'] : $user['username'] ?>
                        </span>
                    </section>
                <?php } else { ?>
                    <a class='user-info-container' href='/user/<?= $post['user_id'] ?>'>
                        <img src='/assets/profiles/<?= $posting_users[$post['user_id']]['profile_img'] ?>'
                            alt='Profile Image' onerror='handleImageError(this, "profile")'>
                        <span>
                            <?= $posting_users[$post['user_id']]['username'] ?>
                        </span>
                    </a>
                <?php } ?>
                <p>
                    <?= $post['description'] ?>
                </p>
            </section>
            <section class='post-date-container'>
                <span>
                    <?= time_elapsed_string($post['date']) ?>
                </span>
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
                    <article class='comment-container'>
                        <span class='user-info-container'>
                            <img src='/assets/profiles/<?= $commenting_users[$comment['user_id']]['profile_img'] ?>'
                                alt='Profile Image' onerror='handleImageError(this, "profile")'>
                            <span>
                                <?= $commenting_users[$comment['user_id']]['username'] ?>
                            </span>
                        </span>
                        <span class='comment'>
                            <?= $comment['text'] ?>
                        </span>
                    </article>
                    <?php
                }
            }
            ?>
        </section>
        <section class='comment-form-container'>
            <section id='comment-form-<?= $post['id'] ?>' class='comment-form'>
                <label for='comment-input-<?= $post['id'] ?>' class='visually-hidden'>Insert Comment</label>
                <textarea name='comment' id='comment-input-<?= $post['id'] ?>' placeholder='Add a comment...'
                    autocomplete='on'></textarea>
                <button type='submit' id='comment-submit-<?= $post['id'] ?>'>
                    <img src='/assets/icons/send.svg' alt='Send Icon'>
                </button>
            </section>
        </section>
    </section>
</article>