<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="card-title">Add Stock</h3>
        <form method="post" action="/admin/stocks/store">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Stock Name</label>
                <input type="text" name="stock_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <button class="btn btn-success">Save</button>
            <a href="/admin/stocks" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>