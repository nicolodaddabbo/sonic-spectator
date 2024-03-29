<?php include_once 'template/redirect.php'; ?>
<!DOCTYPE html>
<html lang='en'>

<?php include_once 'template/head.php'; ?>
<?php include_once 'utils/time_elapsed_string.php'; ?>

<body>
    <?php include_once 'template/header.php'; ?>

    <main>
        <section id='post-list'>
            <?php foreach ($posts as $post): ?>
                <?php include 'template/post.php'; ?>
            <?php endforeach; ?>
        </section>
    </main>

    <?php include_once 'template/footer.php'; ?>

    <script src='/assets/js/postActions.js'></script>
    <script src='/assets/js/notifications.js'></script>
    <script src="/assets/js/imageErrorHandler.js"></script>
</body>

</html>