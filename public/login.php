<?php
session_start();

if (isset($_POST['submit'])) {
    $_SESSION['step'] = 1;
    header("Location: dashboard/new_title.php");
    exit;

}
?>

<!doctype html>
<html lang="en">
<?php require __DIR__ . '/includes/header.php'; ?>
<body class="main-login">
<?php require __DIR__ . '/includes/topNav.php'; ?>

<div class="container-fluid ">
    <div class="row">
        <div class="col"></div>

        <div class="col">

            <div class="login-form-panel login-panel">
                <div class="">
                    <h2>Demo</h2>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form id="loginForm" method="post" action="" autocomplete="off">
                                <div class="login-input-group">
                                    <input name="email" autofocus="" type="email" class="" id="email"
                                           value="help@rathe.app">
                                </div>

                                <div class="custom-input login-input-group">
                                    <input name="password" type="password" class="" id="password" placeholder="Password"
                                           maxlength="20">

                                    <br>
                                    <small class="text-muted">Password: PDemo123</small>
                                </div>

                                <div class="text-center">
                                    <button name="submit" type="submit" class="btn btn-success btn--login">

                                        Login >

                                    </button>
                                </div>

                                <div> &nbsp;</div>

                                <div class="text-center">
                                    <a href="forgot.php" class="">Forgot your password?</a>
                                </div>


                                <div> &nbsp;</div>
                                <div> &nbsp;</div>

                                <p class="login-signup-note">New User?
                                    <button name="signup" class="btn btn-secondary btn-sm" type="button"
                                            onclick="location.href = 'signup.php';">
                                        Sign Up
                                    </button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col"></div>
    </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script type="text/javascript">

    $("#loginForm").validate({
        rules: {
            password: {
                required: true,
                minlength: 8
            },
        },
        messages: {
            password: {
                required: "Please provide a password",
                minlength: "We cannot verify your password"
            },
        },

        errorElement: "span",
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");

            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        }
    });

</script>


</body>
</html>
