<?php
require_once __DIR__ . '/config/database.php';
$page = $_GET['page'] ?? 'dashboard';
$allowedPages = ['dashboard', 'pelanggan', 'komputer', 'billing', 'laporan'];
if (!in_array($page, $allowedPages, true)) {
    $page = 'dashboard';
}
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/pages/' . $page . '.php';
require_once __DIR__ . '/includes/footer.php';
?>
