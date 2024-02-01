<?php include_once 'template/redirect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'template/head.php'; ?>

<body>
    <?php include_once 'template/profile_header.php'; ?>
    <article class='post-list'>
        <?php foreach ($posts as $post): ?>
            <?php include 'template/post.php'; ?>
        <?php endforeach; ?>
    </article>
    <?php include_once 'template/footer.php'; ?>
</body>

</html>