<?php
/**
 * ----------------------------------------
 * author : [not]
 * web    : [not]
 * email  : [not]
 * ----------------------------------------
 * Date   : 2021-10-15 16:15
 * File   : example.php
 */

require_once 'vendor/autoload.php';

$totalItems = 20;
$itemsPerPage = 5;
$urlPattern = 'example.php?page={:page}';
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;

$paginator = new \Mahmut\Paginator\Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Paginator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<div style="margin-top: 50px">
    <?php echo $paginator?>
</div>
</body>
</html>