<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="card-title">Manage Stock</h3>
        <a href="/gudang/stocks/create" class="btn btn-primary mb-3">+ Add Stock</a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Stock Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stocks as $i => $s): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($s['nama']) ?></td>
                        <td><?= esc($s['kategori']) ?></td>
                        <td><?= esc($s['jumlah']) ?> <?= esc($s['satuan']) ?></td>
                        <td><?= esc($s['tanggal_masuk']) ?></td>
                        <td><?= esc($s['tanggal_kadaluarsa']) ?></td>
                        <td><?= esc($s['status']) ?></td>
                        <td>
                            <a href="/gudang/stocks/edit/<?= $s['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="/gudang/stocks/delete/<?= $s['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this stock?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>