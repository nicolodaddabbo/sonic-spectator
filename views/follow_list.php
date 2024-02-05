<?php include_once 'template/redirect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<?php include_once 'template/head.php'; ?>

<body>
    <header class='top-bar'>
        <a href="<?= str_contains($_SERVER['HTTP_REFERER'], 'user') ? '/' : $_SERVER['HTTP_REFERER'] ?>">
            <img src='/assets/icons/back.svg' alt='back' class='back' />
        </a>
        <h1 class='title'>
            <?= $header ?>
        </h1>
        <span></span>
    </header>

    <main>
        <section id='follow-list'>
            <?php 
            $userRepository = new \UserRepository();
            foreach ($users as $user_id => $user):
                $profileUserId = $user['id'];
                $profileUserImage = $user['profile_img'];
                $isFollowing = $userRepository->isFollowing($_SESSION['user_id'], $user['id']);
                include 'template/user.php';
            endforeach;
            ?>
        </section>
    </main>

    <script src="/assets/js/postActions.js"></script>
    <script src='/assets/js/followButtonHandler.js'></script>
    <script src="/assets/js/notifications.js"></script>
    <script src="/assets/js/imageErrorHandler.js"></script>
</body>

</html>