<?php

$dir = '../uploads';

if (is_dir($dir)) {
    $files = glob($dir . '/*'); //get all file names
        foreach($files as $file) {
            if (is_file($file))
            unlink($file); //delete file
        }
	rmdir($dir);
}
mkdir($dir);
