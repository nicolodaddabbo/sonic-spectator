<header class='top-bar'>
    <?php if ($_SERVER['REQUEST_URI'] !== "/profile") { ?>
        <img src='/assets/icons/back.svg' alt='back' class='back' />
    <?php } ?>
    <span class='title'>
        <?= $_SERVER['REQUEST_URI'] === "/profile" ? $_SESSION['user'] : $user['username'] ?>
    </span>
    <section class='profile-top-bar-actions'>
        <?php
        if ($_SERVER['REQUEST_URI'] === "/profile") {
            ?>
            <a href='/logOut'>
                <img src='/assets/icons/logout.svg' class='filter-red' alt='logout' />
            </a>
            <?php
        } ?>
        <img src='/assets/icons/notification.svg' alt='notifications' />
    </section>
</header>