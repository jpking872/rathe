<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /dashboard/new_title.php");
    exit;
}

$filenames = array('title_document', 'cover_art_image', 'author_image', 'retail_title_document', 'epub_document', 'mobi_document');

?>

<pre><?php print_r($_POST); print_r($_FILES); ?></pre>