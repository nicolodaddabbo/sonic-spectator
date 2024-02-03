<header class='top-bar'>
    <a href="<?= str_contains($_SERVER['HTTP_REFERER'], 'user') ? '/' : $_SERVER['HTTP_REFERER'] ?>">
        <img src='/assets/icons/back.svg' alt='back' class='back' />
    </a>
    <span class='title'>Notifications</span>
    <span></span>
</header>