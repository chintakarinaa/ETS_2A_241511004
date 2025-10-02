<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="card-title">Edit Stock</h3>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form method="post" action="/gudang/stocks/update/<?= $stock['id'] ?>">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" value="<?= esc($stock['jumlah']) ?>" class="form-control" required>
            </div>
            <button class="btn btn-success" onclick="return confirmSave(this.form)">Save</button>
            <a href="/gudang/stocks" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>