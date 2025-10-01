<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="card-title">Welcome.</h2>
        <p class="text-muted">Kelola data di bawah ini:</p>
        <ul class="list-group mt-3">
            <li class="list-group-item"><a href="/gudang/Stocks" class="text-decoration-none"> Manage Stocks</a></li>
        </ul>
    </div>
</div>
<?= $this->endSection() ?>