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
    <main id='auth' role="main">
        <section id='auth-section'>
            <h1>Log In</h1>
            <form action='signIn' method='POST' class='auth-form' role="form" aria-labelledby="loginHeading">
                <h2 id="loginHeading" class="visually-hidden">Log In Form</h2>
                <section class="auth-form-input">
                    <label for='email' class="visually-hidden">Email</label>
                    <input id='email' type='email' name='email' autocomplete='on' placeholder='Email...' required>
                </section>
                <section class="auth-form-input">
                    <label for='password' class="visually-hidden">Password</label>
                    <input id='password' type='password' name='password' autocomplete='on' placeholder='Password...' required>
                </section>
                <section>
                    <span>Don't have an account? <a class='signup-link' href='/register'>Sign up</a></span>
                </section>
                <section id='submit-button'>
                    <input type="submit" value="Log In" role="button">
                </section>
            </form>
            <?php
            if (isset($_SESSION['message'])) {
            ?>
                <div class='alert error' role="alert" aria-live="polite">
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