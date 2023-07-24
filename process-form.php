<?php
//checks if the method used is POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("POST request method required");
}

// Error messages equal to PHP standard error messages
// https://www.php.net/manual/en/features.file-upload.errors.php

if ($_FILES["files"]["error"] !== UPLOAD_ERR_OK) {
    switch ($_FILES["files"]["error"]) {       
        case UPLOAD_ERR_INI_SIZE:
            exit("The uploaded file exceeds the upload_max_filesize directive in php.ini.");
            break;

        case UPLOAD_ERR_FORM_SIZE:
            exit("The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.");
            break;

        case UPLOAD_ERR_PARTIAL:
            exit("The uploaded file was only partially uploaded.");
            break;

        case UPLOAD_ERR_NO_FILE:
            exit("No file was uploaded");
            break;

        case UPLOAD_ERR_NO_TMP_DIR:
            exit("Missing a temporary folder.");
            break;

        case UPLOAD_ERR_CANT_WRITE:
            exit("Failed to write file to disk.");
            break;

        case UPLOAD_ERR_EXTENSION:
            exit("A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension
             caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.");
            break;

        //incase of new or unkown error
        default:
            exit("Unknown upload error");
            break;
    }
}

//restrict file size in source code, can also be restricted in the php.ini
    //1mb = 1048576
    //5mb = 5242880
if ($_FILES["files"]["size"] > 5242880) {
    exit("File too large (max 1MB)");
}

//restrict file type

    //Using the file info extension
    //creating new finfo object to get the mime type
$finfo = new finfo(FILEINFO_MIME_TYPE);

    //calling file method on object,passing the file path
    //the path is the tmp element name, in the files array
$mime_type = $finfo->file($_FILES["files"]["tmp_name"]);

        //------------ to view the file type:
        //------------ exit($mime_type);

    //determine file types
$mime_types = ["image/png", "text/csv"];

    //checking file type
if ( ! in_array($_FILES["files"]["type"], $mime_types)) {
    exit("invalid file type");
}

//moving the file

    //deviding the file info into parts to get filename without extension
$pathinfo = pathinfo($_FILES["files"]["name"]);

    //assigning filename til variable
$base = $pathinfo["filename"];

    //replacing any unsafe characters in the filename to _
$base = preg_replace("/[^\w-]/", "_", $base);

    //assigning new filename to a variable
$filename = $base . "." . $pathinfo["extension"];

    //assigning destination path to a variable
$destination = __DIR__ . "/uploads/" . $filename;


    //check if file already exist, stopping prevention of dublicate files
$i = 1;

while (file_exists($destination)) {
    //if dublicate exist rename file with new index
    $filename = $base . "($i)." . $pathinfo["extension"];

    //assigning destination
    $destination = __DIR__ . "/uploads/" . $filename;

    $i++;
}


    //using the move uploaded file funtion
    //passing the path to the tmp file, and the path to the destination
if ( ! move_uploaded_file($_FILES["files"]["tmp_name"], $destination)){
    exit("Can't move uploaded file");
}


    //------------ print out file
    //------------ print_r($_FILES);

header("location: csvtable.php");