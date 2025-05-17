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
                                <li class="breadcrumb-item" aria-current="page">Kategori Pemasukan</li>
                            </ul>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="page-header-title">
                                        <h2 class="mb-0">Master Kategori Pemasukan</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="GET" action="{{ route('kategori_pemasukans') }}">
                            <div class="row g-3 align-items-stretch">
                                <div class="col-12 col-md-2">
                                    <input type="text" class="form-control border border-black rounded-4 ps-3"
                                        name="search" id="search" placeholder="Cari kategori"
                                        value="{{ request('search') }}">
                                </div>

                                <div class="col-6 col-md-1">
                                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-4">
                                        <i class="ti ti-search"></i>
                                    </button>
                                </div>

                                <div class="col-6 col-md-1">
                                    <button type="button" class="btn btn-primary w-100 py-2 rounded-4"
                                        data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
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
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategori as $index => $item)
                                            <tr>
                                                <td style="width: 10px">
                                                    {{ ($kategori->currentPage() - 1) * $kategori->perPage() + $index + 1 }}
                                                </td>
                                                <td style="width: 140px">{{ $item->nama_kategori }}</td>
                                                <td style="width: 10px; text-align: center">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmDeleteModal{{ $item->id }}">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEditKategori{{ $item->id }}">
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
                                                            <h5 class="modal-title" id="modalLabel{{ $item->id }}"
                                                                style="color: white">
                                                                Konfirmasi Hapus</h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <i
                                                                class="fa-solid fa-triangle-exclamation fa-3x text-warning mb-3"></i>
                                                            <p>Yakin ingin menghapus data
                                                                {{ $item->nama_kategori }}?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <form
                                                                action="{{ route('delete-kategori_pemasukan', $item->id) }}"
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
                                            <div class="modal fade" id="modalEditKategori{{ $item->id }}"
                                                tabindex="-1"
                                                aria-labelledby="modalEditKategoriLabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('edit-kategori_pemasukan', $item->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="modalEditKategoriLabel{{ $item->id }}">
                                                                    Edit
                                                                    Kategori</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Tutup"></button>
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
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save
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
                                        {{ $kategori->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero config table end -->
                <!-- Modal -->
                <div class="modal fade" id="modalTambahKategori" tabindex="-1"
                    aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('store-kategori_pemasukan') }}" method="POST">
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
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
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
    @include('staticv2.js')
    <!-- [Page Specific JS] end -->
</body>
<!-- [Body] end -->

</html>
