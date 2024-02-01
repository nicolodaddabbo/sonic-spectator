<?php include_once 'template/redirect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'template/head.php'; ?>

<body>
    <?php include_once 'template/create_post_header.php'; ?>
    <main>
        <section class='create-post-container' id='postForm'>
            <section class='create-post-input'>
                <span>Description</span>
                <input type='text' placeholder='Enter post desciption' name='description' id='descriptionInput'>
            </section>
            <section class='create-post-image' id='postImageBox'>
                <span id='addImageText'>Add Image</span>
                <input type='file' id='imageInput' name="image" accept='image/*'>
                <img id='imagePreview' alt='Image Preview'>
            </section>
            <section class='create-post-buttons'>
                <button type='submit' class='create-post-cancel' id='cancelButton'>Cancel</button>
                <button type='submit' class='create-post-post' id='postButton'>Post</button>
            </section>
            <section class='create-post-notification' id='notification-container'></section>
        </section>
    </main>
    <?php include_once 'template/footer.php'; ?>
    <script src="assets/js/createPost.js"></script>
</body>

</html>
