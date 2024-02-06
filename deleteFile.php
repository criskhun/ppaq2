<?php
$fileToDelete = 'index.php';

if (file_exists($fileToDelete)) {
    unlink($fileToDelete);
    echo 'File deleted successfully.';
} else {
    echo 'File not found.';
}
?>