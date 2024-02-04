<!DOCTYPE html>
<html lang="en">

<?php include_once 'template/head.php'; ?>

<body>
    <?php include_once 'template/create_post_header.php'; ?>
    <main role="main">
        <section class='create-post-container' id='postForm' role="form" aria-labelledby="postFormHeading">
            <h2 id="postFormHeading" class="visually-hidden">Create Post Form</h2>
            <section class='create-post-input'>
                <label for='descriptionInput'>Description</label>
                <input type='text' placeholder='Enter post description' name='description' id='descriptionInput' aria-required="true" autocomplete="off">
            </section>
            <section class='create-post-image' id='postImageBox'>
                <span id='addImageText'>Add Image</span>
                <label for='imageInput' class="visually-hidden">Add Image Input</label>
                <input type='file' id='imageInput' name="image" accept='image/*'>
                <img id='imagePreview' alt='Image Preview' aria-live="polite">
            </section>
            <section class='create-post-buttons'>
                <button type='button' class='create-post-cancel' id='cancelButton'>Cancel</button>
                <button type='button' class='create-post-post' id='postButton'>Post</button>
            </section>
            <section class='create-post-notification' id='notification-container' role="alert" aria-live="polite"></section>
        </section>
    </main>
    <?php include_once 'template/footer.php'; ?>
    <script src="/assets/js/createPost.js"></script>
    <script src="/assets/js/notifications.js"></script>
</body>

</html>