<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'create') {
        $durasi = (float)$_POST['durasi_jam'];
        $tarif = (float)$_POST['tarif_per_jam'];
        $total = $durasi * $tarif;
        $stmt = $pdo->prepare('INSERT INTO sesi_billing (id_pelanggan, id_komputer, waktu_mulai, durasi_jam, tarif_per_jam, total_bayar, status_bayar) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$_POST['id_pelanggan'], $_POST['id_komputer'], $_POST['waktu_mulai'], $durasi, $tarif, $total, $_POST['status_bayar']]);
        $pdo->prepare("UPDATE komputer SET status='Dipakai' WHERE id_komputer=?")->execute([$_POST['id_komputer']]);
    } elseif ($action === 'update_status') {
        $stmt = $pdo->prepare('UPDATE sesi_billing SET status_bayar=? WHERE id_sesi=?');
        $stmt->execute([$_POST['status_bayar'], $_POST['id_sesi']]);
        if ($_POST['status_bayar'] === 'Lunas') {
            $idKomputer = $pdo->prepare('SELECT id_komputer FROM sesi_billing WHERE id_sesi=?');
            $idKomputer->execute([$_POST['id_sesi']]);
            $komputer = $idKomputer->fetchColumn();
            if ($komputer) $pdo->prepare("UPDATE komputer SET status='Tersedia' WHERE id_komputer=?")->execute([$komputer]);
        }
    } elseif ($action === 'delete') {
        $idKomputer = $pdo->prepare('SELECT id_komputer FROM sesi_billing WHERE id_sesi=?');
        $idKomputer->execute([$_POST['id_sesi']]);
        $komputer = $idKomputer->fetchColumn();
        $pdo->prepare('DELETE FROM sesi_billing WHERE id_sesi=?')->execute([$_POST['id_sesi']]);
        if ($komputer) $pdo->prepare("UPDATE komputer SET status='Tersedia' WHERE id_komputer=?")->execute([$komputer]);
    }
    echo '<script>location.href="index.php?page=billing"</script>';
    exit;
}
$pelanggan = $pdo->query('SELECT * FROM pelanggan ORDER BY nama ASC')->fetchAll(PDO::FETCH_ASSOC);
$komputer = $pdo->query("SELECT * FROM komputer WHERE status IN ('Tersedia','Dipakai') ORDER BY kode_pc ASC")->fetchAll(PDO::FETCH_ASSOC);
$sesi = $pdo->query("SELECT s.*, p.nama, k.kode_pc FROM sesi_billing s JOIN pelanggan p ON s.id_pelanggan=p.id_pelanggan JOIN komputer k ON s.id_komputer=k.id_komputer ORDER BY s.id_sesi DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="cyber-card p-4">
            <h4 class="neon-text mb-3">Tambah Sesi Billing</h4>
            <form method="post">
                <input type="hidden" name="action" value="create">
                <div class="mb-3">
                    <label class="form-label">Pelanggan</label>
                    <select name="id_pelanggan" class="form-select" required>
                        <option value="">Pilih pelanggan</option>
                        <?php foreach ($pelanggan as $row): ?><option value="<?= e($row['id_pelanggan']) ?>"><?= e($row['nama']) ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">  
                    <label class="form-label">Komputer</label>
                    <select name="id_komputer" class="form-select" required>
                        <option value="">Pilih PC</option>
                        <?php foreach ($komputer as $row): ?><option value="<?= e($row['id_komputer']) ?>"><?= e($row['kode_pc']) ?> - <?= e($row['status']) ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Waktu Mulai</label>
                    <input type="datetime-local" name="waktu_mulai" class="form-control" required>
                </div>
                <div class="row g-2">
                    <div class="col-6 mb-3">
                        <label class="form-label">Durasi/Jam</label>
                        <input id="durasi" type="number" step="0.5" min="0.5" name="durasi_jam" class="form-control" required value="1">
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">Tarif/Jam</label>
                        <input id="tarif" type="number" min="0" name="tarif_per_jam" class="form-control" required value="5000">
                    </div>
                </div>
                <div class="cyber-card p-3 mb-3">
                    <span class="text-muted-custom">Preview Total:</span>
                    <h4 id="previewTotal" class="neon-text mb-0">Rp 0</h4>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status Bayar</label>
                    <select name="status_bayar" class="form-select">
                        <option value="Belum Lunas">Belum Lunas</option>
                        <option value="Lunas">Lunas</option>
                    </select>
                </div>
                <button class="btn btn-neon w-100" type="submit">Simpan Billing</button>
            </form>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="cyber-card p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-3">
                <h4 class="neon-text mb-0">Riwayat Billing</h4>
                <input id="searchTable" class="form-control" placeholder="Cari sesi...">
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead><tr><th>Pelanggan</th><th>PC</th><th>Durasi</th><th>Total</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                    <?php foreach ($sesi as $row): ?>
                        <tr>
                            <td><?= e($row['nama']) ?><br><small class="text-muted-custom"><?= e($row['waktu_mulai']) ?></small></td>
                            <td><?= e($row['kode_pc']) ?></td>
                            <td><?= e($row['durasi_jam']) ?> jam</td>
                            <td><?= rupiah($row['total_bayar']) ?></td>
                            <td><span class="badge <?= $row['status_bayar'] === 'Lunas' ? 'badge-neon' : 'badge-danger-soft' ?>"><?= e($row['status_bayar']) ?></span></td>
                            <td class="text-nowrap">
                                <form method="post" class="d-inline">
                                    <input type="hidden" name="action" value="update_status">
                                    <input type="hidden" name="id_sesi" value="<?= e($row['id_sesi']) ?>">
                                    <input type="hidden" name="status_bayar" value="<?= $row['status_bayar'] === 'Lunas' ? 'Belum Lunas' : 'Lunas' ?>">
                                    <button class="btn btn-sm btn-outline-neon" type="submit">Toggle</button>
                                </form>
                                <form method="post" class="d-inline" onsubmit="return confirm('Hapus sesi ini?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id_sesi" value="<?= e($row['id_sesi']) ?>">
                                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
