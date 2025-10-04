<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="card-title">Daftar Permintaan Bahan</h3>
        <a href="/dapur/requests/create" class="btn btn-primary mb-3">+ Buat Permintaan</a>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Masak</th>
                    <th>Menu</th>
                    <th>Jumlah Porsi</th>
                    <th>Bahan Diperlukan</th> 
                    <th>Status</th>
                    <th>Alasan Ditolak</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($permintaan)): ?>
                    <?php foreach ($permintaan as $i => $row): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= $row['tgl_masak'] ?></td>
                            <td><?= $row['menu_makan'] ?></td>
                            <td><?= $row['jumlah_porsi'] ?></td>
                            <td>
                                <?php if (!empty($row['detail_bahan'])): ?>
                                    <ul class="mb-0">
                                        <?php foreach ($row['detail_bahan'] as $bahan): ?>
                                            <li>
                                                <?= esc($bahan['nama_bahan']) ?> - 
                                                <?= esc($bahan['jumlah_diminta']) ?> <?= esc($bahan['satuan']) ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <em>Tidak ada</em>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($row['status'] == 'menunggu'): ?>
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                <?php elseif ($row['status'] == 'disetujui'): ?>
                                    <span class="badge bg-success">Disetujui</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Ditolak</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($row['status'] == 'ditolak' && !empty($row['alasan_penolakan'])): ?>
                                    <?= esc($row['alasan_penolakan']) ?>
                                <?php else: ?>
                                    <em>-</em>
                                <?php endif; ?>
                            </td>
                            <td><?= $row['created_at'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8" class="text-center">Belum ada permintaan</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
