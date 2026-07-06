<?php
$laporan = $pdo->query("SELECT DATE(waktu_mulai) AS tanggal, COUNT(*) AS total_sesi, SUM(total_bayar) AS pendapatan FROM sesi_billing GROUP BY DATE(waktu_mulai) ORDER BY tanggal DESC")->fetchAll(PDO::FETCH_ASSOC);
$total = $pdo->query('SELECT COALESCE(SUM(total_bayar),0) FROM sesi_billing')->fetchColumn();
?>
<div class="cyber-card p-4 mb-4">
    <h3 class="neon-text">Laporan Pendapatan</h3>
    <p class="text-muted-custom mb-0">Rekap sesi billing.</p>
</div>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="cyber-card p-4">
            <p class="text-muted-custom mb-1">Total Semua Pendapatan</p>
            <h2 class="neon-text"><?= rupiah($total) ?></h2>
            <hr class="border-secondary">
            <p class="small text-muted-custom mb-0">Cair kawannnn!</p>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="cyber-card p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-3">
                <h4 class="neon-text mb-0">Rekap Harian</h4>
                <input id="searchTable" class="form-control" placeholder="Cari tanggal...">
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead><tr><th>Tanggal</th><th>Total Sesi</th><th>Pendapatan</th></tr></thead>
                    <tbody>
                    <?php foreach ($laporan as $row): ?>
                        <tr>
                            <td><?= e($row['tanggal']) ?></td>
                            <td><?= e($row['total_sesi']) ?></td>
                            <td><?= rupiah($row['pendapatan']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
