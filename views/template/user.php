<article class='user-container'>
    <span> <?= $user['username'] ?> </span>
    <button class='button-<?= $isFollowing ? 'following' : 'not-following' ?>'
    id='followButton<?= $profileUserId ?>' onclick='toggleFollow(<?= $profileUserId ?>)'>
        <?= $isFollowing ? 'Following' : '+ Follow' ?>
    </button>
</article>
