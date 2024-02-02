<article class='user-container'>
    <span>
        <a href='/user/<?= $user['id'] ?>'>
            <?= $user['username'] ?>
        </a>
    </span>
    <button class='button-<?= $isFollowing ? 'following' : 'not-following' ?>' id='followButton<?= $profileUserId ?>'>
        <?= $isFollowing ? 'Following' : '+ Follow' ?>
    </button>
</article>