<!DOCTYPE html>
<html lang='en'>
    <?php
        if (isset($users)) {
            $userRepository = new \UserRepository();
            foreach ($users as $user):
                $profileUserId = $user['id'];
                $isFollowing = $userRepository->isFollowing($_SESSION['user_id'], $profileUserId);
                include 'template/user.php';
            endforeach;
        }
    ?>
</html>
