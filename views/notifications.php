<?php include_once 'template/redirect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'template/head.php'; ?>

<body>
    <?php include_once 'template/notifications_header.php'; ?>
    <main>
        <article class='notifications-container'>
            <?php
            foreach ($notifications as $notification) {
                include 'template/notification.php';
            }
            ?>
        </article>
    </main>
    <script src='/assets/js/notifications.js'></script>
</body>

</html>