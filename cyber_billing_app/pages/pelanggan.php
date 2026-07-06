<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'create') {
        $stmt = $pdo->prepare('INSERT INTO pelanggan (nama, no_hp, alamat) VALUES (?, ?, ?)');
        $stmt->execute([$_POST['nama'], $_POST['no_hp'], $_POST['alamat']]);
    } elseif ($action === 'update') {
        $stmt = $pdo->prepare('UPDATE pelanggan SET nama=?, no_hp=?, alamat=? WHERE id_pelanggan=?');
        $stmt->execute([$_POST['nama'], $_POST['no_hp'], $_POST['alamat'], $_POST['id_pelanggan']]);
    } elseif ($action === 'delete') {
        $stmt = $pdo->prepare('DELETE FROM pelanggan WHERE id_pelanggan=?');
        $stmt->execute([$_POST['id_pelanggan']]);
    }
    echo '<script>location.href="index.php?page=pelanggan"</script>';
    exit;
}
$edit = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare('SELECT * FROM pelanggan WHERE id_pelanggan=?');
    $stmt->execute([$_GET['edit']]);
    $edit = $stmt->fetch(PDO::FETCH_ASSOC);
}
$pelanggan = $pdo->query('SELECT * FROM pelanggan ORDER BY id_pelanggan DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="cyber-card p-4">
            <h4 class="neon-text mb-3"><?= $edit ? 'Edit Pelanggan' : 'Tambah Pelanggan' ?></h4>
            <form method="post">
                <input type="hidden" name="action" value="<?= $edit ? 'update' : 'create' ?>">
                <?php if ($edit): ?><input type="hidden" name="id_pelanggan" value="<?= e($edit['id_pelanggan']) ?>"><?php endif; ?>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" required value="<?= e($edit['nama'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control" value="<?= e($edit['no_hp'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3"><?= e($edit['alamat'] ?? '') ?></textarea>
                </div>
                <button class="btn btn-neon w-100" type="submit">Simpan</button>
                <?php if ($edit): ?><a class="btn btn-outline-neon w-100 mt-2" href="index.php?page=pelanggan">Batal Edit</a><?php endif; ?>
            </form>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="cyber-card p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-3">
                <h4 class="neon-text mb-0">Data Pelanggan</h4>
                <input id="searchTable" class="form-control w-md-50" placeholder="Cari pelanggan...">
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead><tr><th>Nama</th><th>No HP</th><th>Alamat</th><th>Aksi</th></tr></thead>
                    <tbody>
                    <?php foreach ($pelanggan as $row): ?>
                        <tr>
                            <td><?= e($row['nama']) ?></td>
                            <td><?= e($row['no_hp']) ?></td>
                            <td><?= e($row['alamat']) ?></td>
                            <td class="text-nowrap">
                                <a class="btn btn-sm btn-outline-neon" href="index.php?page=pelanggan&edit=<?= e($row['id_pelanggan']) ?>">Edit</a>
                                <form method="post" class="d-inline" onsubmit="return confirm('Hapus pelanggan ini?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id_pelanggan" value="<?= e($row['id_pelanggan']) ?>">
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
