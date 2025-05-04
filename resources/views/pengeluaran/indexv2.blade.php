<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="adminv2/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="adminv2/assets/img/favicon.png">
    <title>
        Master Pengeluaran
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="adminv2/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="adminv2/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="adminv2/assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
    @include('staticv2.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('staticv2.navbar')
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-12">
                    <form method="GET" action="{{ route('pengeluarans') }}">
                        <div class="row g-3 align-items-stretch mb-4">
                            <div class="col-md-3">
                                <input type="date"
                                    class="form-control border border-black rounded ps-3 @error('start_date') is-invalid @enderror"
                                    name="start_date" id="start_date"
                                    value="{{ request('start_date') ?? date('Y-m-01') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <input type="date"
                                    class="form-control border border-black rounded ps-3 @error('end_date') is-invalid @enderror"
                                    name="end_date" id="end_date" value="{{ request('end_date') ?? date('Y-m-d') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-dark w-100 text-white">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div
                                class="bg-gradient-dark shadow-dark border-radius-lg d-flex justify-content-between align-items-center px-3 py-3">
                                <h6 class="text-white text-capitalize m-0">Daftar Pengeluaran</h6>
                                <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                    data-bs-target="#modalAddPengeluaran">
                                    <i class="fa fa-plus me-1"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px"
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>
                                            <th style="width: 50px"
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama Kategori</th>
                                            <th style="width: 50px"
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Tanggal</th>
                                            <th style="width: 50px"
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Jumlah</th>
                                            <th style="width: 50px"
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Keterangan</th>
                                            <th style="width: 50px"
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 0;
                                        @endphp
                                        @for ($i = 0; $i < count($pengeluaran); $i++)
                                            @php
                                                $no++;
                                            @endphp
                                            <tr>
                                                <td style="text-align: center">
                                                    {{ $no }}
                                                </td>
                                                <td>{{ $pengeluaran[$i]->kategoris->nama_kategori }}</td>
                                                <td>{{ $pengeluaran[$i]->tanggal }}</td>
                                                <td>{{ 'Rp ' . number_format($pengeluaran[$i]->jumlah, 0, ',', '.') }}
                                                </td>
                                                <td>{{ $pengeluaran[$i]->keterangan == null ? '-' : $pengeluaran[$i]->keterangan }}
                                                </td>
                                                <td style="text-align: center">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmDeleteModal{{ $pengeluaran[$i]->id }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEditPengeluaran{{ $pengeluaran[$i]->id }}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Modal Konfirmasi Delete -->
                                            <div class="modal fade" id="confirmDeleteModal{{ $pengeluaran[$i]->id }}"
                                                tabindex="-1" aria-labelledby="modalLabel{{ $pengeluaran[$i]->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow">
                                                        <div class="modal-header bg-gradient-dark">
                                                            <h5 class="modal-title"
                                                                id="modalLabel{{ $pengeluaran[$i]->id }}"
                                                                style="color: white">
                                                                Konfirmasi Hapus
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <i
                                                                class="fa-solid fa-triangle-exclamation fa-3x text-warning mb-3"></i>
                                                            <p>Yakin ingin menghapus data?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <form
                                                                action="{{ route('delete-pengeluaran', $pengeluaran[$i]->id) }}"
                                                                method="post" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn bg-gradient-dark text-white">
                                                                    Ya, Hapus
                                                                </button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Batal
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Edit -->
                                            <div class="modal fade"
                                                id="modalEditPengeluaran{{ $pengeluaran[$i]->id }}" tabindex="-1"
                                                aria-labelledby="modalEditPengeluaranLabel{{ $pengeluaran[$i]->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow">
                                                        <div class="modal-header bg-gradient-dark">
                                                            <h5 class="modal-title text-white"
                                                                id="modalEditPengeluaranLabel{{ $pengeluaran[$i]->id }}">
                                                                Edit Pengeluaran</h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form
                                                            action="{{ route('edit-pengeluaran', $pengeluaran[$i]->id) }}"
                                                            method="POST" role="form"
                                                            class="text-start p-4 rounded">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <div style="input-group input-group-outline my-3">
                                                                        <label for="tanggal"
                                                                            class="form-label">Tanggal</label>
                                                                        <input type="date"
                                                                            class="form-control border border-secondary @error('tanggal') is-invalid @enderror"
                                                                            name="tanggal" id="tanggal"
                                                                            value="{{ $pengeluaran[$i]->tanggal }}"
                                                                            required>
                                                                        @error('tanggal')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div style="input-group input-group-outline my-3">
                                                                        <label for="kategori_id"
                                                                            class="form-label">Nama Kategori</label>
                                                                        <select
                                                                            class="form-select border border-secondary @error('kategori_id') is-invalid @enderror"
                                                                            name="kategori_id" id="kategori_id"
                                                                            required>
                                                                            <option selected disabled
                                                                                class="text-muted">-- Pilih Kategori --
                                                                            </option>
                                                                            @foreach ($kategori as $itemKategori)
                                                                                <option
                                                                                    value="{{ $itemKategori->id }}"
                                                                                    {{ $itemKategori->id == $pengeluaran[$i]->kategori_id ? 'selected' : '' }}>
                                                                                    {{ $itemKategori->nama_kategori }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('kategori_id')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <div class="col-md-6">
                                                                        <div
                                                                            class="input-group input-group-outline my-3 {{ $pengeluaran[$i]->jumlah ? 'is-filled' : '' }}">
                                                                            <label for="jumlah_"
                                                                                class="form-label">Jumlah</label>
                                                                            <input type="number" id="jumlah_"
                                                                                name="jumlah"
                                                                                value="{{ $pengeluaran[$i]->jumlah }}"
                                                                                oninput="formatRupiah()"
                                                                                class="form-control" required />
                                                                            @error('jumlah')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div
                                                                            class="input-group input-group-outline my-3 is-filled">
                                                                            <label for="rupiah_"
                                                                                class="form-label">Jumlah
                                                                                (Rupiah)</label>
                                                                            <input type="text" id="rupiah_"
                                                                                value="Rp {{ number_format($pengeluaran[$i]->jumlah, 0, ',', '.') }}"
                                                                                class="form-control" readonly />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="input-group input-group-outline my-3">
                                                                        <label for="keterangan"
                                                                            class="form-label">Keterangan</label>
                                                                        <input type="text"
                                                                            class="form-control border border-secondary @error('keterangan') is-invalid @enderror"
                                                                            name="keterangan" id="keterangan"
                                                                            value="{{ $pengeluaran[$i]->keterangan }}">
                                                                        @error('keterangan')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="modal-footer justify-content-center border-top border-secondary">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-light bg-dark text-white">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </tbody>
                                </table>
                                <!-- Pagination and Limit -->
                                <div class="d-flex ps-3 justify-content-start align-items-center mt-3">
                                    <!-- Pagination -->
                                    <div>
                                        {{ $pengeluaran->links('pagination::bootstrap-5') }}
                                    </div>

                                    <!-- Limit Form -->
                                    <form method="GET" action="{{ request()->url() }}"
                                        class="d-flex align-items-center gap-2 mb-0 ms-auto">
                                        <label for="limit" class="mb-0">Tampilkan:</label>
                                        <select name="limit" id="limit"
                                            class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                                            @foreach ([5, 10, 20, 50] as $option)
                                                <option value="{{ $option }}"
                                                    {{ request('limit', 10) == $option ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-muted">data per halaman</span>

                                        {{-- Hidden inputs for start_date and end_date --}}
                                        @if (request('start_date'))
                                            <input type="hidden" name="start_date"
                                                value="{{ request('start_date') }}">
                                        @endif
                                        @if (request('end_date'))
                                            <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Tambah Pengeluaran -->
        <div class="modal fade" id="modalAddPengeluaran" tabindex="-1" aria-labelledby="modalAddPengeluaranLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-gradient-dark">
                        <h5 class="modal-title text-white" id="modalAddPengeluaranLabel">Tambah Pengeluaran</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('store-pengeluaran') }}" method="POST" role="form"
                        class="text-start p-4 rounded">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <div style="input-group input-group-outline my-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date"
                                        class="form-control ps-3 border border-secondary @error('tanggal') is-invalid @enderror"
                                        name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <div style="input-group input-group-outline my-3">
                                    <label for="kategori_id" class="form-label">Nama Kategori</label>
                                    <select
                                        class="form-select ps-3 border border-secondary @error('kategori_id') is-invalid @enderror"
                                        name="kategori_id" id="kategori_id" required>
                                        <option selected disabled class="text-muted">-- Pilih Kategori --</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="jumlah_" class="form-label">Jumlah</label>
                                        <input type="number"
                                            class="form-control border border-secondary @error('jumlah') is-invalid @enderror"
                                            name="jumlah" id="jumlah_" value="{{ $item->jumlah }}"
                                            oninput="formatRupiah()" required>
                                        @error('jumlah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3 is-filled">
                                        <label for="rupiah_" class="form-label">Jumlah
                                            (Rupiah)</label>
                                        <input type="text" class="form-control border border-secondary"
                                            id="rupiah_" value="Rp {{ number_format($item->jumlah, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group input-group-outline my-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text"
                                        class="form-control border border-secondary @error('keterangan') is-invalid @enderror"
                                        name="keterangan" id="keterangan" value="{{ old('keterangan') }}">
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center border-top border-secondary">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-light bg-dark text-white">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('staticv2.footer')
    </main>
    <script>
        function formatRupiah() {
            const jumlahInput = document.getElementById('jumlah_');
            const rupiahDisplay = document.getElementById('rupiah_');

            let value = parseInt(jumlahInput.value);
            if (isNaN(value)) value = 0;

            rupiahDisplay.value = 'Rp ' + value.toLocaleString('id-ID');
        }
    </script>
    <!--   Core JS Files   -->
    <script src="adminv2/assets/js/core/popper.min.js"></script>
    <script src="adminv2/assets/js/core/bootstrap.min.js"></script>
    <script src="adminv2/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="adminv2/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="adminv2/assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>
