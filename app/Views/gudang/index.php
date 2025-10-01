<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="card-title">Manage Stock</h3>
        <a href="/admin/stocks/create" class="btn btn-primary mb-3">+ Add Stock</a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Stock Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stocks as $i => $s): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($s['stock_name']) ?></td>
                        <td><?= esc($s['quantity']) ?></td>
                        <td>
                            <a href="/admin/stocks/edit/<?= $s['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="/admin/stocks/delete/<?= $s['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this stock?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>