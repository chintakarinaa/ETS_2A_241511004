<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="card-title">Buat Permintaan Bahan</h3>

        <form action="/dapur/requests/store" method="post">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label>Tanggal Masak</label>
                <input type="date" name="tgl_masak" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Menu Masakan</label>
                <input type="text" name="menu_makan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Jumlah Porsi</label>
                <input type="number" name="jumlah_porsi" class="form-control" min="1" required>
            </div>

            <hr>

            <h5>Daftar Bahan Baku</h5>
            <table class="table" id="bahanTable">
                <thead>
                    <tr>
                        <th>Nama Bahan</th>
                        <th>Jumlah</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="bahan_id[]" class="form-select" required>
                                <option value="">-- Pilih Bahan --</option>
                                <?php foreach ($bahan as $b): ?>
                                    <option value="<?= $b['id'] ?>">
                                        <?= $b['nama'] ?> (stok: <?= $b['jumlah'] ?> <?= $b['satuan'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="jumlah_diminta[]" class="form-control" min="1" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="btn btn-secondary" onclick="addRow()">+ Tambah Bahan</button>
            <hr>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<script>
function addRow() {
    let table = document.getElementById('bahanTable').getElementsByTagName('tbody')[0];
    let newRow = table.rows[0].cloneNode(true);
    newRow.querySelectorAll('input').forEach(input => input.value = '');
    table.appendChild(newRow);
}

function removeRow(btn) {
    let row = btn.closest('tr');
    let table = row.closest('tbody');
    if (table.rows.length > 1) {
        row.remove();
    }
}
</script>

<?= $this->endSection() ?>
