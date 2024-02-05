<section class='notification-wrapper <?= $notification['viewed'] ? '' : 'new' ?>'>
    <section>
        <section class='notification-info'>
            <a class='user-info-container' href='/user/<?= $notification['sending_user_id'] ?>'>
                <img src='/assets/profiles/<?= $users[$notification['sending_user_id']]['profile_img'] ?>' alt='Profile Image' onerror='handleImageError(this, "profile")'>
                <header>
                    <?= $users[$notification['sending_user_id']]['username'] ?>
                </header>
            </a>
            <span>
                <?= $notification_types[$notification['notification_type_id']]['text'] ?>
            </span>
        </section>
        <span class='notification-date'>
            <?= time_elapsed_string($notification['date']) ?>
        </span>
    </section>
    <?php
    if ($notification['notification_type_id'] !== NOTIFICATION_TYPE_FOLLOW) {
        ?>
        <a href='/profile'>
            <img class='post-image-preview' src='/assets/posts/<?= $post_images[$notification['post_id']] ?>' alt='Post Image' onerror='handleImageError(this, "post")'>
        </a>
        <?php
    } ?>
</section>