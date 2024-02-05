<!DOCTYPE html>
<html lang='en'>

<?php include_once 'template/head.php'; ?>

<body>
    <?php include_once 'template/create_post_header.php'; ?>
    <main role='main'>
        <form class='create-post-container' id='postForm' role='form' aria-labelledby='postFormHeading'>
            <h2 id='postFormHeading' class='visually-hidden'>Create Post Form</h2>
            <section class='create-post-input'>
                <label for='artistInput'>Concert Artist</label>
                <textarea placeholder='Enter the band/artist name' name='artist' id='artistInput' autocomplete='off'></textarea>
                <p id='artistTextCounter'>0/35</p>
            </section>
            <section class='create-post-input'>
                <label for='descriptionInput'>Description</label>
                <textarea placeholder='Enter post description' name='description' id='descriptionInput' aria-required='true' autocomplete='off' required></textarea>
                <p id='textCounter'>0/255</p>
            </section>
            <section class='create-post-image' id='postImageBox'>
                <span id='addImageText'>Add Image</span>
                <label for='imageInput' class='visually-hidden'>Upload Image</label>
                <input type='file' id='imageInput' name='image' accept='image/*' required>
                <img src='#' id='imagePreview' alt='Image Preview' aria-live='polite'>
            </section>
            <section class='create-post-buttons'>
                <button type='reset' class='create-post-cancel' id='cancelButton'>Cancel</button>
                <button type='submit' class='create-post-post' id='postButton'>Post</button>
            </section>
            <section class='create-post-notification' id='notification-container' role='alert' aria-live='polite'></section>
        </form>
    </main>
    <?php include_once 'template/footer.php'; ?>
    <script src='/assets/js/createPost.js'></script>
    <script src='/assets/js/notifications.js'></script>
</body>

</html>