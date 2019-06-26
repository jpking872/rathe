<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /dashboard/new_title.php");
    exit;
}

//files and restrictions (size and type)
$filenames = array(
	'title_document' => array(1500000, array('pdf', 'doc', 'docx', 'rtf')), 
	'cover_art_image' => array(400000, array('jpg', 'jpeg', 'png')), 
	'author_image' => array(400000, array('jpg', 'jpeg', 'png')), 
	'retail_title_document' => array(1500000, array('pdf', 'doc', 'docx', 'rtf')), 
	'epub_document' => array(3000000, array('epub')), 
	'mobi_document' => array(3000000, array('mobi'))
);

//user ID for use with filename (would be a POST variable)
$userid = $_POST['userid'];
//destination directory
$uploadFileDir = 'C:\Users\jonat\Documents\Rathe\uploads\\';

$response = array();

foreach($filenames as $key => $value) {

	$tmpFileError = $_FILES[$key]['error'];
	$tmpFileTmpPath = $_FILES[$key]['tmp_name'];
	$tmpFileName = $_FILES[$key]['name'];
	$tmpFileSize = $_FILES[$key]['size'];
	$tmpFileType = $_FILES[$key]['type'];
	$tmpFileNameCmps = explode(".", $tmpFileName);
	$tmpFileExtension = strtolower(end($tmpFileNameCmps));

	//do nothing if no file submitted
	if ($tmpFileName) {

		//check for upload error
		if ($tmpFileError === UPLOAD_ERR_OK) {

			//check maximum size
			$maxSize = $value[0];
			if ($tmpFileSize > $maxSize) {
				$response[$key] = "maximum size exceeded";
				continue;
			}

			//check file type
			$allowedTypes = $value[1];
			if (!in_array($tmpFileExtension, $allowedTypes)) {
				$response[$key] = "invalid file type";
				continue;
			}

			array_pop($tmpFileNameCmps);
			$newFileName = implode(".", $tmpFileNameCmps) . "_" . $userid . "_" . time() . "." . $tmpFileExtension;
			$destPath = $uploadFileDir . $newFileName;

			if (move_uploaded_file($tmpFileTmpPath, $destPath)) {
				$response[$key] = "success - " . $destPath;
			} else {
				$response[$key] = "error moving file";
			}

		} else {

			$response[$key] = "file upload error: " . $tmpFileError;
			continue;
		}
	} else {
		$response[$key] = "No file uploaded";
	}

}

$_SESSION['step'] = 2;
?>

<pre><?php print_r($_POST); print_r($_FILES); print_r($response); ?></pre>
