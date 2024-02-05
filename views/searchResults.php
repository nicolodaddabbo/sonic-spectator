<!DOCTYPE html>
<html lang='en'>
    <?php
        if (isset($users)) {
            $userRepository = new \UserRepository();
            foreach ($users as $user):
                $profileUserId = $user['id'];
                $profileUserImage = $user['profile_img'];
                $isFollowing = $userRepository->isFollowing($_SESSION['user_id'], $user['id']);
                include 'template/user.php';
            endforeach;
        }
    ?>
</html>
