<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header('location:login');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'template/head.php'; ?>

<body>
    <?php include_once 'template/header.php'; ?>
    <main>
        <article class='home-content'>
            <?php foreach ($posts as $post): ?>
                <?php include 'template/post.php'; ?>
            <?php endforeach; ?>
        </article>
    </main>
    <?php include_once 'template/footer.php'; ?>
</body>

</html>