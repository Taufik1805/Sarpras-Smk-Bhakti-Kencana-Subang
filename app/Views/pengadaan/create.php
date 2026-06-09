<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Pengadaan</h4>
        </div>

        <div class="card-body">

            <form action="<?= site_url('pengadaan/store') ?>" method="post">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kode Pengadaan</label>
                        <input
                            type="text"
                            name="kode_pengadaan"
                            class="form-control"
                            value="<?= $kodePengadaan ?>"
                            readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Pengadaan</label>
                        <input
                            type="date"
                            name="tanggal_pengadaan"
                            class="form-control"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input
                            type="text"
                            name="nama_barang"
                            class="form-control"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Aset</label>
                        <select
                            name="jenis_aset"
                            class="form-select"
                            required>

                            <option value="">Pilih Jenis Aset</option>
                            <option value="Sarana">Sarana</option>
                            <option value="Prasarana">Prasarana</option>

                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jumlah</label>
                        <input
                            type="number"
                            name="jumlah"
                            id="jumlah"
                            class="form-control"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga Satuan</label>
                        <input
                            type="number"
                            name="harga_satuan"
                            id="harga_satuan"
                            class="form-control"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pemasok</label>
                        <input
                            type="text"
                            name="pemasok"
                            class="form-control"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Total Harga</label>
                        <input
                            type="number"
                            id="total_harga"
                            class="form-control"
                            readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sumber Dana</label>
                        <select
                            name="sumber_dana"
                            class="form-select">

                            <option value="">Pilih Sumber Dana</option>
                            <option value="BOS">BOS</option>
                            <option value="APBD">APBD</option>
                            <option value="Yayasan">Yayasan</option>
                            <option value="Donasi">Donasi</option>

                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Lokasi Penempatan</label>
                        <input
                            type="text"
                            name="lokasi_penempatan"
                            class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea
                            name="keterangan"
                            rows="4"
                            class="form-control"></textarea>
                    </div>

                </div>

                <div class="mt-3">
                    <a href="<?= site_url('pengadaan') ?>" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Simpan Pengadaan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<script>

const jumlah = document.getElementById('jumlah');
const harga = document.getElementById('harga_satuan');
const total = document.getElementById('total_harga');

function hitungTotal()
{
    let jml = parseInt(jumlah.value) || 0;
    let hrg = parseInt(harga.value) || 0;

    total.value = jml * hrg;
}

jumlah.addEventListener('keyup', hitungTotal);
harga.addEventListener('keyup', hitungTotal);

</script>

<?= $this->endSection() ?>
