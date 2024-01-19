<!DOCTYPE html>
<html lang="en">
    <?php
        if (isset($users)) {
            foreach ($users as $user):
                include 'template/user.php';
            endforeach;
        }
    ?>
</html>
