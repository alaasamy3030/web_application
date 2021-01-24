<?php 

	ob_start(); // Output Buffering Start

	session_start();
    include 'init.php';

$filename = isset($_GET['filename']) ? $_GET['filename'] : 'notfound';
$file = $filename;
$filename = $filename;
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file));
header('Accept-Ranges: bytes');
@readfile($file);



        include $tpl . 'footer.php'; 
        ob_end_flush();
    ?>
