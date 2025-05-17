<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Basic Initialization | Mantis Bootstrap 5 Admin Template</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">

    @include('staticv2.css')

    <!-- [Page specific CSS] end -->
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    @include('staticv2.sidebar')
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
    @include('staticv2.navbar')
    <!-- [ Header ] end -->
    <section class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Master</a></li>
                                <li class="breadcrumb-item" aria-current="page">Pengeluaran</li>
                            </ul>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="page-header-title">
                                        <h2 class="mb-0">Master Pengeluaran</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="GET" action="{{ route('pengeluarans') }}">
                            <div class="row g-3 align-items-stretch">
                                <!-- Form group khusus untuk tanggal: buat sejajar -->
                                <div class="d-flex flex-wrap gap-2 col-12 col-md-4">
                                    <input type="date"
                                        class="form-control border border-black rounded-4 ps-3 @error('start_date') is-invalid @enderror"
                                        name="start_date" id="start_date"
                                        value="{{ request('start_date') ?? date('Y-m-01') }}" style="flex: 1 1 48%;">
                                    <input type="date"
                                        class="form-control border border-black rounded-4 ps-3 @error('end_date') is-invalid @enderror"
                                        name="end_date" id="end_date"
                                        value="{{ request('end_date') ?? date('Y-m-d') }}" style="flex: 1 1 48%;">
                                </div>

                                <!-- Kolom lain tetap seperti biasa -->
                                <div class="col-12 col-md-2">
                                    <input type="text" class="form-control border border-black rounded-4 ps-3"
                                        name="search" id="search" placeholder="Cari keterangan"
                                        value="{{ request('search') }}">
                                </div>

                                <div class="col-12 col-md-2">
                                    <select class="form-select border border-black rounded-4" name="kategori_id"
                                        id="kategori_id">
                                        <option value="" {{ request('kategori_id') ? '' : 'selected' }}>Semua
                                            Kategori</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}"
                                                {{ request('kategori_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 col-md-1">
                                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-4">
                                        <i class="ti ti-search"></i>
                                    </button>
                                </div>

                                <div class="col-6 col-md-1">
                                    <button type="button" class="btn btn-primary w-100 py-2 rounded-4"
                                        data-bs-toggle="modal" data-bs-target="#modalTambahPengeluaran">
                                        <i class="ti ti-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- Zero config table start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($pengeluaran as $index => $item)
                                            <tr>
                                                <td>{{ ($pengeluaran->currentPage() - 1) * $pengeluaran->perPage() + $index + 1 }}
                                                </td>
                                                <td>{{ $item->kategoris->nama_kategori }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ 'Rp ' . number_format($item->jumlah, 0, ',', '.') }}</td>
                                                <td>{{ $item->keterangan == null ? '-' : $item->keterangan }}</td>
                                                <td style="text-align: center">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmDeleteModal{{ $item->id }}">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEditPengeluaran{{ $item->id }}">
                                                        <i class="ti ti-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Modal Konfirmasi Delete -->
                                            <div class="modal fade" id="confirmDeleteModal{{ $item->id }}"
                                                tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title"
                                                                id="modalLabel{{ $item->id }}"
                                                                style="color: white">
                                                                Konfirmasi Hapus</h5>
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
                                                                action="{{ route('delete-pengeluaran', $item->id) }}"
                                                                method="post" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Ya,
                                                                    Hapus</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="modalEditPengeluaran{{ $item->id }}"
                                                tabindex="-1"
                                                aria-labelledby="modalEditPengeluaranLabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="{{ route('edit-pengeluaran', $item->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="modalEditPengeluaranLabel{{ $item->id }}">
                                                                    Edit Pengeluaran</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Tutup"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="tanggal_{{ $item->id }}"
                                                                        class="form-label">Tanggal</label>
                                                                    <input type="date"
                                                                        class="form-control @error('tanggal') is-invalid @enderror"
                                                                        name="tanggal"
                                                                        id="tanggal_{{ $item->id }}"
                                                                        value="{{ $item->tanggal }}" required>
                                                                    @error('tanggal')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="kategori_id_{{ $item->id }}"
                                                                        class="form-label">Nama Kategori</label>
                                                                    <select
                                                                        class="form-select @error('kategori_id') is-invalid @enderror"
                                                                        name="kategori_id"
                                                                        id="kategori_id_{{ $item->id }}" required>
                                                                        <option disabled>-- Pilih Kategori --</option>
                                                                        @foreach ($kategori as $itemKategori)
                                                                            <option value="{{ $itemKategori->id }}"
                                                                                {{ $itemKategori->id == $item->kategori_id ? 'selected' : '' }}>
                                                                                {{ $itemKategori->nama_kategori }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('kategori_id')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <div class="col-md-6">
                                                                        <label for="edit_jumlah_{{ $item->id }}"
                                                                            class="form-label">Jumlah</label>
                                                                        <input type="number"
                                                                            class="form-control @error('jumlah') is-invalid @enderror"
                                                                            name="jumlah"
                                                                            id="edit_jumlah_{{ $item->id }}"
                                                                            value="{{ $item->jumlah }}"
                                                                            oninput="formatRupiahEdit({{ $item->id }})"
                                                                            required>
                                                                        @error('jumlah')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="edit_rupiah_{{ $item->id }}"
                                                                            class="form-label">Jumlah (Rupiah)</label>
                                                                        <input type="text" class="form-control"
                                                                            id="edit_rupiah_{{ $item->id }}"
                                                                            value="Rp {{ number_format($item->jumlah, 0, ',', '.') }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="keterangan_{{ $item->id }}"
                                                                        class="form-label">Keterangan</label>
                                                                    <input type="text"
                                                                        class="form-control @error('keterangan') is-invalid @enderror"
                                                                        name="keterangan"
                                                                        id="keterangan_{{ $item->id }}"
                                                                        value="{{ $item->keterangan }}">
                                                                    @error('keterangan')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Pagination and Limit -->
                                <div class="d-flex flex-wrap justify-content-end align-items-center mt-3 pe-3">
                                    <!-- Limit Form -->
                                    <form method="GET" action="{{ request()->url() }}"
                                        class="d-flex align-items-center gap-2 mb-0 flex-wrap">
                                        <label for="limit" class="mb-0">Items per page:</label>
                                        <select name="limit" id="limit"
                                            class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                                            @foreach ([5, 10, 20, 50] as $option)
                                                <option value="{{ $option }}"
                                                    {{ request('limit', 10) == $option ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>

                                        {{-- Hidden inputs for start_date and end_date --}}
                                        @if (request('start_date'))
                                            <input type="hidden" name="start_date"
                                                value="{{ request('start_date') }}">
                                        @endif
                                        @if (request('end_date'))
                                            <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                                        @endif
                                    </form>

                                    <!-- Pagination -->
                                    <div class="me-3 ps-3 mt-2 mt-sm-0">
                                        {{ $pengeluaran->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero config table end -->
                <!-- Modal Tambah Pengeluaran -->
                <div class="modal fade" id="modalTambahPengeluaran" tabindex="-1"
                    aria-labelledby="modalTambahPengeluaranLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form action="{{ route('store-pengeluaran') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTambahPengeluaranLabel">Tambah Pengeluaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date"
                                            class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                                            id="tanggal" value="{{ date('Y-m-d') }}">
                                        @error('tanggal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori_id" class="form-label">Nama Kategori</label>
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
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="jumlah_{{ $item->id }}" class="form-label">Jumlah</label>
                                            <input type="number"
                                                class="form-control @error('jumlah') is-invalid @enderror"
                                                name="jumlah" id="jumlah_{{ $item->id }}"
                                                value="{{ $item->jumlah }}"
                                                oninput="formatRupiah({{ $item->id }})">
                                            @error('jumlah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="rupiah_{{ $item->id }}" class="form-label">Jumlah
                                                (Rupiah)</label>
                                            <input type="text" class="form-control"
                                                id="rupiah_{{ $item->id }}"
                                                value="Rp {{ number_format($item->jumlah, 0, ',', '.') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text"
                                            class="form-control @error('keterangan') is-invalid @enderror"
                                            name="keterangan" id="keterangan" value="{{ old('keterangan') }}">
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </section>
    @include('staticv2.footer')
    <!-- Required Js -->
    <script>
        function formatRupiah(id) {
            const jumlahInput = document.getElementById('jumlah_' + id);
            const rupiahDisplay = document.getElementById('rupiah_' + id);

            let value = parseInt(jumlahInput.value);
            if (isNaN(value)) value = 0;

            rupiahDisplay.value = 'Rp ' + value.toLocaleString('id-ID');
        }

        function formatRupiahEdit(id) {
            const jumlahInput = document.getElementById('edit_jumlah_' + id);
            const rupiahDisplay = document.getElementById('edit_rupiah_' + id);

            let value = parseInt(jumlahInput.value);
            if (isNaN(value)) value = 0;

            rupiahDisplay.value = 'Rp ' + value.toLocaleString('id-ID');
        }
    </script>
    @include('staticv2.js')
</body>
<!-- [Body] end -->

</html>
