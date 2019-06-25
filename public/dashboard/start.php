<?php

$personal = true;
$marketing = false;
$terms = false;
$success = false;


if(isset($_POST['personal']))
{
    //form tabs
    $personal = false;
    $marketing = true;
    $terms = false;
    $success = false;
}

else if(isset($_POST['marketing']))
{
    //form tabs
    $personal = false;
    $marketing = false;
    $terms = true;
    $success = false;
}

else if(isset($_POST['terms']))
{
    //form tabs
    $personal = false;
    $marketing = false;
    $terms = false;
    $success = true;
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
    <title>rAthe!</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    
    <!-- Custom style -->
    <link href="css/style.css" rel="stylesheet">

</head>
<body>
    <div class="container-fluid" id="wrapper">
        <div class="row">
            <!-- NAV -->
            <nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
                <h1 class="site-title"><a href="#"> rĀthe! LOGO</a></h1>
                                                    
                <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
                <ul class="nav nav-pills flex-column sidebar-nav">
                    <li class="nav-item"><a class="nav-link active" href="index.php"><em class="fa fa-dashboard"></em> Skip Setup <span class="sr-only">(current)</span></a></li>
                    
                </ul>
                <a href="../login.php" class="logout-button"><em class="fa fa-power-off"></em> Signout</a>
            </nav>
            <!-- end NAV -->

            <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
                <header class="page-header row justify-center">
                    <div class="col-md-6 col-lg-8" >
                        <h1 class="float-left text-center text-md-left">Account Setup</h1>
                    </div>

                    <div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right">
                        <a class="btn btn-stripped dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="images/letters/k.png" alt="profile image" class="circle float-left profile-photo" width="36" height="36">
                        <div class="username mt-1">
                            <h4 class="mb-1">Katie</h4>
                            
                        </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#setup"><em class="fa fa-user-circle mr-1"></em> View Profile
                            </a>
                            <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#setup"><em class="fa fa-sliders mr-1"></em> Preferences</a>
                            <a class="dropdown-item" href="logout.php"><em class="fa fa-power-off mr-1"></em> Logout</a>
                        </div>

                    </div>

                    <div class="clear"></div>
                </header>
                

                <?php if($personal){ ?>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <ul class="list-unstyled multi-steps form-text">
                            <li class="is-active">Personal Details</li>
                            <li>Marketing (SEO)</li>
                            <li>Terms of Service</li>
                            <li>Finished</li>
                        </ul>
                    </div>
                    <div class="col-sm-2"> </div>
                    
                </div>


                <section class="row form-text">
                    <div class="col-sm-12">
                        <section class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-block">
                                        <p class="card-title form-text">Please complete the form below <br> 
                                        All fields marked with an asterisk <span class="asterik-color">(*)</span> are required: </p>

                                        <!-- errror div
                                        <div class="row">
                                            <div class="col-4"></div>
                                            <div class="col-8"> 
                                                <div class="alert alert-danger" role="alert">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        -->
                                        

                                        <form id="personal" action="" method="POST" autocomplete="off" novalidate>
                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label">
                                                Legal/Account Holder Name <span class="asterik-color">*</span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input id="legalName" type="text" name="legalName" class="form-control" value="" placeholder="This is not your pen name, pseudonym, nom de plume" maxlength="25">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label">
                                                Phone Number <span class="asterik-color">*</span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input id="phone" type="text" name="phone" class="form-control" value="512-967-1095" maxlength="15">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label">
                                                Notification Method <span class="asterik-color">*</span>
                                                </label>
                                                <div class="col-md-8">
                                                    
                                                    <select id="notify" name="notify" class="custom-select form-control">
                                                        <?php
                                                        $notifyList = array(
                                                                            "How do you wish to receive notifications?",
                                                                            "Email",
                                                                            "Text"
                                                                           );

                                                        foreach($notifyList as $key=>$value):
                                                        ?>
                                                        <option value="<?php echo $key; ?>" <?php if(isset($notify) &&  $notify == $key){ echo 'selected=selected'; } ?>>
                                                            <?php echo $value; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label">
                                                Mobile Phone Carrier <span class="asterik-color">*</span>
                                                </label>
                                                <div class="col-md-8">
                                                    <select id="carriers" class="custom-select form-control" name="carriers">
                                                        <option value="0">Select An Option</option>
                                                        <option value="1">AT&amp;T</option>
                                                        <option value="2">Boost</option>
                                                        <option value="3">Sprint</option>
                                                        <option value="4">T-Mobile</option>
                                                        <option value="5">US Cellular</option>
                                                        <option value="6">Verizon</option>
                                                        <option value="7">My phone carrier is not shown on this list</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- if new carrier is selected show this div -->
                                            <div style='display: none;' class="form-group row" id="new_carrier_div">
                                                <label class="col-md-4 col-form-label">
                                                
                                                </label>
                                                <div class="col-md-8">
                                                    <input id="new_carrier" type="text" name="new_carrier" class="form-control" placeholder="Enter your phone carrier" value="" maxlength="25">
                                                </div>
                                            </div>
                                            <!-- end div for new carrier -->
                                            
                                            <div class="row">
                                                <div class="col-4 mt-1 mb-4">
                                                    
                                                </div>
                                                <div class="col-8 mt-1 mb-4">
                                           
                                                    <button type="submit" name="personal" class="btn submit-button">
                                                        <span class="fa fa-check"></span> CONTINUE
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
                    
                <?php } if($marketing){ ?>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <ul class="list-unstyled multi-steps form-text">
                            <li>Personal Details</li>
                            <li class="is-active">Marketing (SEO)</li>
                            <li>Terms of Service</li>
                            <li>Finished</li>
                        </ul>
                    </div>
                    <div class="col-sm-2"> </div>
                    
                </div>
            


                <section class="row form-text">
                    <div class="col-sm-12">
                        <section class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-block">
                                        <p class="card-title form-text">Please complete the form below <br> 
                                        All fields marked with an asterisk <span class="asterik-color">(*)</span> are required: </p>

                                        <!-- error div here -->

                                        <form id="marketing" action="" method="POST" autocomplete="off" novalidate>
                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label">
                                                Do you own an Author's website? 

                                                <a href="#" data-toggle="tooltip" title="Example: www.yourname.com (skip if your website is not available at the moment. You can return to the settings page to update once your website is ready.)"><span class="fa fa-question-circle"></span></a>

                                                 <span class="asterik-color">*</span>
                                                </label>

                                                <div class="col-md-8">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" id="question1" name="site_question" value="1">
                                                        <label class="custom-control-label" for="question1"><strong>Yes</strong></label>
                                                    </div>

                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" id="question2" name="site_question" value="0">
                                                        <label class="custom-control-label" for="question2"><strong>No</strong></label>
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- If user has author's website, show this div -->
                                            <div id="author_site_div" class="form-group row" style='display:none;'>
                                                <label class="col-md-4 col-form-label">
                                                Do you want us to link to your website? 
                                                </label>

                                                <div class="col-md-8">
                                                    
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" id="question3" name="linkback" value="1">
                                                        <label class="custom-control-label" for="question3"><strong>Yes</strong></label>
                                                    </div>

                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" id="question4" name="linkback" value="0">
                                                        <label class="custom-control-label" for="question4"><strong>No</strong></label>
                                                    </div>

                                                </div>
                                            </div>

                                            


                                            <!-- If author want us to link to their website, show this div -->

                                            <div style='display:none;' class="form-group row" id="site_link_div">
                                                <label class="col-md-4 col-form-label">
                                                
                                                </label>
                                                <div class="col-md-8">
                                                    <input value="<?php echo $authorWebsite ?? ''; ?>" id="author_website" type="text" name="author_website" class="form-control " placeholder="E.g. https://www.rathe.app" >
                                                </div>
                                            </div>
                                            <!-- end author website div -->


                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label">
                                                Do you own a Blog? 

                                                <a href="#" data-toggle="tooltip" title="Blogging at rĀthe! You will be given your own rĀthe! Blog. It is highly recommended that you do not duplicate posts for SEO purposes."><span class="fa fa-question-circle"></span></a>
                                                </label>

                                                <div class="col-md-8">
                                                    
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" id="question5" name="blog_question" value="1">
                                                        <label class="custom-control-label" for="question5"><strong>Yes</strong></label>
                                                    </div>

                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" id="question6" name="blog_question" value="0">
                                                        <label class="custom-control-label" for="question6"><strong>No</strong></label>
                                                    </div>
                                                
                                                </div>
                                            </div>

                                            <!-- If author has a blog, show this div -->

                                            <div style='display:none;' class="form-group row" id="blog_link_div">
                                                <label class="col-md-4 col-form-label">
                                                
                                                </label>
                                                <div class="col-md-8">
                                                    <input value="<?php echo $authorBlog ?? ''; ?>" id="author_blog" type="text" name="author_blog" class="form-control " placeholder="E.g. http://www.yourblog.com" >
                                                </div>
                                            </div>
                                            <!-- end author blog div -->

                                            <!-- If no blog, ask if they want us to create one for them -->
                                            <div id="ourblog_div" class="form-group row" style='display:none;'>
                                                <label class="col-md-4 col-form-label">
                                                Do you want us to create one for you?
                                                </label>

                                                <div class="col-md-8">
                                                    
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" id="question7" name="blog_space" value="1">
                                                        <label class="custom-control-label" for="question7"><strong>Yes</strong></label>
                                                    </div>

                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" id="question8" name="blog_space" value="0">
                                                        <label class="custom-control-label" for="question8"><strong>No</strong></label>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- end here -->
                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label">
                                                Social Media Account Links
                                                </label>
                                                <div class="col-md-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="facebook" name="facebook" >
                                                        <label class="custom-control-label custom-control-description" for="facebook">Facebook</label>                                                      
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input name="twitter" type="checkbox" class="custom-control-input" id="twitter">
                                                        <label class="custom-control-label custom-control-description" for="twitter">Twitter</label>
                                                        
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input name="linkedin" type="checkbox" class="custom-control-input" id="linkedin">
                                                        <label class="custom-control-label custom-control-description" for="linkedin">LinkedIn</label>
                                                        
                                                    </div>

                                                    <div class="custom-control custom-checkbox">
                                                        <input name="instagram" type="checkbox" class="custom-control-input" id="instagram">
                                                        <label class="custom-control-label custom-control-description" for="instagram">Instagram</label>
                                                        
                                                    </div>

                                                    <div class="custom-control custom-checkbox">
                                                        <input name="goodreads" type="checkbox" class="custom-control-input" id="goodreads">
                                                        <label class="custom-control-label custom-control-description" for="goodreads">GoodReads</label>
                                                        
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input name="pinterest" type="checkbox" class="custom-control-input" id="pinterest">
                                                        <label class="custom-control-label custom-control-description" for="pinterest">Pinterest</label>
                                                        
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- If author check social media(s), show them below -->
                                            <div style='display:none;' class="form-group row" id="facebook_div">
                                                <label class="col-md-4 col-form-label">
                                                
                                                </label>
                                                <div class="col-md-8">
                                                    <input value="<?php echo $facebookLink ?? ''; ?>" id="facebook_link" type="text" name="facebook_link" class="form-control " placeholder="Enter your Facebook Username" >
                                                </div>
                                            </div>
                                            <div style='display:none;' class="form-group row" id="twitter_div">
                                                <label class="col-md-4 col-form-label">
                                                
                                                </label>
                                                <div class="col-md-8">
                                                    <input value="<?php echo $twitterLink ?? ''; ?>" id="twitter_link" type="text" name="twitter_link" class="form-control " placeholder="Enter your Twitter Handle">
                                                </div>
                                            </div>
                                            <div style='display:none;' class="form-group row" id="linkedin_div">
                                                <label class="col-md-4 col-form-label">
                                                
                                                </label>
                                                <div class="col-md-8">
                                                    <input value="<?php echo $linkedinLink ?? ''; ?>" id="linkedin_link" type="text" name="linkedin_link" class="form-control" placeholder="Enter your LinkedIn Profile" >
                                                </div>
                                            </div>
                                            <div style='display:none;' class="form-group row" id="instagram_div">
                                                <label class="col-md-4 col-form-label">
                                                
                                                </label>
                                                <div class="col-md-8">
                                                    <input value="<?php echo $instagramLink ?? ''; ?>" id="instagram_link" type="text" name="instagram_link" class="form-control " placeholder="Enter your Instagram Username" >
                                                </div>
                                            </div>
                                            <div style='display:none;' class="form-group row" id="goodreads_div">
                                                <label class="col-md-4 col-form-label">
                                                
                                                </label>
                                                <div class="col-md-8">
                                                    <input value="<?php echo $goodreadsLink ?? ''; ?>" id="goodreads_link" type="text" name="goodreads_link" class="form-control " placeholder="Enter your Goodreads email" >
                                                </div>
                                            </div>
                                            <div style='display:none;' class="form-group row" id="pinterest_div">
                                                <label class="col-md-4 col-form-label">
                                                
                                                </label>
                                                <div class="col-md-8">
                                                    <input value="<?php echo $pinterestLink ?? ''; ?>" id="pinterest_link" type="text" name="pinterest_link" class="form-control " placeholder="Enter your Pinterest Username" >
                                                </div>
                                            </div>


                                            
                                        <div class="row">
                                            <div class="col-4 mt-1 mb-4">
                                                
                                            </div>

                                            <div class="col-8 mt-1 mb-4">
                                                
                                                <button type="submit" name="marketing" class="btn submit-button">
                                                    <span class="fa fa-check"></span> NEXT >
                                                </button>

                                                
                                            </div>
                                        </div>
                                        </form>
                                    
                                    
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            
                <?php } if($terms){ ?>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <ul class="list-unstyled multi-steps form-text">
                            <li>Personal Details</li>
                            <li>Marketing (SEO)</li>
                            <li class="is-active">Terms of Service</li>
                            <li>Finished</li>
                        </ul>
                    </div>
                    <div class="col-sm-2"> </div>
                    
                </div>


                <section class="row form-text">
                    <div class="col-sm-12">
                        <section class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-block">
                                        <p class="card-title"><strong>Read, Confirm &amp; Accept to our Terms and Conditions</strong></p>
                                        <p class="card-title"> </p>
                                        <form id="terms" action="" method="POST" autocomplete="off" novalidate>
                                            <div class="form-group row">
                                                <label class="col-md-1 col-form-label">
                                                
                                                </label>
                                                <div class="col-md-11">

                                                    <textarea class="form-control textarea-reflect">TERMS OF USE

The standard Lorem Ipsum passage, used since the 1500s

"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."

Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</textarea>
                                                </div>
                                            </div>
                                            
                                        <div class="row">
                                            <div class="col-4 mt-1 mb-4">
                                                
                                            </div>
                                            <div class="col-8 mt-1 mb-4">
                                                <button type="button" class="btn action-button cancel-button"  data-toggle="modal" data-target="#confirm-delete">
                                                    <span class="fa fa-delete"></span> Decline
                                                </button>
                                                <button type="submit" name="terms" class="btn submit-button">
                                                    <span class="fa fa-check"></span> I ACCEPT
                                                </button>
                                            </div>
                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            
                <?php } if($success){ ?>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <ul class="list-unstyled multi-steps form-text">
                            <li>Personal Details</li>
                            <li>Marketing (SEO)</li>
                            <li>Terms of Service</li>
                            <li class="is-active">Finished</li>
                        </ul>
                    </div>
                    <div class="col-sm-2"> </div>
                    
                </div>

                <section class="row form-text">
                    <div class="col-sm-12">
                        <section class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-block text-center">
                                        <h3>Setup Completed</h3>
                                        <br>
                                        
                                        <br>
                                        <div class="alert alert-success">
                                            <span class="fa fa-check"></span> Success!</strong> 
                                            <br />
                                            <br /> Your account is now setup. <a href="new_title.php"><strong>Click here</strong></a> to upload your first Title.
                                            <br><br>Or, <strong><a href="./">click here</strong></a> to go to the Dashboard 
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            <?php } ?>
                

                <section class="row">
                    <div class="col-12 mt-1 mb-4 text-center">
                        <span class="copyright">Copyright &copy; <?php echo date("Y"); ?> rAthe!.</span>
                    </div>
                </section>
            </div>
        </section>
            </main>
        </div>

    </div>


    <!-- modal boxes here -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
            
                <div class="modal-body">
                    <p class="form-text">
                    You are about to decline our Terms of Service. 
                    This process will end your current session and the system will log you out.</p>
                    <p class="form-text modal-warning"><strong>Do you wish to proceed?</strong></p>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="location.href = '../login.php';">Yes, I Decline</button>
                    <a href="#" class="btn btn-danger btn-primary" data-dismiss="modal">No</a>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="setup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
            
                <div class="modal-body">
                    <p class="form-text">Kindly setup your account in order to use this facility</p>
                    <p class="form-text"></p>
                    
                </div>
                
                <div class="modal-footer">
                    <a href="#" class="btn btn-danger btn-primary" data-dismiss="modal">Okay</a>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Modal box for welcoming new user -->
    <div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <!--<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>-->
            
                <div class="modal-body">
                    <p class="form-text">
                    <strong>Hi Katie!</strong> <br><br>
                    Your profile is now active. Please take a moment to complete the account setup form.</p>
                    <p class="form-text"></p>
                    
                </div>
                
                <div class="modal-footer">
                    <a href="./" class="btn btn-danger btn-primary" data-dismiss="modal">Start Now</a>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- end modal boxes here -->




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="../js/common.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js"></script>


    <script type="text/javascript">
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
        
        // we display one time modal explaining the need to setup account
        if ($.cookie('pop') == null) {
            $('#welcomeModal').modal('show');
            $.cookie('pop', '1');
        }

        // dropdown menu
        $.validator.addMethod("dropdown",
            function(value, element) {
                if (value == "0")
                    return false;
                else
                    return true;
            },
            "Please select a value"
        );

        $( "#personal" ).validate( {
        rules: {
          notify: {
            dropdown: true
          },
          carriers: {
            dropdown: true
          },
          new_carrier: {
            required: true,
            minlength: 2
          }
        },
        messages: {

          notify: "Please select your notification method",

          carriers: "Please select your mobile phone carrier from the list",

          new_carrier: "Please enter your mobile phone carrier",
        },

        errorElement: "span",
        errorPlacement: function ( error, element ) {
          // Add the `invalid-feedback` class to the error element
          error.addClass( "invalid-feedback" );
          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.next( "label" ) );
          } else {
            error.insertAfter( element );
          }
        },
        highlight: function ( element, errorClass, validClass ) {
          $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
        },
        unhighlight: function (element, errorClass, validClass) {
          $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
        }
       });


        // validate marketing form
        $( "#marketing" ).validate( {
        rules: {

          site_question: { 
            required: true
          },

          linkback: { 
            required: true
          },

          blog_question: { 
            required: true
          },

          blog_space: { 
            required: true
          },
       
          facebook_link: {
            required: true,
            minlength: 5
          },
          twitter_link: {
            required: true,
            minlength: 5
          },
          linkedin_link: {
            required: true,
            minlength: 5
          },
          instagram_link: {
            required: true,
            minlength: 5
          },
          goodreads_link: {
            required: true,
            minlength: 5
          },
          pinterest_link: {
            required: true,
            minlength: 5
          },
       
        },

        messages:
        {
          site_question: { 
            required: "?"
          },
          linkback: { 
            required: "?"
          },
          blog_question: { 
            required: "?"
          },
          
          blog_space: { 
            required: "?",
          },

          facebook_link: {
            required: "Please enter your Facebook Username",
            minlength: "Your Facebook Username cannot be verified"
          },
          twitter_link: {
            required: "Please enter your Twitter Handle",
            minlength: "Your Twitter Handle cannot be verified"
          },
          linkedin_link: {
            required: "Please enter your Linkedin Profile",
            minlength: "Your Linkedin Profile cannot be verified"
          },
          instagram_link: {
            required: "Please enter your Instagram Username",
            minlength: "Your Instagram Username cannot be verified"
          },
          goodreads_link: {
            required: "Please enter your GoodReads Email",
            minlength: "Your Goodreads Email cannot be verified"
          },
          pinterest_link: {
            required: "Please enter your Pinterest Username",
            minlength: "Your Pinterest Username cannot be verified"
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
            if ($(element).prop( "type" ) === "radio" ) {
                $( element ).removeClass( "is-invalid" );
            } else {
                $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
            }
        }
       });

        if ( window.history.replaceState )
        {
            window.history.replaceState( null, null, window.location.href );
        }

    </script>
</body>
</html>