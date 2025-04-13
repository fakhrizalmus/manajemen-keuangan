<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Add Pengeluaran</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../admin/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    @include('static.navbar')
    <div id="layoutSidenav">
        @include('static.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Add Pengeluaran</h1>
                </div>
                <div class="card mb-4">
                    <form action="{{ route('store-pengeluaran') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-3 align-items-center">
                                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal" id="tanggal"
                                        value="{{ date('Y-m-d') }}">
                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <label for="kategori_id" class="col-sm-2 col-form-label">Nama Kategori</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('kategori_id') is-invalid @enderror"
                                        name="kategori_id" id="kategori_id">
                                        <option selected disabled>-- Pilih Kategori --</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                        name="jumlah" id="jumlah" value="0">
                                    @error('jumlah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="rupiah" value="Rp 0" readonly>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                        name="keterangan" id="keterangan" value="{{ old('keterangan') }}">
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    @include('static.js')
    <script>
        const jumlahInput = document.getElementById('jumlah');
        const rupiahInput = document.getElementById('rupiah');

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        jumlahInput.addEventListener('input', function() {
            const jumlah = parseInt(this.value) || 0;
            rupiahInput.value = formatRupiah(jumlah);
        });
    </script>
</body>

</html>
