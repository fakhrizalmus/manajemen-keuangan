<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kategori</title>
    @include('static.css')
</head>

<body>
    @include('static.navbar')
    <div id="layoutSidenav">
        @include('static.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Kategori</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Kategori</li>
                    </ol>
                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal"
                        data-bs-target="#modalTambahKategori">
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 0;
                                    @endphp
                                    @foreach ($kategori as $item)
                                        @php
                                            $no++;
                                        @endphp
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $item->nama_kategori }}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal{{ $item->id }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <button type="button" class="btn btn-success btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditKategori{{ $item->id }}">
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
                                                        <p>Yakin ingin menghapus data {{ $item->nama_kategori }}?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <form action="{{ route('delete-kategori', $item->id) }}"
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
                                        <div class="modal fade" id="modalEditKategori{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="modalEditKategoriLabel{{ $item->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('edit-kategori', $item->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="modalEditKategoriLabel{{ $item->id }}">Edit
                                                                Kategori</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="nama_kategori" class="form-label">Nama
                                                                    Kategori</label>
                                                                <input type="text"
                                                                    class="form-control @error('nama_kategori') is-invalid @enderror"
                                                                    id="nama_kategori" name="nama_kategori"
                                                                    value="{{ $item->nama_kategori }}">
                                                                @error('nama_kategori')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
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

                <!-- Modal -->
                <div class="modal fade" id="modalTambahKategori" tabindex="-1"
                    aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('store-kategori') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTambahKategoriLabel">Tambah Kategori</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                        <input type="text"
                                            class="form-control @error('nama_kategori') is-invalid @enderror"
                                            id="nama_kategori" name="nama_kategori"
                                            value="{{ old('nama_kategori') }}">
                                        @error('nama_kategori')
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
    @include('static.js')
</body>

</html>
