<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="card-title">Edit Stock</h3>
        <form method="post" action="/admin/stock/update/<?= $stock['stock_id'] ?>">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Stock Name</label>
                <input type="text" name="stock_name" value="<?= esc($stock['stock_name']) ?>" class="form-control"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" value="<?= esc($stock['quantity']) ?>" class="form-control"
                    required>
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="/admin/stock" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>