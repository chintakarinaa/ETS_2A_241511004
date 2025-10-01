<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="card-title">Welcome, Admin</h2>
        <p class="text-muted">Kelola data di bawah ini:</p>
        <ul class="list-group mt-3">
            <li class="list-group-item"><a href="/admin/courses" class="text-decoration-none"> Manage Courses</a></li>
            <li class="list-group-item"><a href="/admin/students" class="text-decoration-none"> Manage Students</a>
            </li>
            <li class="list-group-item"><a href="/mission-4/admin" class="text-decoration-none"> Mission 4 </a>
            </li>
        </ul>
    </div>
</div>
<?= $this->endSection() ?>