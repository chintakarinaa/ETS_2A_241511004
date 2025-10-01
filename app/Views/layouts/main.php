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
            <a class="navbar-brand fw-bold" href="/">Student Courses</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (session()->get('role') === 'gudang'): ?>
                        <li class="nav-item"><a class="nav-link" href="/gudang/stocks">Stocks</a></li>
                    <?php elseif (session()->get('role') === 'dapur'): ?>
                        <li class="nav-item"><a class="nav-link" href="/dapur/courses">Stock Request</a></li>
                        <li class="nav-item"><a class="nav-link" href="/dapur/courses/my">Stock Status</a></li>


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
    <script src="/js/app.js"></script>

</body>

</html>