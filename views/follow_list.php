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
            <?php foreach ($usernames as $user_id => $username): ?>
                <article class='follow-list-item'>
                    <span>
                        <a href='/user/<?= $user_id ?>'>
                            <?= $username ?>
                        </a>
                    </span>
                </article>
            <?php endforeach; ?>
        </section>
    </main>

    <script src="/assets/js/postActions.js"></script>
    <script src="/assets/js/notifications.js"></script>
</body>

</html>