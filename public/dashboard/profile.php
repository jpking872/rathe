<?php
/*require __DIR__.'/../../config/connector.php';
require __DIR__.'/../../config/checkPermittedUsers.php';

// email class
require __DIR__.'/../../config/email.dashboard.class.php';

//Initialise CSRFGuard library
//include_once __DIR__ .'/../../owasp/libs/csrf/csrfprotector.php';
//csrfProtector::init();*/


// clean tabs
$tab = filterStr($_GET['tab'] ?? '');

//security check
if(strlen($tab) > 11)
{
    redirectUrl('logout.php');
}

if(isset($tab) && $tab == 'marketing')
{
    $basic = false;
    $marketing = true;
    $preferences = false;
}
else if(isset($tab) && $tab == 'preferences')
{
    $basic = false;
    $marketing = false;
    $preferences = true;
}
else {

    $basic = true;
    $marketing = false;
    $preferences = false;
}


// map error in an array
$showError = array();

if(isset($_POST['basic_info']))
{
    // sanitize $_POST
	$firstName = filterStr($_POST['firstName']);
    $lastName = filterStr($_POST['lastName']);
    $legalName = filterStr($_POST['legalname']);
    $mobileNo = filterStr($_POST['phone']);
    $officeNo = filterStr($_POST['office_no']);
    $hiddenPhone = filterStr($_POST['h_phone']);
    $notify = filterINT($_POST['notify']);
    $carriers = filterINT($_POST['carriers']);
    $new_carrier = filterStr($_POST['new_carrier']);

    // remove non [int] from number before update
    $cleanPhone = removeStr($mobileNo);
    $cleanWork = removeStr($officeNo);

    if(trim($firstName) == '' || strlen($firstName) < STR_NAME_MIN || strlen($firstName) > STR_NAME_MAX)
    {
        $showError[] = SIGNUP_PROVIDE_FIRSTNAME;
    }

    if(trim($lastName) == '' || strlen($lastName) < STR_NAME_MIN || strlen($lastName) > STR_NAME_MAX)
    {
        $showError[] = SIGNUP_PROVIDE_LASTNAME;
    }

    if(trim($legalName) == '' || strlen($legalName) < STR_NAME_MIN || strlen($legalName) > STR_NAME_MAX)
    {
        $showError[] = SETUP_PROVIDE_LEGALNAME;
    }

    if(trim($cleanPhone) == '' || strlen($cleanPhone) < 10 || strlen($cleanPhone) > 15)
    {
        $showError[] = ' Please enter your valid mobile number ';
    }

    if($cleanPhone != $hiddenPhone)
    {
    	if (phoneExist($cleanPhone))
    	{
        	$showError[] = 'This mobile number already in use';
    	}
    }

    if($carriers == 0 || strlen($carriers) > 1)
    {
        $showError[] = SETUP_PROVIDE_CARRIERS;
    }

    if($carriers == 7)
    {
        if(trim($new_carrier) == '' || strlen($new_carrier) < STR_NAME_MIN || strlen($new_carrier) > STR_NAME_MAX)
        {
            $showError[] = SETUP_PROVIDE_NEW_CARRIERS;
        }
    }

    if($notify == 0 || strlen($notify) > 1)
    {
        $showError[] = SETUP_PROVIDE_NOTIFY;
    }

    // No error
    if(count($showError) == 0)
    {

    	// update global users table 
    	$updateTbl = 'Bind_Global_Users';

    	// build query
        $data = array(
                'FirstName' => $firstName, 
                'LastName' => $lastName,
                'MobileNo' => $cleanPhone,
                'OfficeNo' => $cleanWork,
                'LegalName' => $legalName,
                'PhoneCarriers' => $carriers,
                'NotificationType' => $notify,
                'NewCarrier' => $new_carrier
                );

        // update record
        $update = accountSetup($updateTbl, $bid, $data);
        $success = '<div id="success" class="alert alert-success"><strong>Profile Details Updated</strong></div>';
    }

}


// marketing tab
if(isset($_POST['marketing']))
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


// preferences [change password]
if(isset($_POST['change_pass']))
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
						<h1 class="float-left text-center text-md-left">Settings</h1>
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
                                                            <a class="nav-link active" href="profile.php">Profile <span class="sr-only">(current)</span> </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="?tab=marketing">Marketing </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="?tab=preferences">Preferences </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="https://rathehelp.freshdesk.com/support/solutions" target="blank">Help</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>

									<form id="basic_info" action="" method="POST" autocomplete="off" novalidate>

								  	<div class="py-2 mx-4 mb-3">
								  		<div class="mb-3">
										  	<h4>
										  		My Profile
										  	</h4>

									  	</div>
									  	<?php if(isset($_POST['basic_info'])) : ?>
                                            
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

                                            	<input value="<?php echo $row['MobileNo'] ?? ''; ?>" type="hidden" class="form-control" id="h_phone" name="h_phone" maxlength="15">
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="firstName"><strong>First Name</strong></label>
                                                        <input value="<?php if(isset($_POST['basic_info'])) { echo $firstName; } else { echo $row['FirstName'] ?? ''; } ?>" type="text" class="form-control" id="firstName" name="firstName" maxlength="25" required>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="lastName"><strong>Last Name</strong></label>
                                                        <input value="<?php if(isset($_POST['basic_info'])) { echo $lastName; } else { echo $row['LastName'] ?? ''; } ?>" type="text" class="form-control" id="lastName" name="lastName" maxlength="25" required>
                                                    </div>
                                                    
                                                    <div class="form-group col-md-4">
                                                        <label for="legalname"><strong>Legal Name</strong></label>
                                                        <input value="<?php echo $row['LegalName'] ?? '';?>" 
                                                        type="text" class="form-control" id="legalname" name="legalname" required>
                                                        
                                                    </div>
                                                	
                                                </div>
                                                
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="phone"><strong>Mobile No </strong></label>
                                                        <input value="<?php if(isset($_POST['basic_info'])) { echo $mobileNo; } else { echo formatMobile($row['MobileNo'] ?? ''); } ?>" type="text" class="form-control" id="phone" name="phone" maxlength="15">
                                                        <!--
                                                        <span class="help-block">
                                                        <small class="text-muted">You will receive a text on your mobile number.</small></span> -->
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="office_no"><strong>Work No</strong></label>

                                                        <input value="<?php if(isset($_POST['basic_info'])) { echo $officeNo; } else { echo formatMobile($row['OfficeNo'] ?? ''); } ?>" 
                                                        type="text" class="form-control" id="office_no" name="office_no">
                                                        
                                                        </span>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="email"><strong>Email Address</strong></label>
                                                        <input value="<?php echo $row['EmailAddress'] ?? '';?>" 
                                                        type="email" class="form-control" id="email" readonly>
                                                        <span class="help-block">
                                                        <small class="text-muted">Your email address will remain private.</small></span>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="carriers"><strong>Mobile Phone Carrier</strong></label>

                                                        <select id="carriers" class="custom-select form-control" 
                                                    name="carriers">
                                                        <?php $data = carrierList(); foreach($data as $key=>$value):?>
                                                        <option value ="<?php echo $key; ?>" <?php if($key == $row['PhoneCarriers']){ echo 'selected=selected'; } ?>>
                                                            <?php echo $value; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    </div>

                                                    <div id="new_carrier_div" class="form-group col-md-4" <?php if($row['PhoneCarriers'] == 7){ echo 'style="display: block"'; } else { echo 'style="display: none"'; } ?>>
                                                        <label for="new_carrier"><strong>Add Carrier</strong></label>
                                                        <input id="new_carrier" type="text" name="new_carrier" class="form-control" placeholder="Enter your phone carrier" value="<?php if(isset($_POST['basic_info'])) { echo $new_carrier; } else { echo $row['NewCarrier'] ?? ''; } ?>" maxlength="25">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="notify">
                                                            <strong>Notification Method </strong>
                                                        </label>

                                                        <select id="notify" name="notify" class="custom-select form-control">
                                                            <?php
                                                            $notifyList = array("Select An Option","Email","Text");
                                                            foreach($notifyList as $key => $value):
                                                            ?>
                                                            <option value="<?php echo $key; ?>" <?php if($key == $row['NotificationType']){ echo 'selected=selected'; } ?>>
                                                                <?php echo $value; ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        
                                                    </div>

                                                </div>
                                            </div>
		                                        <?php } else {

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

		                                            <button type="submit" name="basic_info" class="btn save-button">
		                                            Update
		                                            </button>
		                                        </div>
		                                    </div>
	                                    </div>
	                                </form>

                                    <?php } if($marketing){ ?>
                                    <div class="row">
                                        <div class="col-md-6"></div>
                                        
                                        <div class="col-md-6">
                                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                                <div class="collapse navbar-collapse" id="navbarNav">
                                                    <ul class="navbar-nav">
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="profile.php">Profile </a>
                                                        </li>
                                                        <li class="nav-item active">
                                                            <a class="nav-link active" href="?tab=marketing">Marketing
                                                            <span class="sr-only">(current)</span></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="?tab=preferences">Preferences </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="https://rathehelp.freshdesk.com/support/solutions" target="blank">Help</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>

                                    <form id="marketing" action="" method="POST" autocomplete="off" novalidate>

                                    <div class="py-2 mx-4 mb-3">
                                        <div class="mb-3">
                                            <h4>
                                                Marketing Details
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

                                                    <button type="submit" name="marketing" class="btn save-button">
                                                    Update
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <?php } if($preferences){ ?>
                                    <div class="row">
                                        <div class="col-md-6"></div>
                                        
                                        <div class="col-md-6">
                                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                                <div class="collapse navbar-collapse" id="navbarNav">
                                                    <ul class="navbar-nav">
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="profile.php">Profile </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="?tab=marketing">
                                                                Marketing 
                                                            </a>
                                                        </li>
                                                        <li class="nav-item active">
                                                            <a class="nav-link active" href="?tab=preferences">Preferences 
                                                            <span class="sr-only">(current)</span></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="https://rathehelp.freshdesk.com/support/solutions" target="blank">Help</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>

                                    <form id="change_pass" action="" method="POST" autocomplete="off">

                                    <div class="py-2 mx-4 mb-3">
                                        <div class="mb-3">
                                            <h4>
                                                Change Password
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
                                                    <button type="submit" name="change_pass" class="btn save-button">
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

						

						<?php require __DIR__.'/../includes/footerNav.php'; ?>
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

	// phone regex
    $.validator.addMethod(
        "mobileValidation",
        function(value, element) {
            return !/^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/.test(value) ? false : true;
        },
        "Required"
    );

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

    // div show/hide
    $('#carriers').on('change', function() {

        if ( this.value == '7')
        {
            $("#new_carrier_div").show();
            $('#new_carrier').focus();
        } else {
            $("#new_carrier_div").hide();
        }
    });

	$( "#basic_info" ).validate( {
        rules: {
          
          firstName: {
            required: true,
            minlength: 2
          },
          lastName: {
            required: true,
            minlength: 2
          },
          legalname: {
            required: true,
            minlength: 3
          },
          phone: {
            required: true,
            mobileValidation: $("#phone").val(),
          },
          
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
          
          firstName: {
            required: "Please enter your firstname",
            minlength: "Your firstname cannot be verified"
          },
          lastName: {
            required: "Please enter your lastname",
            minlength: "Your lastname cannot be verified"
          },
          legalname: {
            required: "Please enter your Legal Name",
            minlength: "Your Legal Name cannot be verified"
          },
          phone: "Please enter your valid phone number",

          notify: "Please select your notification method",

          carriers: "Mobile phone carrier is required",

          new_carrier: "Enter your mobile phone carrier",

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

    $( "#change_pass" ).validate( {
        rules: {
          
          current_pass: {
            required: true,
            minlength: 8
          },

          new_pass: {
            required: true,
            minlength: 8
          },

          confirm_pass: {
            required: true,
            minlength: 8
          },

                  
        },
        messages: {
          
          current_pass: {
            required: "Please enter your current password",
            minlength: "Your current password cannot be less than 8 characters"
          },
          new_pass: {
            required: "Please create a new password",
            minlength: "Your new password cannot be less than 8 characters"
          },
          confirm_pass: {
            required: "Please confirm your new password",
            minlength: "Your password and confirmation password do not match"
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

    

    //prevent page refresh
    if ( window.history.replaceState )
    {
	    window.history.replaceState( null, null, window.location.href );
    }
    </script>
    
    
	</body>
</html>
