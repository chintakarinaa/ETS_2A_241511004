<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">MBG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (session()->get('role') === 'gudang'): ?>
                        <li class="nav-item"><a class="nav-link" href="/gudang/stocks">Stocks</a></li>
                        <li class="nav-item"><a class="nav-link" href="/gudang/requests">Requests</a></li>
                    <?php elseif (session()->get('role') === 'dapur'): ?>
                        <li class="nav-item"><a class="nav-link" href="/dapur/requests/create">Buat Permintaan</a></li>
                        <li class="nav-item"><a class="nav-link" href="/dapur/requests">Status Permintaan</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link text-danger" href="/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container py-5">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/app.js"></script>
    <script>
        function confirmDelete(id, nama, kategori, kadaluarsa) {
            Swal.fire({
                title: 'Yakin mau hapus?',
                html: `
                    <p><b>Nama:</b> ${nama}</p>
                    <p><b>Kategori:</b> ${kategori}</p>
                    <p><b>Kadaluarsa:</b> ${kadaluarsa}</p>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/gudang/stocks/delete/' + id;
                }
            });
        }

        <?php if (session()->getFlashdata('success')): ?>
        <?php if (session()->getFlashdata('success_two_buttons')): ?>
        Swal.fire({
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('success') ?>',
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'Lihat Status Permintaan',
            cancelButtonText: 'Kembali ke Dashboard',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/dapur/requests";
            } else {
                window.location.href = "/";
            }
        });
        <?php else: ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('success') ?>'
        });
        <?php endif; ?>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '<?= session()->getFlashdata('error') ?>'
        });
        <?php endif; ?>
    </script>

</body>

</html>
