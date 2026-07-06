<?php require_once __DIR__ . '/../includes/functions.php'; ?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cyber Billing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top cyber-navbar">
    <div class="container">
        <div class="d-flex align-items-center">
            <a class="navbar-brand fw-bold neon-text" href="index.php">⚡CyberNest  </a>
            <div id="headerClock" class="ms-3 text-muted-custom header-clock d-flex align-items-center" style="font-size:0.95rem">
                <span class="clock-icon me-2">🕒</span>
                <span id="headerClockTime" class="me-2">--:--:--</span>
                <span id="headerClockDate" class="small text-muted-custom"></span>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto gap-lg-2">
                <li class="nav-item"><a class="nav-link <?= activeMenu('dashboard') ?>" href="index.php?page=dashboard">🧑‍💻Dashboard</a></li>
                <li class="nav-item"><a class="nav-link <?= activeMenu('pelanggan') ?>" href="index.php?page=pelanggan">👤Pelanggan</a></li>
                <li class="nav-item"><a class="nav-link <?= activeMenu('komputer') ?>" href="index.php?page=komputer">🖥️Komputer</a></li>
                <li class="nav-item"><a class="nav-link <?= activeMenu('billing') ?>" href="index.php?page=billing">💸Billing</a></li>
                <li class="nav-item"><a class="nav-link <?= activeMenu('laporan') ?>" href="index.php?page=laporan">🧾Laporan</a></li>
            </ul>
        </div>
    </div>
</nav>
<main class="container py-4 page-content">
