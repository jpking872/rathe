<?php
session_start();

//destination directory
$_SESSION['upload-dir'] = "C:\Users\jonat\Documents\Rathe\uploads\\";
//default cover art image name and path
$_SESSION['cover-default'] = 'default-cover.jpg';
//default author image name and path
$_SESSION['author-default'] = 'default-author.jpg';

$_SESSION['userid'] = 1;

//assume user is logged in
$_SESSION['loggedIn'] = "yes";

if (empty($_SESSION['step'])) $_SESSION['step'] = 1;

if (isset($_POST['intake']) || isset($_POST['uploads'])) {
    $_SESSION['step'] = 2;
}

$currentStep = $_SESSION['step'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    <title>rAthe!</title>

    <!-- Tags input CSS -->
    <!--link href="dist/css/tagsinput.css" rel="stylesheet"-->

    <!-- Bootstrap core CSS -->
    <!--link href="dist/css/bootstrap.min.css" rel="stylesheet"-->
    <!-- Icons -->
    <link href="css/font-awesome.css" rel="stylesheet">

    <!-- Custom styles for this dashboard -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid" id="wrapper">
    <div class="row">
        <?php require __DIR__ . '/../includes/dashboard_nav.php'; ?>

        <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
            <header class="page-header row justify-center">
                <div class="col-md-6 col-lg-8">
                    <h1 class="float-left text-center text-md-left">New Title Intake</h1>
                </div>

                <?php require __DIR__ . '/../includes/profileNav.php'; ?>

                <div class="clear"></div>
            </header>


                <div class="form-group row">
                    <div class="col-sm-10">
                        <ul class="list-unstyled multi-steps form-text">
                            <li>INTAKE</li>
                            <li class="is-active">Uploads</li>
                            <li>SEO</li>
                            <li>How to receive payments</li>
                        </ul>
                    </div>
                    <div class="col-sm-2"></div>

                </div>

                <section class="row form-text">
                    <div class="col-sm-12">
                        <section class="row">
                            <div class="col-12">

                                <div class="card mb-4">
                                    <div class="card-block">
                                        <p>Files successfully uploaded.</p>
                                    </div>
                                </div>
                        </section>
                    </div>
                </section>

            <section class="row">
                <div class="col-12 mt-1 mb-4 text-center">
                    <span class="copyright">Copyright &copy; <?php echo date("Y"); ?> rAthe!</span>
                </div>
            </section>
    </div>
    </section>
    </main>
</div>

</div>


<!-- Bootstrap core JavaScript
================================================== -->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="dist/js/bootstrap.min.js"></script>


</body>
</html>