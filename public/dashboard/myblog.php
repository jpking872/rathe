<?php
/*require __DIR__.'/../../config/connector.php';
require __DIR__.'/../../config/checkPermittedUsers.php';

// email class
require __DIR__.'/../../config/email.dashboard.class.php';

//Initialise CSRFGuard library
//include_once __DIR__ .'/../../owasp/libs/csrf/csrfprotector.php';
//csrfProtector::init();
*/

function filterStr($arg) {
    return $arg;
}

// clean tabs
$tab = filterStr($_GET['tab'] ?? '');

//security check
if(strlen($tab) > 11)
{
    redirectUrl('logout.php');
}

if(isset($tab) && $tab == 'newposts')
{
    $basic = false;
    $newposts = true;
    $allposts = false;
    $drafts = false;
}
else if(isset($tab) && $tab == 'allposts')
{
    $basic = false;
    $newposts = false;
    $allposts = true;
    $drafts = false;
}
else if(isset($tab) && $tab == 'drafts')
{
    $basic = false;
    $newposts = false;
    $allposts = false;
    $drafts = true;
}
else {

    $basic = true;
    $newposts = false;
    $allposts = false;
    $drafts = false;
}


// map error in an array
$showError = array();

if(isset($_POST['blog_info']))
{
    // sanitize $_POST
    $blogTitle = filterStr($_POST['blogTitle']);
    $blogTags = filterStr($_POST['blogTags']);
    $mainContent = filterStr($_POST['mainContent']);

    if(trim($blogTitle) == '' || strlen($blogTitle) < 2 || strlen($blogTitle) > 50)
    {
        $showError[] = "Invalid blog title";
    }

    if(trim($blogTags) == '' || strlen($blogTags) < 3 || strlen($blogTags) > 100)
    {
        $showError[] = "Invalid blog tags";
    }

    if(trim($mainContent) == '' || strlen($mainContent) < 3 || strlen($mainContent) > 2000)
    {
        $showError[] = "Invalid main content";
    }

    // No error
    if(count($showError) == 0)
    {

        // update global users table
        $updateTbl = 'Bind_Global_Users';

        // build query
        $data = array(
            'BlogTitle' => $blogTitle,
            'BlogTags' => $blogTags,
            'MainContent' => $mainContent
        );

        // update record
        $update = accountSetup($updateTbl, $bid, $data);
        $success = '<div id="success" class="alert alert-success"><strong>Profile Details Updated</strong></div>';
    }

}


// new posts tab
if(isset($_POST['newposts']))
{
    // sanitize $_POST
    $authorWebsite = filterStr($_POST['authorwebsite']);
    $authorBlog = filterStr($_POST['blog']);
    $facebookLink = filterStr($_POST['facebook_link']);
    $twitterLink = filterStr($_POST['twitter_link']);
    $linkedinLink = filterStr($_POST['linkedin_link']);
    $instagramLink = filterStr($_POST['instagram_link']);
    $goodreadsLink = filterStr($_POST['goodreads_link']);
    $pinterestLink = filterStr($_POST['pinterest_link']);


    if(!empty($authorWebsite))
    {
        if(strlen($authorWebsite) < 3 || strlen($authorWebsite) > 255)
        {
            $showError[] = SETUP_AUTHOR_WEBSITE;
        }
    }

    if(!empty($authorBlog))
    {
        if(strlen($authorBlog) < 3 || strlen($authorBlog) > 255)
        {
            $showError[] = SETUP_AUTHOR_BLOG;
        }
    }

    if(!empty($facebookLink))
    {
        if(strlen($facebookLink) < 3 || strlen($facebookLink) > 255)
        {
            $showError[] = SETUP_FACEBOOK_ERROR;
        }
    }

    if(!empty($twitterLink))
    {
        if(strlen($twitterLink) < 3 || strlen($twitterLink) > 255)
        {
            $showError[] = SETUP_TWITTER_ERROR;
        }
    }

    if(!empty($linkedinLink))
    {
        if(strlen($linkedinLink) < 3 || strlen($linkedinLink) > 255)
        {
            $showError[] = SETUP_LINKEDIN_ERROR;
        }
    }

    if(!empty($instagramLink))
    {
        if(strlen($instagramLink) < 3 || strlen($instagramLink) > 255)
        {
            $showError[] = SETUP_INSTAGRAM_ERROR;
        }
    }

    if(!empty($goodreadsLink))
    {
        if(strlen($goodreadsLink) < 3 || strlen($goodreadsLink) > 255)
        {
            $showError[] = SETUP_GOODREADS_ERROR;
        }
    }

    if(!empty($goodreadsLink))
    {
        if(strlen($pinterestLink) < 3 || strlen($pinterestLink) > 255)
        {
            $showError[] = SETUP_PINTEREST_ERROR;
        }
    }

    // if no error detected
    if(count($showError) == 0)
    {

        // update global users table
        $updateTbl = 'Bind_Seo_Marketing';

        // build query
        $data = array(
            'Bid' => $bid,
            'AuthorWebsite' => $authorWebsite,
            'AuthorBlog' => $authorBlog,
            'FacebookLink' => $facebookLink,
            'TwitterLink' => $twitterLink,
            'LinkedinLink' => $linkedinLink,
            'InstagramLink' => $instagramLink,
            'GoodreadsLink' => $goodreadsLink,
            'PinterestLink' => $pinterestLink
        );

        // update record
        $update = accountSetup($updateTbl, $bid, $data);
        $success = '<div id="success" class="alert alert-success"><strong>Marketing Details Updated</strong></div>';
    }

}

// all posts tab
if(isset($_POST['allposts']))
{

    $fw = verifyPassword($bid);

    // sanitize $_POST
    $currentPass = filterStr($_POST['current_pass']);
    $newPass = filterStr($_POST['new_pass']);
    $confirmPass = filterStr($_POST['confirm_pass']);


    if(trim($currentPass) == '' || strlen($currentPass) < STR_PASSWORD_MIN || strlen($currentPass) > STR_PASSWORD_MAX)
    {
        $showError[] = 'Please enter your current password';
    }

    if(trim($newPass) == '' || strlen($newPass) < STR_PASSWORD_MIN || strlen($newPass) > STR_PASSWORD_MAX)
    {
        $showError[] = 'Please create a new password';
    }

    if(preg_match("/^.*(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $newPass) === 0)
    {
        $showError[] = SIGNUP_INVALID_MORE_PASSWORD;
    }

    if(trim($confirmPass) == '' || $confirmPass != $newPass)
    {
        $showError[] = 'Your new and confirmation passwords do not match';
    }

    if (!password_verify($currentPass, $fw['Password']))
    {
        $showError[] = 'Your current password is invalid';
    }

    // No error
    if(count($showError) == 0)
    {

        // update global users table
        $updateTbl = 'Bind_Global_Users';

        // build query
        $password = password_hash($newPass, PASSWORD_DEFAULT);
        $data = array('Password' => $password);

        // update record
        $update = accountSetup($updateTbl, $bid, $data);
        $success = '<div id="success" class="alert alert-success"><strong>Account password has been changed</strong></div>';

        // Build query and send reset password confirmation
        $emailTemplate = array('');
        $templateDir = '../templates/password-changed.phtml';

        // Send email here
        sendTemplateEmail($emailTemplate, $templateDir, $userEmail, APP_SUCCESSFUL_RESET);
    }

}
// drafts tab
if(isset($_POST['drafts']))
{
    echo "drafts page";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">
    <title><?php echo APP_TITLE_DASH; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="css/font-awesome.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <style type="text/css">
        .navbar {
            background-color: #fcfffd;
        }
        .navbar .navbar-brand {
            color: #8e9192;
        }
        .navbar .navbar-brand:hover,
        .navbar .navbar-brand:focus {
            color: #777678;
        }
        .navbar .navbar-text {
            color: #8e9192;
        }
        .navbar .navbar-text a {
            color: #777678;
        }
        .navbar .navbar-text a:hover,
        .navbar .navbar-text a:focus {
            color: #777678;
        }
        .navbar .navbar-nav .nav-link {
            color: #8e9192;
            border-radius: .25rem;
            margin: 0 0.25em;
        }
        .navbar .navbar-nav .nav-link:not(.disabled):hover,
        .navbar .navbar-nav .nav-link:not(.disabled):focus {
            color: #777678;
        }
        .navbar .navbar-nav .nav-item.active .nav-link,
        .navbar .navbar-nav .nav-item.active .nav-link:hover,
        .navbar .navbar-nav .nav-item.active .nav-link:focus,
        .navbar .navbar-nav .nav-item.show .nav-link,
        .navbar .navbar-nav .nav-item.show .nav-link:hover,
        .navbar .navbar-nav .nav-item.show .nav-link:focus {
            color: #777678;
            background-color: #dee8d2;
        }
        .navbar .navbar-toggle {
            border-color: #dee8d2;
        }
        .navbar .navbar-toggle:hover,
        .navbar .navbar-toggle:focus {
            background-color: #dee8d2;
        }
        .navbar .navbar-toggle .navbar-toggler-icon {
            color: #8e9192;
        }
        .navbar .navbar-collapse,
        .navbar .navbar-form {
            border-color: #8e9192;
        }
        .navbar .navbar-link {
            color: #8e9192;
        }
        .navbar .navbar-link:hover {
            color: #777678;
        }

        @media (max-width: 575px) {
            .navbar-expand-sm .navbar-nav .show .dropdown-menu .dropdown-item {
                color: #8e9192;
            }
            .navbar-expand-sm .navbar-nav .show .dropdown-menu .dropdown-item:hover,
            .navbar-expand-sm .navbar-nav .show .dropdown-menu .dropdown-item:focus {
                color: #777678;
            }
            .navbar-expand-sm .navbar-nav .show .dropdown-menu .dropdown-item.active {
                color: #777678;
                background-color: #dee8d2;
            }
        }

        @media (max-width: 767px) {
            .navbar-expand-md .navbar-nav .show .dropdown-menu .dropdown-item {
                color: #8e9192;
            }
            .navbar-expand-md .navbar-nav .show .dropdown-menu .dropdown-item:hover,
            .navbar-expand-md .navbar-nav .show .dropdown-menu .dropdown-item:focus {
                color: #777678;
            }
            .navbar-expand-md .navbar-nav .show .dropdown-menu .dropdown-item.active {
                color: #777678;
                background-color: #dee8d2;
            }
        }

        @media (max-width: 991px) {
            .navbar-expand-lg .navbar-nav .show .dropdown-menu .dropdown-item {
                color: #8e9192;
            }
            .navbar-expand-lg .navbar-nav .show .dropdown-menu .dropdown-item:hover,
            .navbar-expand-lg .navbar-nav .show .dropdown-menu .dropdown-item:focus {
                color: #777678;
            }
            .navbar-expand-lg .navbar-nav .show .dropdown-menu .dropdown-item.active {
                color: #777678;
                background-color: #dee8d2;
            }
        }

        @media (max-width: 1199px) {
            .navbar-expand-xl .navbar-nav .show .dropdown-menu .dropdown-item {
                color: #8e9192;
            }
            .navbar-expand-xl .navbar-nav .show .dropdown-menu .dropdown-item:hover,
            .navbar-expand-xl .navbar-nav .show .dropdown-menu .dropdown-item:focus {
                color: #777678;
            }
            .navbar-expand-xl .navbar-nav .show .dropdown-menu .dropdown-item.active {
                color: #777678;
                background-color: #dee8d2;
            }
        }

        .navbar-expand .navbar-nav .show .dropdown-menu .dropdown-item {
            color: #8e9192;
        }
        .navbar-expand .navbar-nav .show .dropdown-menu .dropdown-item:hover,
        .navbar-expand .navbar-nav .show .dropdown-menu .dropdown-item:focus {
            color: #777678;
        }
        .navbar-expand .navbar-nav .show .dropdown-menu .dropdown-item.active {
            color: #777678;
            background-color: #dee8d2;
        }
    </style>

</head>
<body>


<div class="container-fluid" id="wrapper">
    <div class="row">
        <?php require __DIR__.'/../includes/dashboard_nav.php'; ?>
        <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
            <header class="page-header row justify-center">
                <div class="col-md-6 col-lg-8" >
                    <h1 class="float-left text-center text-md-left">My Blog</h1>
                </div>
                <?php require __DIR__.'/../includes/profileNav.php'; ?>
                <div class="clear"></div>
            </header>



            <section class="row form-text" >
                <div class="col-12">

                    <section class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <?php if($basic){ ?>
                                    <div class="row">
                                        <div class="col-md-6"></div>

                                        <div class="col-md-6">
                                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                                <div class="collapse navbar-collapse" id="navbarNav">
                                                    <ul class="navbar-nav">
                                                        <li class="nav-item active">
                                                            <a class="nav-link active" href="myblog.php">Info <span class="sr-only">(current)</span> </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="?tab=newposts">New Posts </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="?tab=allposts">All Posts </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="?tab=drafts">Drafts </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="https://rathehelp.freshdesk.com/support/solutions" target="blank">Help</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>

                                    <form id="blog_info" action="" method="POST" autocomplete="off" novalidate>

                                        <div class="py-2 mx-4 mb-3">
                                            <div class="mb-3">
                                                <h4>
                                                    My Blog Information
                                                </h4>

                                            </div>
                                            <?php if(isset($_POST['blog_info'])) : ?>

                                                <?php foreach ($showError as $error) : ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        <span class="fa fa-exclamation-circle"> <?php echo $error; ?></span>
                                                        <br>
                                                    </div>
                                                <?php endforeach ?>

                                                <?php echo $success ?? ''; ?>
                                            <?php endif ?>




                                            <div class="px-4">


                                                <div class="control-group">
                                                    <br>
                                                    <?php

                                                    //$row = authorInfo($bid);
                                                    $row = true;
                                                    if($row) {
                                                    ?>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-9">
                                                            <label for="blogTitle"><strong>Blog Title</strong></label>
                                                            <input value="<?php if(isset($_POST['blog_info'])) { echo $blogTitle; } else { echo $row['blogTitle'] ?? ''; } ?>" type="text" class="form-control" id="blogTitle" name="blogTitle" maxlength="50" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-9">
                                                            <label for="mainContent"><strong>Main Content</strong></label>
                                                            <textarea class="form-control" id="mainContent" name="mainContent" maxlength="2000" rows="12">
                                                                <?php if(isset($_POST['blog_info'])) { echo $mainContent; } else { echo $row['mainContent']; } ?>
                                                            </textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-9">
                                                            <label for="blogTags"><strong>Blog Tags</strong></label>
                                                            <input value="<?php echo $row['blogTags'] ?? '';?>"
                                                                   type="text" class="form-control" id="blogTags" name="blogTags" required>

                                                        </div>
                                                    </div>

                                                </div>
                                                <?php  } else {

                                                    echo "<meta http-equiv='Refresh' Content='0; url=./'>";
                                                    exit;
                                                }
                                                ?>

                                                <br />
                                                <div class="row">

                                                    <div class="col-4">
                                                        <button type="button" class="btn btn-danger" onclick="location.href = 'index.php';"> Close
                                                        </button>

                                                    </div>

                                                    <div class="col-8">

                                                        <button type="submit" name="blog_info" class="btn save-button">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>

                                <?php } if($newposts){ ?>
                                    <div class="row">
                                        <div class="col-md-6"></div>

                                        <div class="col-md-6">
                                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                                <div class="collapse navbar-collapse" id="navbarNav">
                                                    <ul class="navbar-nav">
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="myblog.php">Info </a>
                                                        </li>
                                                        <li class="nav-item active">
                                                            <a class="nav-link active" href="?tab=newposts">New Posts
                                                                <span class="sr-only">(current)</span></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="?tab=allposts">All Posts </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="?tab=drafts">Drafts </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="https://rathehelp.freshdesk.com/support/solutions" target="blank">Help</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>

                                    <form id="newposts" action="" method="POST" autocomplete="off" novalidate>

                                        <div class="py-2 mx-4 mb-3">
                                            <div class="mb-3">
                                                <h4>
                                                    New Posts
                                                </h4>

                                            </div>
                                            <?php if(isset($_POST['marketing'])) : ?>

                                                <?php foreach ($showError as $error) : ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        <span class="fa fa-exclamation-circle"> <?php echo $error; ?></span>
                                                        <br>
                                                    </div>
                                                <?php endforeach ?>

                                                <?php echo $success ?? ''; ?>
                                            <?php endif ?>




                                            <div class="px-4">


                                                <div class="control-group">
                                                    <br>
                                                    <?php

                                                    $list = marketingInfo($bid);
                                                    if($list) {
                                                    ?>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="authorwebsite">
                                                                <strong>Author's Website</strong>
                                                            </label>
                                                            <input value="<?php if(isset($_POST['marketing'])) { echo $authorWebsite; } else { echo $list['AuthorWebsite'] ?? ''; } ?>" type="text" class="form-control" id="authorwebsite" name="authorwebsite" maxlength="255" placeholder="Enter your website URL">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="blog">
                                                                <strong>Author's Blog</strong>
                                                            </label>
                                                            <input value="<?php if(isset($_POST['marketing'])) { echo $authorBlog; } else { echo $list['AuthorBlog'] ?? ''; } ?>" type="text" class="form-control" id="blog" name="blog" maxlength="255" placeholder="Enter your blog URL">
                                                        </div>


                                                    </div>

                                                    <br />
                                                    <label class="modal-warning">
                                                        <strong>Social Media Accounts</strong>
                                                    </label>

                                                    <div class="control-group">
                                                        <br />
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <div class="input-group input-group-sm mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Facebook &nbsp;&nbsp;</span>
                                                                    </div>
                                                                    <input value="<?php if(isset($_POST['marketing'])) { echo $facebookLink; } else { echo $list['FacebookLink'] ?? ''; } ?>" id="facebook_link" type="text" name="facebook_link" class="form-control" placeholder="Enter your Facebook Username">
                                                                </div>
                                                                <div class="input-group input-group-sm mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Twitter &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                                    </div>
                                                                    <input value="<?php if(isset($_POST['marketing'])) { echo $twitterLink; } else { echo $list['TwitterLink'] ?? ''; } ?>" id="twitter_link" type="text" name="twitter_link" class="form-control " placeholder="Enter your Twitter Handle">
                                                                </div>

                                                                <div class="input-group input-group-sm mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="inputGroup-sizing-sm">LinkedIn &nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                                    </div>
                                                                    <input value="<?php if(isset($_POST['marketing'])) { echo $linkedinLink; } else { echo $list['LinkedinLink'] ?? ''; } ?>" id="linkedin_link" type="text" name="linkedin_link" class="form-control" placeholder="Enter your LinkedIn Profile" >
                                                                </div>
                                                                <div class="input-group input-group-sm mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Instagram &nbsp;</span>
                                                                    </div>
                                                                    <input value="<?php if(isset($_POST['marketing'])) { echo $instagramLink; } else { echo $list['InstagramLink'] ?? ''; } ?>" id="instagram_link" type="text" name="instagram_link" class="form-control " placeholder="Enter your Instagram Username" >
                                                                </div>
                                                                <div class="input-group input-group-sm mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="inputGroup-sizing-sm">GoodReads</span>
                                                                    </div>
                                                                    <input value="<?php if(isset($_POST['marketing'])) { echo $goodreadsLink; } else { echo $list['GoodreadsLink'] ?? ''; } ?>" id="goodreads_link" type="text" name="goodreads_link" class="form-control " placeholder="Enter your Goodreads email" >
                                                                </div>
                                                                <div class="input-group input-group-sm mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Pinterest &nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                                    </div>
                                                                    <input value="<?php if(isset($_POST['marketing'])) { echo $pinterestLink; } else { echo $list['PinterestLink'] ?? ''; } ?>" id="pinterest_link" type="text" name="pinterest_link" class="form-control " placeholder="Enter your Pinterest Username" >
                                                                </div>
                                                            </div>


                                                        </div>


                                                    </div>
                                                </div>
                                                <?php } else {

                                                    echo "<meta http-equiv='Refresh' Content='0; url=./'>";
                                                    exit;
                                                }
                                                ?>
                                                <div class="row">

                                                    <div class="col-4">
                                                        <button type="button" class="btn btn-danger" onclick="location.href = 'index.php';"> Close
                                                        </button>

                                                    </div>

                                                    <div class="col-8">

                                                        <button type="submit" name="newposts" class="btn save-button">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>

                                <?php } if($allposts){ ?>
                                    <div class="row">
                                        <div class="col-md-6"></div>

                                        <div class="col-md-6">
                                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                                <div class="collapse navbar-collapse" id="navbarNav">
                                                    <ul class="navbar-nav">
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="myblog.php">Info </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="?tab=newposts">
                                                                New Posts
                                                            </a>
                                                        </li>
                                                        <li class="nav-item active">
                                                            <a class="nav-link active" href="?tab=allposts">All Posts
                                                                <span class="sr-only">(current)</span></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="?tab=drafts">
                                                                Drafts
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="https://rathehelp.freshdesk.com/support/solutions" target="blank">Help</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>

                                    <form id="allposts" action="" method="POST" autocomplete="off">

                                        <div class="py-2 mx-4 mb-3">
                                            <div class="mb-3">
                                                <h4>
                                                    All Posts
                                                </h4>

                                            </div>
                                            <?php if(isset($_POST['change_pass'])) : ?>

                                                <?php foreach ($showError as $error) : ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        <span class="fa fa-exclamation-circle"> <?php echo $error; ?></span>
                                                        <br>
                                                    </div>
                                                <?php endforeach ?>

                                                <?php echo $success ?? ''; ?>
                                            <?php endif ?>

                                            <div class="px-4">

                                                <div class="control-group">
                                                    <br>
                                                    <?php

                                                    $row = authorInfo($bid);
                                                    if($row) {
                                                    ?>


                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="current_pass">
                                                                <strong>Enter current password</strong>
                                                            </label>
                                                            <input value="<?php if(isset($_POST['change_pass'])) { echo $currentPass; } ?>" type="password" class="form-control" id="current_pass" name="current_pass" maxlength="20" required style='width:18.9em; height: 37px'>
                                                        </div>

                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="new_pass"><strong>New password</strong></label>
                                                            <input value="<?php if(isset($_POST['change_pass'])) { echo $newPass; } ?>" type="password" class="form-control" id="new_pass" name="new_pass" maxlength="20" required style='width:18.9em; height: 37px'>
                                                        </div>

                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <ul class="list-inline">
                                                            <small class="text-muted">
                                                                <li>One lowercase character</li>
                                                                <li>One uppercase character</li>
                                                                <li>One number</li>
                                                                <li>8 characters minimum</li>
                                                            </small>
                                                        </ul>
                                                    </div>


                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="confirm_pass"><strong>Confirm new password</strong></label>
                                                            <input value="" type="password" class="form-control" id="confirm_pass" name="confirm_pass" maxlength="20" required style='width:18.9em; height: 37px'>
                                                        </div>

                                                    </div>


                                                </div>
                                                <?php } else {

                                                    echo "<meta http-equiv='Refresh' Content='0; url=./'>";
                                                    exit;
                                                }
                                                ?>
                                                <div class="row">
                                                    <br>

                                                    <div class="col-8">
                                                        <br>
                                                        <button type="submit" name="allposts" class="btn save-button">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                <?php } if($drafts) { ?>

                                    <div class="row">
                                        <div class="col-md-6"></div>

                                        <div class="col-md-6">
                                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                                <div class="collapse navbar-collapse" id="navbarNav">
                                                    <ul class="navbar-nav">
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="myblog.php">Info </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="?tab=newposts">
                                                                New Posts
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="?tab=allposts">All Posts</a>
                                                        </li>
                                                        <li class="nav-item active">
                                                            <a class="nav-link active" href="?tab=drafts">
                                                                Drafts
                                                                <span class="sr-only">(current)</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="https://rathehelp.freshdesk.com/support/solutions" target="blank">Help</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>

                                    <form id="drafts" action="" method="POST" autocomplete="off">

                                        <div class="py-2 mx-4 mb-3">
                                            <div class="mb-3">
                                                <h4>
                                                    Drafts
                                                </h4>

                                            </div>
                                            <?php if(isset($_POST['change_pass'])) : ?>

                                                <?php foreach ($showError as $error) : ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        <span class="fa fa-exclamation-circle"> <?php echo $error; ?></span>
                                                        <br>
                                                    </div>
                                                <?php endforeach ?>

                                                <?php echo $success ?? ''; ?>
                                            <?php endif ?>

                                            <div class="px-4">

                                                <div class="control-group">
                                                    <br>
                                                    <?php

                                                    $row = authorInfo($bid);
                                                    if($row) {
                                                    ?>


                                                    <div class="form-row">


                                                    </div>



                                                </div>
                                                <?php } else {

                                                    echo "<meta http-equiv='Refresh' Content='0; url=./'>";
                                                    exit;
                                                }
                                                ?>
                                                <div class="row">
                                                    <br>

                                                    <div class="col-8">
                                                        <br>
                                                        <button type="submit" name="drafts" class="btn save-button">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>


                                <?php } ?>


                            </div>
                        </div>
                    </section>



                    <?php// require __DIR__.'/../includes/footerNav.php'; ?>
                </div>
            </section>

        </main>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="dist/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script type="text/javascript">


    $( "#blog_info" ).validate( {
        rules: {

            blogTitle: {
                required: true,
                minlength: 2
            },
            subTitle: {
                required: true,
                minlength: 2
            },
            blogTags: {
                required: true,
                minlength: 3
            },
            mainContent: {
                required: true,
                minlength: 3
            },
            conclusion: {
                required: true,
                minlength: 3
            }

        },
        messages: {

            blogTitle: {
                required: "Please enter your blog title",
                minlength: "Your blog title cannot be verified"
            },
            subTitle: {
                required: "Please enter your blog subtitle",
                minlength: "Your subtitle cannot be verified"
            },
            blogTags: {
                required: "Please enter your blog tags",
                minlength: "Your blog tags cannot be verified"
            },
            mainContent: {
                required: "Please enter your main content",
                minlength: "Your main content cannot be verified"
            },
            conclusion: {
                required: "Please enter your conclusion",
                minlength: "Your conclusion cannot be verified"
            },


        },
        errorElement: "span",
        errorPlacement: function ( error, element ) {
            // Add the `invalid-feedback` class to the error element
            error.addClass( "invalid-feedback" );

            error.insertAfter(element); // <- default
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
        },

        unhighlight: function (element, errorClass, validClass) {
            $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
        }
    });


    // auto close the success div
    window.setTimeout(function() {
        $("#success").fadeTo(2000, 0).slideUp(500, function() {
            $(this).hide();
        });
    }, 3000);


    //prevent page refresh
    if ( window.history.replaceState )
    {
        window.history.replaceState( null, null, window.location.href );
    }
</script>


</body>
</html>
