<?php
session_start();

$uploadFileDir = $_SESSION['upload-dir'];
//default cover art image name and path
$coverDir = $_SESSION['cover-default'];
//default author image name and path
$authorDir = $_SESSION['author-default'];

$userid = $_SESSION['userid'];

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
$userid = $_SESSION['userid'];

function CheckImageMimeType($tmpFile, $mimeArray) {

    $imageInfo = getimagesize($tmpFile);

    //return $imageInfo['mime'];

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

    //return $mtype;

    if (in_array($mtype, $mimeArray)) {
        return true;
    }

    else {
        return false;
    }
}

function ResizeImage($origFile, $newFile) {

    $info = getimagesize($origFile);

    if ($info['mime'] == 'image/jpg' || $info['mime'] == 'image/jpeg') {
        $srcimg = imagecreatefromjpeg($origFile);
    } else if ($info['mime'] == 'image/png') {
        $srcimg = imagecreatefrompng($origFile);
    }

    $origx = imagesx($srcimg);
    $origy = imagesy($srcimg);

    if ($origx >= $origy) {
        $newx = 150;
        $newy = $origy / ($origx / 150);
    } else {
        $newy = 150;
        $newx = $origx / ($origy / 150);
    }

    $newimg = imagecreatetruecolor($newx, $newy);
    imagecopyresampled($newimg, $srcimg, 0, 0, 0, 0, $newx, $newy, $origx, $origy);

    if ($info['mime'] == 'image/jpg' || $info['mime'] == 'image/jpeg') {
        $result = imagejpeg($newimg, $newFile, 80);
    } else if ($info['mime'] == 'image/png') {
        $result = imagepng($newimg, $newFile, 8);
    }

    return $result;


}

$response = array();
$mtype = array();

foreach($filenames as $key => $value) {

    if (!isset($_FILES[$key])) {
        $response[$key] = "no file|No file uploaded";
        continue;
    }

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
                    //$validMime = CheckImageMimeType($tmpFileTmpPath, $value[2]);
                    break;
                case "cover_art_image":
                case "author_image":
                case "epub_document":
                case "mobi_document":
                    //$validMime = CheckFileMimeType($tmpFileTmpPath, $value[2]);
                    break;
            }

            //$mtype[$key] = $validMime;
            /*if ($validMime) {
                $response[$key] = "invalid mime type";
                continue;
            }*/

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
			$baseFileName = implode(".", $tmpFileNameCmps) . "_" . $userid . "_" . time();
			$newFileName = $baseFileName . "." . $tmpFileExtension;
			$subDir = str_replace("_", "-", $key) . "/";
			$destPath = $uploadFileDir . $subDir . $newFileName;
            $resizeFileName = $uploadFileDir . $subDir . $baseFileName . "_r." . $tmpFileExtension;

			if (move_uploaded_file($tmpFileTmpPath, $destPath)) {
				$response[$key] = "success|" . $destPath;

				//if image, resize
				if($key == "cover_art_image" || $key == "author_image") {
                    if (($result = ResizeImage($destPath, $resizeFileName)) === false) {
                        $response[$key] = "error resizing image";
                    }
                }

			} else {
				$response[$key] = "error moving file";
			}

		} else {

			$response[$key] = "file upload error|" . $tmpFileError;
			continue;
		}
	} else {

	    if ($key == "cover_art_image") {
	        //$response[$key] = "success|" . $coverDir;
            $response[$key] = "no file|no file uploaded";
        } else if ($key == "author_image") {
	        //$response[$key] = "success|" . $authorDir;
            $response[$key] = "no file|no file uploaded";
        } else {
            $response[$key] = "no file|no file uploaded";
        }

	}

}

foreach($response as $key => $value) {

    $isValid = true;

    $result = explode("|", $value);

    if ($result[0] != "success") {
        $isValid = false;
    }

}

if ($isValid) {
    $response['valid'] = true;
} else {
    $response['valid'] = false;
}

echo json_encode($response);

