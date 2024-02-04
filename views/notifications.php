<?php include_once 'template/redirect.php'; ?>
<?php include_once 'utils/time_elapsed_string.php'; ?>
<!DOCTYPE html>
<html lang='en'>
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
    <script src='/assets/js/markNotifications.js'></script>
</body>

</html>