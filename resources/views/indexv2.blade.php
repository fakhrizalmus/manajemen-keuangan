<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Home</title>
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
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            @php
                $totalPengeluaran = 0;
                $totalPemasukan = 0;
            @endphp
            @foreach ($pemasukan as $item)
                @php
                    $totalPemasukan += $item->jumlah;
                @endphp
            @endforeach
            @foreach ($pengeluaran as $item)
                @php
                    $totalPengeluaran += $item->jumlah;
                @endphp
            @endforeach
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Home</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Home</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-12">
                    <form method="GET" action="{{ route('home') }}">
                        {{-- Group date filters --}}
                        <div class="d-flex flex-wrap flex-md-nowrap align-items-stretch mb-3 gap-2">
                            <div class="flex-fill">
                                <input type="date"
                                    class="form-control border border-black rounded-4 ps-3 @error('start_date') is-invalid @enderror"
                                    name="start_date" id="start_date"
                                    value="{{ request('start_date') ?? date('Y-m-01') }}">
                                @error('start_date')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="flex-fill">
                                <input type="date"
                                    class="form-control border border-black rounded-4 ps-3 @error('end_date') is-invalid @enderror"
                                    name="end_date" id="end_date" value="{{ request('end_date') ?? date('Y-m-d') }}">
                                @error('end_date')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="flex-fill">
                                <select class="form-select border border-black rounded-4" name="kpg_id" id="kpg_id">
                                    <option value="" {{ request('kpg_id') ? '' : 'selected' }}>
                                        Kategori Pengeluaran</option>
                                    @foreach ($kategoriPengeluaran as $item)
                                        <option value="{{ $item->id }}"
                                            {{ request('kpg_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex-fill">
                                <select class="form-select border border-black rounded-4" name="kpm_id" id="kpm_id">
                                    <option value="" {{ request('kpm_id') ? '' : 'selected' }}>
                                        Kategori Pemasukan</option>
                                    @foreach ($kategoriPemasukan as $item)
                                        <option value="{{ $item->id }}"
                                            {{ request('kpm_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Search button --}}
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary py-2 px-4 rounded-4">
                                    <i class="ti ti-search"></i> Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted d-flex align-items-center">
                                <i class="ti ti-arrow-narrow-up text-danger fs-3 me-2"></i>
                                Total Pengeluaran
                            </h6>
                            <h4 class="mb-3 text-danger">{{ 'Rp ' . number_format($totalPengeluaran, 0, ',', '.') }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted d-flex align-items-center">
                                <i class="ti ti-arrow-narrow-up text-success fs-3 me-2"></i>
                                Total Pemasukan
                            </h6>
                            <h4 class="mb-3 text-success">{{ 'Rp ' . number_format($totalPemasukan, 0, ',', '.') }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted d-flex align-items-center">
                                Selisih
                            </h6>
                            <h4 class="mb-3">
                                {{ 'Rp ' . number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card-header">
                        <h5>Pengeluaran</h5>
                    </div>
                    @if (count($pengeluaran) > 0)
                        <div class="card">
                            <div class="card-body">
                                <div id="pie-chart-1" style="width: 100%"></div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <div class="card-header">
                        <h5>Pemasukan</h5>
                    </div>
                    @if (count($pemasukan) > 0)
                        <div class="card">
                            <div class="card-body">
                                <div id="pie-chart-2" style="width: 100%"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-body d-flex justify-content-center">
                            <div id="radialBar-chart-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
    @include('staticv2.footer')

    @include('staticv2.js')
    <script>
        window.chartData = {
            labels: @json($labels),
            values: @json($values),
            labelspemasukan: @json($labelspemasukan),
            valuespemasukan: @json($valuespemasukan)
        };
    </script>
</body>
<!-- [Body] end -->

</html>
