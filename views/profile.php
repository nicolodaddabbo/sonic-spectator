<?php include_once 'template/redirect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'template/head.php'; ?>

<body>
    <?php include_once 'template/profile_header.php'; ?>
    <section class='profile-stats'>
        <section class='profile-stats-item'>
            <span class='profile-stats-item-value'><?= $post_count; ?></span>
            <span class='profile-stats-item-title'>Posts</span>
        </section>
        <section class='profile-stats-item'>
            <span class='profile-stats-item-value'><?= $follower_count; ?></span>
            <span class='profile-stats-item-title'>Followers</span>
        </section>
        <section class='profile-stats-item'>
            <span class='profile-stats-item-value'><?= $following_count; ?></span>
            <span class='profile-stats-item-title'>Following</span>
        </section>
    </section>
    <article class='post-list'>
        <h2 class='post-list-title'>Posts</h2>
        <?php foreach ($posts as $post): ?>
            <?php include 'template/post.php'; ?>
        <?php endforeach; ?>
    </article>
    <?php include_once 'template/footer.php'; ?>
    <script src="assets/js/postActions.js"></script>
</body>

</html>