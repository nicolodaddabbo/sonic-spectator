<article class='user-container'>
    <span> <?= $user['username'] ?> </span>
    <button class='button-<?= $isFollowing ? 'following' : 'not-following' ?>' id='followButton<?= $profileUserId ?>'>
        <?= $isFollowing ? 'Following' : '+ Follow' ?>
    </button>
</article>
