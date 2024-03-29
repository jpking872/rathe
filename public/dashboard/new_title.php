<?php

// Initialise form controller 
$intake = true;
$uploads = false;

 
if(isset($_POST['intake']))
{
	$intake = false;
	$uploads = true;
}

if(isset($_POST['uploads']))
{
	$intake = false;
	$uploads = true;
	
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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
			<?php require __DIR__.'/../includes/dashboard_nav.php'; ?>

			<main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
				<header class="page-header row justify-center">
					<div class="col-md-6 col-lg-8" >
						<h1 class="float-left text-center text-md-left">New Title Intake</h1>
					</div>

					<?php require __DIR__.'/../includes/profileNav.php'; ?>

					<div class="clear"></div>
				</header>
               

                <?php if($intake){ ?>
			    <div class="form-group row">
				    <div class="col-sm-10">
					    <ul class="list-unstyled multi-steps form-text">
					    	<li class="is-active">INTAKE</li>
					    	<li>Uploads</li>
					    	<li>SEO</li>
					    	<li>How to receive payments</li>
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
								    <form id="intake" action="" method="POST" autocomplete="off">
								    	<input id="step1" type="hidden" name="step1" value="1">
								    	
										<p class="card-title form-text">
										<br />
										All fields marked with an asterisk 
										<span class="asterik-color">(*)</span> are required: </p>

										

							
										<div class="row">
										    <div class="col-md-6">
										    	
										    	<div class="form-group col-md-11">
										            <label for="title_name"><strong>Title Name</strong> 
										            	<span class="asterik-color">(*)</span>
													    
										            </label>
										            <input id="title_name" type="text" name="title_name" class="form-control" value="" placeholder="Title of Your Work" maxlength="50">
										        </div>
										        <p>&nbsp;</p>

										        <div class="form-group col-md-11">										

										            <label for="title_format">
										            	<strong>Is this Title available in print?</strong> 
										            	<span class="asterik-color">(*)</span>
										            	<a href="#" data-toggle="tooltip">
										            		<span class="fa fa-question-circle"></span>
										            	</a>
										            </label>
										            <br>
											        <div class="custom-control custom-radio custom-control-inline">
											        	<input type="radio" class="custom-control-input" id="bookshelf" name="format" value="1">
											        	<label class="custom-control-label" for="bookshelf">
											        		Yes
											        	</label>
													</div>

													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" class="custom-control-input" id="bookshelf2" name="format" value="0">
														<label class="custom-control-label" for="bookshelf2">
															No
														</label>
													</div>
												</div>

												<!-- if yes to format, show this div -->
												<div class="form-group col-md-11" style='display: none;' id="format">
												    <label for="persona"><strong>Where?</strong>
													    <span class="asterik-color">(*)</span>
													    <a href="#" data-toggle="tooltip">
										            		<span class="fa fa-question-circle"></span>
										            	</a>
													</label>
											        <input id="location" type="text" name="location" class="form-control" value="" placeholder="Provide the URL where your Title is for sale in print" maxlength="255">
												</div>
												<!-- end this div -->
												<p></p>

												<div class="form-group col-md-11">
													<label for="title_format">
											            <strong>Do you have this Title available in</strong>
											            <span class="asterik-color">(*)</span>
													    <a href="#" data-toggle="tooltip">
										            		<span class="fa fa-question-circle"></span>
										            	</a>

											            	
											        </label>

											            <br>

											        <div class="custom-control custom-radio custom-control-inline">
											        	<input type="radio" class="custom-control-input" id="format_type1" name="format_type" value="1">
											        	<label class="custom-control-label" for="format_type1">
											        		ePub
											        	</label>
													</div>

													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" class="custom-control-input" id="format_type2" name="format_type" value="2">
														<label class="custom-control-label" for="format_type2">
															Mobi
														</label>
													</div>

													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" class="custom-control-input" id="format_type3" name="format_type" value="3">
														<label class="custom-control-label" for="format_type3">
															Both
														</label>
													</div>

													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" class="custom-control-input" id="format_type4" name="format_type" value="4">
														<label class="custom-control-label" for="format_type4">
															None
														</label>
													</div>
												</div>

												<div class="form-group col-md-11">
													<label for="price">
														<strong>Retail price of Title in complete E-format</strong>
													    <span class="asterik-color">(*)</span>
													    <a href="#" data-toggle="tooltip">
										            		<span class="fa fa-question-circle"></span>
										            	</a>
													</label>
											        <input id="price" type="number" name="price" class="form-control" value="<?php echo $price ?? ''; ?>" placeholder="$">

										        </div>

										        <!-- left column ends here -->
										    </div>


										    <div class="col-md-6">

										    	<div class="form-group col-md-11">
										        	<label class="col-form-label">
										        	<strong> Content Ratings</strong>
										        	<span class="asterik-color">(*)</span>
													    <a href="#" data-toggle="tooltip">
										            		<span class="fa fa-question-circle"></span>
										            	</a>

													</label>
												

													<div>
													    <div class="custom-control custom-radio">
														    
														    <input class="custom-control-input" type="radio" name="all_ages" id="rating1" value="1">

														    <label class="custom-control-label custom-control-description" for="rating1">All Ages
														    </label>

													    </div>
													    <div class="custom-control custom-radio">
														    <input class="custom-control-input" type="radio" name="all_ages" id="rating2" value="2">

														    <label class="custom-control-label custom-control-description" for="rating2">Young Adult
														    </label>
														    
													    </div>
													    <div class="custom-control custom-radio">
														    <input class="custom-control-input" type="radio" name="all_ages" id="rating3" value="3">

														    <label class="custom-control-label custom-control-description" for="rating3">Adult
														    </label>
														    
													    </div>
												    </div>
											    </div>

											    <div class="form-group col-md-11">
											    	<label for="persona"><strong>Public Persona</strong>
													    <span class="asterik-color">(*)</span>
													    <a href="#" data-toggle="tooltip">
										            		<span class="fa fa-question-circle"></span>
										            	</a>
													</label>
											        <input id="persona" type="text" name="persona" class="form-control" value="" placeholder="Author Name, Public persona, pen name, pseudonym, nom de plum" maxlength="50">
											    </div>

											    <div class="form-group col-md-11">
											        <label for="describe_title"><strong>Write your Title description</strong> 
											        	<span class="asterik-color">(*)</span>
													    <a href="#" data-toggle="tooltip">
										            		<span class="fa fa-question-circle"></span>
										            	</a>
											        </label>
											        <textarea maxlength="250" class="form-control" name="describe_title" rows="2" placeholder="Describe your Title minimum 30 letters not to exceed 250 words" id="describe_title"></textarea>
										        </div>

										        <div class="form-group col-md-11">
												    <label for="author_bio"><strong>Author Bio</strong>
												    	<span class="asterik-color">(*)</span>
													    <a href="#" data-toggle="tooltip">
										            		<span class="fa fa-question-circle"></span>
										            	</a>
												    </label>
											        <textarea maxlength="500" class="form-control" name="author_bio" rows="2" placeholder="Provide your author biography (minimum 50 characters, maximum 500 words)" id="author_bio"></textarea>
											    </div>

										        <!-- right column ends here -->
										    </div>

										</div>

										<div class="row">
									        <div class="col-4">
									        	<br>
						                    	<button type="button" class="btn btn-danger">
						                		 Save
						                	    </button>
									        	
									        </div>
					                    	<div class="col-5"></div>
					                        <div class="col-3">
						                    	<br>
						                    	<button type="submit" id="submit" name="intake" class="btn submit-button">
						                		Next >
						                	    </button>
					                        </div>
				                    	</div>
					                </form>
					            </div>
							</div>
						</section>
					</div>
				</section>


			<?php } if($uploads){ ?>
			    <div class="form-group row">
				    <div class="col-sm-10">
					    <ul class="list-unstyled multi-steps form-text">
					    	<li>INTAKE</li>
					    	<li class="is-active">Uploads</li>
					    	<li>SEO</li>
					    	<li>How to receive payments</li>
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
								    <form id="uploads" action="upload.php" method="POST" autocomplete="off" enctype="multipart/form-data">
								    	<input id="step2" type="hidden" name="step2" value="2">

								    	<!-- echo user ID here -->
								    	<input name="userid" type="hidden" value="<?php echo "1" ?>">
								    	
										<p class="card-title form-text">
										<br />
										All fields marked with an asterisk 
										<span class="asterik-color">(*)</span> are required: </p>

<div class="row">
	<div class="col-xl-6">

<div class="form-group col-sm-11 col-lg-9">
	<label for="title_document"><strong>Title Document</strong>												    	
		<span class="asterik-color">(files allowed: .pdf, .doc, .docx, .rtf)</span>
		<a href="#" data-toggle="tooltip">
		<span class="fa fa-question-circle"></span>
		</a></label>
<div class="custom-file">
  <input type="file" class="custom-file-input" id="title_document" name="title_document" lang="en">
  <label class="custom-file-label" for="title_document">Select file</label>
</div>
<label class="fileLabel">current file: currentFile.pdf</label>
</div>

<div class="form-group col-sm-11 col-lg-9">
	<label for="cover_art_image"><strong>Cover Art Image</strong>												    	
		<span class="asterik-color">(files allowed: .jpg, .jpeg, .png)</span>
		<a href="#" data-toggle="tooltip">
		<span class="fa fa-question-circle"></span>
		</a></label>
<div class="custom-file">
  <input type="file" class="custom-file-input" id="cover_art_image" name="cover_art_image" lang="en">
  <label class="custom-file-label" for="cover_art_image">Select file</label>
</div>

				</div>	<div class="form-group col-sm-11 col-lg-9">
										            <input id="cover_art_image_credit" type="text" name="cover_art_image_credit" class="form-control" value="" placeholder="Artist credit for cover art image" maxlength="250">

</div>

<div class="form-group col-sm-11 col-lg-9">
	<label for="title_document"><strong>Author Image</strong>												    	
		<span class="asterik-color">(files allowed: .jpg, .jpeg, .png)</span>
		<a href="#" data-toggle="tooltip">
		<span class="fa fa-question-circle"></span>
		</a></label>
<div class="custom-file">
  <input type="file" class="custom-file-input" id="author_image" name="author_image" lang="en">
  <label class="custom-file-label" for="author_image">Select file</label>
</div>
<label class="fileLabel">current file: currentFile.jpg</label>


				
				</div>	<div class="form-group col-sm-11 col-lg-9">
										            <input id="author_image_credit" type="text" name="author_image_credit" class="form-control" value="" placeholder="Artist credit for author image" maxlength="250">

</div>

</div>

<div class="col-xl-6">

	<div class="form-group col-sm-11 col-lg-9">
	<label for="retail_title_document"><strong>Retail Title Document</strong>												    	
		<span class="asterik-color">(files allowed: .pdf, .doc, .docx, .rtf)</span>
		<a href="#" data-toggle="tooltip">
		<span class="fa fa-question-circle"></span>
		</a></label>
<div class="custom-file">
  <input type="file" class="custom-file-input" id="retail_title_document" name="retail_title_document" lang="en">
  <label class="custom-file-label" for="retail_title_document">Select file</label>
</div>
</div>

<div class="form-group col-sm-11 col-lg-9">
	<label for="epub_document"><strong>ePub Document</strong>												    	
		<span class="asterik-color">(files allowed: .ePub)</span>
		<a href="#" data-toggle="tooltip">
		<span class="fa fa-question-circle"></span>
		</a></label>
<div class="custom-file">
  <input type="file" class="custom-file-input" id="epub_document" name="epub_document" lang="en">
  <label class="custom-file-label" for="epub_document">Select file</label>
</div>
<label class="fileLabel">current file: currentFile.epub</label>
</div>

<div class="form-group col-sm-11 col-lg-9">
	<label for="mobi_document"><strong>Mobi Document</strong>												    	
		<span class="asterik-color">(files allowed: .mobi)</span>
		<a href="#" data-toggle="tooltip">
		<span class="fa fa-question-circle"></span>
		</a></label>
<div class="custom-file">
  <input type="file" class="custom-file-input" id="mobi_document" name="mobi_document" lang="en">
  <label class="custom-file-label" for="mobi_document">Select file</label>
</div>
</div>
	

</div>

</div>
						

										<div class="row">
									        <div class="col-4">
									        	<br>
						                    	<button type="submit" name="save" class="btn btn-danger">
						                		 Save
						                	    </button>
									        	
									        </div>
					                    	<div class="col-5"></div>
					                        <div class="col-3">
						                    	<br>
						                    	<button type="submit" name="uploads" class="btn submit-button">
						                		Next >
						                	    </button>
					                        </div>
				                    	</div>
					                </form>
					            </div>
							</div>
						</section>
					</div>
				</section>
			    <?php } ?>
				

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
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<!--script src="dist/js/bootstrap.min.js"></script-->
	<script type="text/javascript">
		$(document).ready(function () {

		  $(".custom-file-input").on("change", function() {
		  var fileName = $(this).val().split("\\").pop();
		  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		  });

		  /*$("#uploads").submit(function(e) {
		  	var form = this;
		  	$(".custom-file-input").each(function (i, obj) {
		  		elementName = obj.name;
		  		fileName = obj.value.split('\\').pop();
		  		var tmpInput = document.createElement('input');
		  		tmpInput.setAttribute('type', 'text');
		  		tmpInput.setAttribute('name', elementName);
		  		tmpInput.setAttribute('value', fileName);
		  		form.appendChild(tmpInput);
		  	})
		  })*/
		});
	</script>
	

</body>
</html>