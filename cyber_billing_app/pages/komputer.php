<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {    // Fungsi untuk mengelola komputer
    $action = $_POST['action'] ?? '';
    if ($action === 'create') {
        $stmt = $pdo->prepare('INSERT INTO komputer (kode_pc, spesifikasi, status) VALUES (?, ?, ?)');
        $stmt->execute([$_POST['kode_pc'], $_POST['spesifikasi'], $_POST['status']]);
    } elseif ($action === 'update') {
        $stmt = $pdo->prepare('UPDATE komputer SET kode_pc=?, spesifikasi=?, status=? WHERE id_komputer=?');
        $stmt->execute([$_POST['kode_pc'], $_POST['spesifikasi'], $_POST['status'], $_POST['id_komputer']]);
    } elseif ($action === 'delete') {
        $stmt = $pdo->prepare('DELETE FROM komputer WHERE id_komputer=?');
        $stmt->execute([$_POST['id_komputer']]);
    }
    echo '<script>location.href="index.php?page=komputer"</script>';
    exit;
}
$edit = null;   // Variabel untuk menyimpan data komputer yang sedang diedit
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare('SELECT * FROM komputer WHERE id_komputer=?');
    $stmt->execute([$_GET['edit']]);
    $edit = $stmt->fetch(PDO::FETCH_ASSOC);
}
$komputer = $pdo->query('SELECT * FROM komputer ORDER BY kode_pc ASC')->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="row g-4">
    <div class="col-lg-4">
        <div class="cyber-card p-4">
            <h4 class="neon-text mb-3"><?= $edit ? 'Edit Komputer' : 'Tambah Komputer' ?></h4>
            <form method="post">
                <input type="hidden" name="action" value="<?= $edit ? 'update' : 'create' ?>">
                <?php if ($edit): ?><input type="hidden" name="id_komputer" value="<?= e($edit['id_komputer']) ?>"><?php endif; ?>
                <div class="mb-3">
                    <label class="form-label">Kode PC</label>
                    <input type="text" name="kode_pc" class="form-control" placeholder="PC-01" required value="<?= e($edit['kode_pc'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Spesifikasi</label>
                    <textarea name="spesifikasi" class="form-control" rows="3" placeholder="Ryzen 5, RAM 16GB, RTX..." required><?= e($edit['spesifikasi'] ?? '') ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <?php foreach (['Tersedia','Dipakai','Maintenance'] as $status): ?>
                            <option value="<?= $status ?>" <?= (($edit['status'] ?? '') === $status) ? 'selected' : '' ?>><?= $status ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-neon w-100" type="submit">Simpan</button>
                <?php if ($edit): ?><a class="btn btn-outline-neon w-100 mt-2" href="index.php?page=komputer">Batal Edit</a><?php endif; ?>
            </form>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="cyber-card p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-3">
                <h4 class="neon-text mb-0">Data Komputer</h4>
                <input id="searchTable" class="form-control" placeholder="Cari PC...">
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead><tr><th>Kode</th><th>Spesifikasi</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                    <?php foreach ($komputer as $row): ?>
                        <tr>
                            <td class="fw-bold"><?= e($row['kode_pc']) ?></td>
                            <td><?= e($row['spesifikasi']) ?></td>
                            <td>
                                <span class="badge <?= $row['status'] === 'Tersedia' ? 'badge-neon' : ($row['status'] === 'Dipakai' ? 'badge-danger-soft' : 'text-bg-warning') ?>">
                                    <?= e($row['status']) ?>
                                </span>
                            </td>
                            <td class="text-nowrap">
                                <a class="btn btn-sm btn-outline-neon" href="index.php?page=komputer&edit=<?= e($row['id_komputer']) ?>">Edit</a>
                                <form method="post" class="d-inline" onsubmit="return confirm('Hapus komputer ini?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id_komputer" value="<?= e($row['id_komputer']) ?>">
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
