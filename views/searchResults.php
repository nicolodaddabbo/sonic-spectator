<!DOCTYPE html>
<html lang="en">
    <?php
        if (isset($users)) {
            $userRepository = new \UserRepository();
            foreach ($users as $user):
                $profileUserId = $user['id'];
                $isFollowing = $userRepository->isFollowing(/*$loggedInUserId*/ 1, $profileUserId);
                include 'template/user.php';
            endforeach;
        }
    ?>
</html>
