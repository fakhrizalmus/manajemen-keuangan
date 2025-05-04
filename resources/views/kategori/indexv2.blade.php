<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="adminv2/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="adminv2/assets/img/favicon.png">
    <title>
        Master Kategori
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
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div
                                class="bg-gradient-dark shadow-dark border-radius-lg d-flex justify-content-between align-items-center px-3 py-3">
                                <h6 class="text-white text-capitalize m-0">Daftar Kategori</h6>
                                <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                    data-bs-target="#modalAddKategori">
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
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 0;
                                        @endphp
                                        @for ($i = 0; $i < count($kategori); $i++)
                                            @php
                                                $no++;
                                            @endphp
                                            <tr>
                                                <td style="text-align: center">
                                                    {{ $no }}
                                                </td>
                                                <td>{{ $kategori[$i]->nama_kategori }}</td>
                                                <td style="text-align: center">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmDeleteModal{{ $kategori[$i]->id }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEditKategori{{ $kategori[$i]->id }}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Modal Konfirmasi Delete -->
                                            <div class="modal fade" id="confirmDeleteModal{{ $kategori[$i]->id }}"
                                                tabindex="-1" aria-labelledby="modalLabel{{ $kategori[$i]->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow">
                                                        <div class="modal-header bg-gradient-dark">
                                                            <h5 class="modal-title"
                                                                id="modalLabel{{ $kategori[$i]->id }}"
                                                                style="color: white">
                                                                Konfirmasi Hapus
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <i
                                                                class="fa-solid fa-triangle-exclamation fa-3x text-warning mb-3"></i>
                                                            <p>Yakin ingin menghapus data
                                                                <strong>{{ $kategori[$i]->nama_kategori }}</strong>?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <form
                                                                action="{{ route('delete-kategori', $kategori[$i]->id) }}"
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
                                            <div class="modal fade" id="modalEditKategori{{ $kategori[$i]->id }}"
                                                tabindex="-1"
                                                aria-labelledby="modalEditKategoriLabel{{ $kategori[$i]->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow">
                                                        <div class="modal-header bg-gradient-dark">
                                                            <h5 class="modal-title text-white"
                                                                id="modalEditKategoriLabel{{ $kategori[$i]->id }}">Edit
                                                                Kategori</h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('edit-kategori', $kategori[$i]->id) }}"
                                                            method="POST" role="form" class="text-start">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div
                                                                    class="input-group input-group-outline my-3 {{ $kategori[$i]->nama_kategori ? 'is-filled' : '' }}">
                                                                    <label class="form-label">Nama Kategori</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nama_kategori"
                                                                        value="{{ $kategori[$i]->nama_kategori }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-center">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn bg-gradient-dark text-white">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Tambah Kategori -->
        <div class="modal fade" id="modalAddKategori" tabindex="-1" aria-labelledby="modalAddKategoriLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-gradient-dark">
                        <h5 class="modal-title text-white" id="modalAddKategoriLabel">Tambah Kategori</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('store-kategori') }}" method="POST" role="form" class="text-start">
                        @csrf
                        <div class="modal-body">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" name="nama_kategori" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn bg-gradient-dark text-white">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('staticv2.footer')
    </main>
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
