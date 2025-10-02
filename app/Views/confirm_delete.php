<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-body">
        <h3>Konfirmasi Hapus</h3>
        <p>
            Apakah kamu yakin ingin menghapus 
            <strong><?= esc($stock['nama']) ?></strong>
            (Kategori: <?= esc($stock['kategori']) ?>, Jumlah: <?= esc($stock['jumlah']) ?> <?= esc($stock['satuan']) ?>)?
        </p>

        <form method="post" action="/gudang/stocks/delete/<?= $stock['id'] ?>">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            <a href="/gudang/stocks" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>