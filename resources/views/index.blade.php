<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    @include('static.css')
</head>

<body class="sb-nav-fixed">
    @include('static.navbar')
    <div id="layoutSidenav">
        @include('static.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                        <div>
                            <h1 class="mb-0">Dashboard</h1>
                            <small class="text-muted">Ringkasan data pengeluaran</small>
                        </div>
                        <div>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($chart as $item)
                                @php
                                    $total += $item->jumlah;
                                @endphp
                            @endforeach
                            <div class="card text-white bg-success shadow-sm">
                                <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <small>Total Pengeluaran</small>
                                        <h5 class="mb-0">{{ 'Rp' . number_format($total, 0, ',', '.') }}</h5>
                                    </div>
                                    <i class="fas fa-wallet fa-2x opacity-75 ms-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="GET" action="{{ route('home') }}">
                        <div class="row g-3 align-items-end mb-4">
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                    name="start_date" id="start_date"
                                    value="{{ request('start_date') ?? date('Y-m-01') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="end_date" class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                    name="end_date" id="end_date" value="{{ request('end_date') ?? date('Y-m-d') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="90%" height="40"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    Pie Chart
                                </div>
                                <div class="card-body"><canvas id="myPieChart" width="90%" height="30"></canvas>
                                </div>
                                <div class="card-footer small text-muted">Updated
                                    {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d F Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Laporan
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama_kategori }}</td>
                                            <td>{{ date($item->tanggal, strtotime('d F Y')) }}</td>
                                            <td>{{ 'Rp' . number_format($item->jumlah, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website {{ date('Y') }}</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script>
        window.chartData = {
            labels: @json($labels),
            values: @json($values)
        };
    </script>
    @include('static.js')
</body>

</html>
