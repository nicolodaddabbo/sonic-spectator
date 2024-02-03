<section class='notification-wrapper <?= $notification['viewed'] ? '' : 'new' ?>'>
    <section>
        <a href='/user/<?= $notification['sending_user_id'] ?>'>
            <?= $usernames[$notification['sending_user_id']] ?>
        </a>
        <span>
            <?= $notification_types[$notification['notification_type_id']]['text'] ?>
        </span>
    </section>
    <?php
    if ($notification['notification_type_id'] !== NOTIFICATION_TYPE_FOLLOW) {
        ?>
        <a href='/profile'>
            <img class='post-image-preview' src='/assets/posts/<?= $post_images[$notification['post_id']] ?>' alt='' />
        </a>
        <?php
    } ?>
</section>