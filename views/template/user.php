<article class='user-container'>
    <span>
        <a class='user-info-container' href='/user/<?= $profileUserId ?>'>
            <img src='/assets/profiles/<?= $profileUserImage ?>' alt='Profile Image' onerror='handleImageError(this, "profile")'>
            <header>
                <?= $user['username'] ?>
            </header>
        </a>
    </span>
    <?php
    if ($profileUserId != $_SESSION['user_id']) {
    ?>
        <button class='button-<?= $isFollowing ? 'following' : 'not-following' ?>' id='followButton<?= $profileUserId ?>'>
            <?= $isFollowing ? 'Following' : '+ Follow' ?>
        </button>
    <?php
    }
    ?>
</article>
