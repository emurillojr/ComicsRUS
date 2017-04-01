<?php

//  Ernesto Murillo function to upload image and check size, ext, and put it into folder uploads 

function uploadImage($fieldName) {
    if (!isset($_FILES[$fieldName]['error']) || is_array($_FILES[$fieldName]['error'])) {
        throw new RuntimeException('Invalid parameters.');
    }
    switch ($_FILES[$fieldName]['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }
    if ($_FILES[$fieldName]['size'] > 10000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $validExts = array(
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
    );
    $ext = array_search($finfo->file($_FILES[$fieldName]['tmp_name']), $validExts, true);
    if (false === $ext) {
        throw new RuntimeException('Invalid file format.');
    }
    $fileName = sha1_file($_FILES[$fieldName]['tmp_name']);
    $location = sprintf('./uploads/%s.%s', $fileName, $ext);
    if (!is_dir('./uploads')) {
        mkdir('./uploads');
    }
    if (!move_uploaded_file($_FILES[$fieldName]['tmp_name'], $location)) {
        throw new RuntimeException('Failed to move uploaded file.');
    }
    return $fileName . '.' . $ext;
}
