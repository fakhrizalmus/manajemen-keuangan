<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pengeluaran</title>
    @include('static.css')
</head>

<body>
    @include('static.navbar')
    <div id="layoutSidenav">
        @include('static.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Pengeluaran</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Pengeluaran</li>
                    </ol>
                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal"
                        data-bs-target="#modalTambahPengeluaran">
                        Tambah
                    </button>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Laporan
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kategori</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 0;
                                    @endphp
                                    @foreach ($pengeluaran as $item)
                                        @php
                                            $no++;
                                        @endphp
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $item->kategoris->nama_kategori }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ 'Rp' . number_format($item->jumlah, 0, ',', '.') }}</td>
                                            <td>{{ $item->keterangan == null ? '-' : $item->keterangan }}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal{{ $item->id }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <button type="button" class="btn btn-success btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditPengeluaran{{ $item->id }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
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
                                                        <h5 class="modal-title" id="modalLabel{{ $item->id }}">
                                                            Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <i
                                                            class="fa-solid fa-triangle-exclamation fa-3x text-warning mb-3"></i>
                                                        <p>Yakin ingin menghapus data ini?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <form action="{{ route('delete-pengeluaran', $item->id) }}"
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
                                        <!-- Modal Edit Pengeluaran -->
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
                                                                id="modalEditPengeluaranLabel{{ $item->id }}">Edit
                                                                Pengeluaran</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="tanggal" class="form-label">Tanggal</label>
                                                                <input type="date"
                                                                    class="form-control @error('tanggal') is-invalid @enderror"
                                                                    name="tanggal" id="tanggal"
                                                                    value="{{ $item->tanggal }}">
                                                                @error('tanggal')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="kategori_id" class="form-label">Nama
                                                                    Kategori</label>
                                                                <select
                                                                    class="form-select @error('kategori_id') is-invalid @enderror"
                                                                    name="kategori_id" id="kategori_id">
                                                                    <option selected disabled>-- Pilih Kategori --
                                                                    </option>
                                                                    @foreach ($kategori as $itemKategori)
                                                                        <option value="{{ $itemKategori->id }}"
                                                                            {{ $itemKategori->id == $item->kategori_id ? 'selected' : '' }}>
                                                                            {{ $itemKategori->nama_kategori }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('kategori_id')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-md-6">
                                                                    <label for="jumlah"
                                                                        class="form-label">Jumlah</label>
                                                                    <input type="number"
                                                                        class="form-control @error('jumlah') is-invalid @enderror"
                                                                        name="jumlah" id="jumlah"
                                                                        value="{{ $item->jumlah }}">
                                                                    @error('jumlah')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="rupiah" class="form-label">Jumlah
                                                                        (Rupiah)</label>
                                                                    <input type="text" class="form-control"
                                                                        id="rupiah" value="Rp 0" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="keterangan"
                                                                    class="form-label">Keterangan</label>
                                                                <input type="text"
                                                                    class="form-control @error('keterangan') is-invalid @enderror"
                                                                    name="keterangan" id="keterangan"
                                                                    value="{{ $item->keterangan }}">
                                                                @error('keterangan')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit"
                                                                class="btn btn-success">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        function formatRupiah(id) {
            const jumlahInput = document.getElementById('jumlah_' + id);
            const rupiahDisplay = document.getElementById('rupiah_' + id);

            let value = parseInt(jumlahInput.value);
            if (isNaN(value)) value = 0;

            rupiahDisplay.value = 'Rp ' + value.toLocaleString('id-ID');
        }
    </script>
    @include('static.js')
</body>

</html>
