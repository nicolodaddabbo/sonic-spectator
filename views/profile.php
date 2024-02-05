<?php include_once 'template/redirect.php'; ?>
<!DOCTYPE html>
<html lang='en'>
<?php include_once 'template/head.php'; ?>
<?php include_once 'utils/time_elapsed_string.php'; ?>

<body>
    <?php include_once 'template/profile_header.php'; ?>
    <section class='profile-info'>
        <img src='/assets/profiles/<?= $profileImage; ?>' alt='Profile Image' onerror='handleImageError(this, "profile")'>
    </section>
    <section class='profile-stats'>
        <section class='profile-stats-item'>
            <span class='profile-stats-item-value'>
                <?= $post_count; ?>
            </span>
            <span class='profile-stats-item-title'>Posts</span>
        </section>
        <a href='/followers/<?= $_SERVER['REQUEST_URI'] === '/profile' ? $_SESSION['user_id'] : $user['id'] ?>'>
            <section class='profile-stats-item'>
                <span class='profile-stats-item-value'>
                    <?= $follower_count; ?>
                </span>
                <span class='profile-stats-item-title'>Followers</span>
            </section>
        </a>
        <a href='/following/<?= $_SERVER['REQUEST_URI'] === '/profile' ? $_SESSION['user_id'] : $user['id'] ?>'>
            <section class='profile-stats-item'>
                <span class='profile-stats-item-value'>
                    <?= $following_count; ?>
                </span>
                <span class='profile-stats-item-title'>Following</span>
            </section>
        </a>
    </section>
    <section id='post-list'>
        <h2 class='post-list-title'>Posts</h2>
        <?php foreach ($posts as $post): ?>
            <?php include 'template/post.php'; ?>
        <?php endforeach; ?>
    </section>
    <?php if ($_SERVER['REQUEST_URI'] === '/profile') {
        include_once 'template/footer.php';
    } ?>
    <script src='/assets/js/postActions.js'></script>
    <script src='/assets/js/notifications.js'></script>
    <script src="/assets/js/imageErrorHandler.js"></script>
</body>

</html>