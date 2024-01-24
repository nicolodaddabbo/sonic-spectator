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
    <main>
        <section class='container login-content'>
            <h1 class="page-header text-center">Test Login</h1>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="glyphicon glyphicon-lock"></span> Login
                            </h3>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="signIn">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Email" type="email" name="email"
                                            autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" type="password"
                                            name="password" required>
                                    </div>
                                    <button type="submit" name="login" class="btn btn-lg btn-primary btn-block"><span
                                            class="glyphicon glyphicon-log-in"></span> Login</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <?php
                    if (isset($_SESSION['message'])) {
                        ?>
                        <div class="alert alert-info text-center">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php

                        unset($_SESSION['message']);
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>
</body>

</html>