<?php
function rupiah($angka) {   // Fungsi untuk format angka menjadi format rupiah
    return 'Rp ' . number_format((float)$angka, 0, ',', '.');
}

function e($value) {  // Fungsi untuk escape output agar aman dari XSS
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function activeMenu($pageName) {    // Fungsi untuk menandai menu aktif berdasarkan halaman saat ini
    $current = $_GET['page'] ?? 'dashboard';
    return $current === $pageName ? 'active' : '';
}

function getStats(PDO $pdo) {    // Fungsi untuk mengambil statistikS
    $stats = [];
    $stats['total_pelanggan'] = (int)$pdo->query('SELECT COUNT(*) FROM pelanggan')->fetchColumn();
    $stats['pc_tersedia'] = (int)$pdo->query("SELECT COUNT(*) FROM komputer WHERE status='Tersedia'")->fetchColumn();
    $stats['pc_dipakai'] = (int)$pdo->query("SELECT COUNT(*) FROM komputer WHERE status='Dipakai'")->fetchColumn();
    $stats['total_pendapatan'] = (float)$pdo->query('SELECT COALESCE(SUM(total_bayar),0) FROM sesi_billing')->fetchColumn();
    return $stats;
}
?>
