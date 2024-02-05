<!DOCTYPE html>
<html lang='en'>
<?php
if (isset($users) && !empty($users)) {
    $userRepository = new \UserRepository();
    foreach ($users as $user):
        $profileUserId = $user['id'];
        $profileUserImage = $user['profile_img'];
        $isFollowing = $userRepository->isFollowing($_SESSION['user_id'], $user['id']);
        include 'template/user.php';
    endforeach;
} else {
    echo "<section id='searchedUserNotFound'>No user found</section>";
}
?>

</html>