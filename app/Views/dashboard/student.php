<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="card-title">Welcome, Student</h2>
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
                <a href="/courses" class="text-decoration-none">📖 View Courses & Enroll</a>
            </li>
            <li class="list-group-item"><a href="/mission-4/courses" class="text-decoration-none">👨‍🎓 Mission 4 </a>
            </li>
        </ul>
    </div>
</div>
<?= $this->endSection() ?>