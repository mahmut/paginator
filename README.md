# PHP Paginator

## Installation
```sh
composer require mahmut/paginator
```

## Example
```php
// total items count
$totalItems = 20;
// items per page
$itemsPerPage = 5;
// current page
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
// url pattern
$urlPattern = 'example.php?page={:page}';

// paginator
$paginator = new \Mahmut\Paginator\Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
```

## Result
````html
<ul class="pagination justify-content-center">
    <li class="page-item disabled"><span class="page-link">İlk</span></li>
    <li class="page-item disabled"><span class="page-link">Önceki</span></li>
    <li class="page-item active"><span class="page-link">1</span></li>
    <li class="page-item"><a class="page-link" href="example.php?page=2">2</a></li>
    <li class="page-item"><a class="page-link" href="example.php?page=3">3</a></li>
    <li class="page-item"><a class="page-link" href="example.php?page=4">4</a></li>
    <li class="page-item"><a class="page-link" href="example.php?page=2">Sonraki</a></li>
    <li class="page-item"><a class="page-link" href="example.php?page=4">Son</a></li>
</ul>
````