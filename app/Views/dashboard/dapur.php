<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="card-title">Welcome.</h2>
        <p class="text-muted">Pilih menu di bawah ini:</p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <ul class="list-group mt-3">
            <li class="list-group-item">
                <a href="/dapur/requests/create" class="text-decoration-none">Buat permintaan Bahan</a>
            </li>
            <li class="list-group-item">
                <a href="/dapur/requests" class="text-decoration-none">Lihat Status Permintaan</a>
            </li>
        </ul>
    </div>
</div>
<?= $this->endSection() ?>