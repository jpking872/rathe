<?php
session_start();

//user must be logged in to upload
if ($_SESSION['loggedIn'] !== "yes") {
    //header("Location: /dashboard/new_title.php");
    //exit;
}

//prevent direct access to this file
if (!isset($_SERVER['HTTP_REFERER'])){
    header("Location: /dashboard/new_title.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /dashboard/new_title.php");
    exit;
}

//files and restrictions (size, extensions allowed, mime types allowed)
$filenames = array(
	'title_document' => array(1500000, array('pdf', 'doc', 'docx', 'rtf'),
        array("application/pdf", "application/rtf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document")),
	'cover_art_image' => array(400000, array('jpg', 'jpeg', 'png'), array("image/jpeg", "image/png")),
	'author_image' => array(400000, array('jpg', 'jpeg', 'png'), array("image/jpeg", "image/png")),
	'retail_title_document' => array(1500000, array('pdf', 'doc', 'docx', 'rtf'),
        array("application/pdf", "application/rtf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document")),
	'epub_document' => array(3000000, array('epub'), array("application/epub+zip")),
	'mobi_document' => array(3000000, array('mobi'), array("application/x-mobipocket-ebook"))
);

//user ID for use with filename (would be a POST variable)
$userid = $_POST['userid'];

//destination directory
$uploadFileDir = 'C:\Users\jonat\Documents\Rathe\uploads\\';
//default cover art image name and path
$coverDir = 'default-cover.jpg';
//default author image name and path
$authorDir = 'default-author.jpg';

function CheckImageMimeType($tmpFile, $mimeArray) {

    $imageInfo = getimagesize($tmpFile);
    if (in_array($imageInfo['mime'], $mimeArray)) {
        return true;
    }
    else {
        return false;
    }

}

function CheckFileMimeType($tmpFile, $mimeArray) {

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mtype = finfo_file($finfo, $tmpFile);
    finfo_close($finfo);

    if (in_array($mtype, $mimeArray)) {
        return true;
    }

    else {
        return false;
    }
}

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

            switch($key) {
                case "title_document":
                case "retail_title_document":
                    $validMime = CheckImageMimeType($tmpFileTmpPath, $value[2]);
                    break;
                case "cover_art_image":
                case "author_image":
                case "epub_document":
                case "mobi_document":
                    $validMime = CheckFileMimeType($tmpFileTmpPath, $value[2]);
                    break;
            }

            if (!$validMime) {
                $response[$key] = "invalid mime type";
                continue;
            }

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
			$destPath = $uploadFileDir . str_replace("_", "-", $key) . "/" . $newFileName;

			if (move_uploaded_file($tmpFileTmpPath, $destPath)) {
				$response[$key] = "success|" . $destPath;
			} else {
				$response[$key] = "error moving file";
			}

		} else {

			$response[$key] = "file upload error|" . $tmpFileError;
			continue;
		}
	} else {

	    if ($key == "cover_art_image") {
	        $response[$key] = "success|" . $coverDir;
        } else if ($key == "author_image") {
	        $response[$key] = "success|" . $authorDir;
        } else {
            $response[$key] = "no file uploaded";
        }

	}

}

$_SESSION['step'] = 2;

echo json_encode($response);