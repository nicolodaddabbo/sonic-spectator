<!DOCTYPE html>
<html lang="en">
<?php include_once 'template/head.php'; ?>

<body>
    <?php include_once 'template/create_post_header.php'; ?>
    <main>
        <article class='create-post-container'>
            <section class='create-post-input'>
                <span>Description</span>
                <input type='text' placeholder='Enter post desciption' name='description' id='descriptionInput'>
            </section>
            <section class='create-post-image' id='postImageBox'>
                <span id='addImageText'>Add Image</span>
                <input type='file' id='imageInput' accept='image/*'>
                <img id='imagePreview' alt='Image Preview'>
            </section>
            <section class='create-post-buttons'>
                <button type='submit' class='create-post-cancel' id='cancelButton'>Cancel</button>
                <button type='submit' class='create-post-post' id='postButton'>Post</button>
            </section>
        </article>
    </main>
    <?php include_once 'template/footer.php'; ?>
    <script src="assets/js/createPost.js"></script>
</body>

</html>
