<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="card-title">Permintaan dari Dapur</h3>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (empty($requests)): ?>
            <p class="text-muted">Tidak ada permintaan yang menunggu.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal Masak</th>
                        <th>Menu</th>
                        <th>Bahan yang Diminta</th> 
                        <th>Jumlah Porsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $r): ?>
                        <tr>
                            <td><?= esc($r['tgl_masak']) ?></td>
                            <td><?= esc($r['menu_makan']) ?></td>
                            <td>
                                <ul class="mb-0">
                                    <?php foreach ($r['detail_bahan'] as $b): ?>
                                        <li><?= esc($b['nama_bahan']) ?>: <?= esc($b['jumlah_diminta']) ?> <?= esc($b['satuan']) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td><?= esc($r['jumlah_porsi']) ?></td>
                            <td>
                                <form method="post" action="/gudang/requests/approve/<?= $r['id'] ?>" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                </form>

                                <button class="btn btn-danger btn-sm" onclick="showRejectModal(<?= $r['id'] ?>)">Tolak</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" id="rejectForm">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Permintaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Alasan Penolakan</label>
                    <textarea name="alasan" class="form-control" required></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" type="submit">Tolak Permintaan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function showRejectModal(id) {
        const form = document.getElementById('rejectForm');
        form.action = '/gudang/requests/reject/' + id;
        const modal = new bootstrap.Modal(document.getElementById('rejectModal'));
        modal.show();
    }
</script>

<?= $this->endSection() ?>
