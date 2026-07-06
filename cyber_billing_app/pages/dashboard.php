<?php $stats = getStats($pdo); ?>
<section class="cyber-card hero-card p-4 p-lg-5 mb-4">
    <div class="row align-items-center g-4">
        <div class="col-lg-8 position-relative">
            <p class="text-uppercase text-muted-custom mb-2">Created by: <span class="neon-text">sevnfoldism666</span></p>
            <h1 class="display-5 fw-bold neon-text">⚡CyberNest Billing System</h1>
            <p class="lead text-muted-custom mb-4">Selamat datang di CyberNest!</p>
            <p class="lead text-muted-custom mb-4">Start your billing here.</p>
            <a href="index.php?page=billing" class="btn btn-neon me-2">Mulai Billing</a>
            <a href="index.php?page=komputer" class="btn btn-outline-neon">Cek Komputer</a>
        </div>
        <div class="col-lg-4 position-relative">
            <div class="cyber-card p-3">
                <div class="d-flex justify-content-between mb-2"><span>PC Online</span><span class="neon-text"><?= $stats['pc_dipakai'] ?></span></div>
                <div class="progress bg-dark" role="progressbar">
                    <?php $totalPc = max(1, $stats['pc_dipakai'] + $stats['pc_tersedia']); $percent = ($stats['pc_dipakai'] / $totalPc) * 100; ?>
                    <div class="progress-bar" style="width: <?= $percent ?>%; background:#39ff88;"></div>
                </div>
                <p class="small text-muted-custom mt-3 mb-0">Monitoring PC.</p>
            </div>
        </div>
    </div>
</section>

<div class="row g-3">
    <div class="col-md-3 col-sm-6">
        <div class="cyber-card stat-card p-3">
            <div class="stat-icon mb-3">👤</div>
            <p class="text-muted-custom mb-1">Total Pelanggan</p>
            <h3 class="fw-bold"><?= $stats['total_pelanggan'] ?></h3>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="cyber-card stat-card p-3">
            <div class="stat-icon mb-3">💻</div>
            <p class="text-muted-custom mb-1">PC Tersedia</p>
            <h3 class="fw-bold"><?= $stats['pc_tersedia'] ?></h3>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="cyber-card stat-card p-3">
            <div class="stat-icon mb-3">🎮</div>
            <p class="text-muted-custom mb-1">PC Dipakai</p>
            <h3 class="fw-bold"><?= $stats['pc_dipakai'] ?></h3>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="cyber-card stat-card p-3">
            <div class="stat-icon mb-3">💸</div>
            <p class="text-muted-custom mb-1">Pendapatan</p>
            <h3 class="fw-bold"><?= rupiah($stats['total_pendapatan']) ?></h3>
        </div>
    </div>
</div>
