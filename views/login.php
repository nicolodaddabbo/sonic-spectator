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
        <section class='auth-section'>
            <h1>Log In</h1>
            <form action='signIn' method='POST' class='auth-form' role="form" aria-labelledby="loginHeading">
                <h2 id="loginHeading" class="visually-hidden">Log In Form</h2>
                <section>
                    <input id='email' type='email' name='email' autocomplete='on' placeholder='Email...' required aria-label="Email" />
                </section>
                <section>
                    <input id='password' type='password' name='password' autocomplete='on' placeholder='Password...' required aria-label="Password" />
                </section>
                <section>
                    <span>Don't have an account? <a class='signup-link' href='/register'>Sign up</a></span>
                </section>
                <section id='submit-button'>
                    <input type="submit" value="Log In" role="button" />
                </section>
            </form>
            <?php
            if (isset($_SESSION['message'])) {
            ?>
                <div class='auth-alert' role="alert" aria-live="polite">
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