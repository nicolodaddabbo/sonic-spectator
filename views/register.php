<?php
// Redirect if not logged in
if (isset($_SESSION['user'])) {
    header('location:/');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'template/head.php'; ?>

<body>
    <main id='auth'>
        <section class='auth-section'>
            <h1>Register</h1>
            <form action='signUp' method='POST' class='auth-form'>
                <section>
                    <input id='username' type='text' name='username' autocomplete='on' placeholder='Username...'
                        required />
                </section>
                <section>
                    <input id='email' type='email' name='email' autocomplete='on' placeholder='Email...' required />
                </section>
                <section>
                    <input id='password' type='password' name='password' autocomplete='on' placeholder='Password...'
                        required />
                </section>
                <!-- <section>
                    <input id='confirm_password' type='password' name='password' autocomplete='on'
                        placeholder='Confirm Password...' required />
                </section> -->
                <section>
                    <label for='birth_date'>Birth Date</label>
                    <input id='birth_date' type='date' name='birth_date' autocomplete='on' placeholder='Birth Date...'
                        required />
                </section>
                <section>
                    <label for='profile_img'>Profile Image</label>
                    <input type='file' id='profile_img' name="profile_img" accept='image/*'>
                </section>
                <section id='gender-section'>
                    <section id='gender-label'>
                        <label>Gender</label>
                    </section>
                    <section id='gender-selection'>
                        <p>
                            <input id='male' name='gender_id' type='radio' value='1' required />
                            <label for='male'>Male</label>
                        </p>
                        <p>
                            <input id='female' name='gender_id' type='radio' value='2' required />
                            <label for='female'>Female</label>
                        </p>
                        <p>
                            <input id='other' name='gender_id' type='radio' value='3' required />
                            <label for='other'>Other</label>
                        </p>
                    </section>
                </section>
                <section>
                    <span>Already registered? <a class='signup-link' href='/login'>Log In</a></span>
                </section>
                <section id='submit-button'>
                    <input type="submit" value="Sign Up" />
                </section>
            </form>
            <?php
            if (isset($_SESSION['message'])) {
                ?>
                <div class='auth-alert'>
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php

                unset($_SESSION['message']);
            }
            ?>
        </section>
    </main>
</body>

</html>