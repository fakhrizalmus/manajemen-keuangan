<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pengeluaran</title>
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
                    <h1 class="mt-4">Pengeluaran</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Pengeluaran</li>
                    </ol>
                    <a href="{{ route('add-pengeluaran') }}">
                        <button type="button" class="btn btn-primary mb-4">Tambah</button>
                    </a>
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
                                            {{-- <td>
                                                <form action="{{ route('delete-kategori', $item->id) }}" method="post"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin akan hapus data anda?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" style="margin-bottom: 5px;"><i
                                                            class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @include('static.js')
</body>

</html>
