<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\KategoriPemasukan;
use App\Models\KategoriPengeluaran;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $start_date = $request['start_date'] ?? date('Y-m-01');;
        $end_date = $request['end_date'] ?? date('Y-m-d');
        $kategoriPengeluaranId = $request['kpg_id'];
        $kategoriPemasukanId = $request['kpm_id'];

        $pengeluaran = DB::table('pengeluarans as p')
            ->join('kategori_pengeluarans as k', 'k.id', '=', 'p.kategori_id')
            ->selectRaw('
                k.nama_kategori,
                sum( p.jumlah ) AS jumlah')
            ->where('p.deleted_at', null)
            ->whereBetween('p.tanggal', [$start_date, $end_date])
            ->groupBy('k.nama_kategori');
        $pengeluaran = $pengeluaran->orderBy('p.tanggal');

        $pemasukan = DB::table('pemasukans as p')
            ->join('kategori_pemasukans as k', 'k.id', '=', 'p.kategori_id')
            ->selectRaw('
                k.nama_kategori,
                sum( p.jumlah ) AS jumlah')
            ->where('p.deleted_at', null)
            ->whereBetween('p.tanggal', [$start_date, $end_date])
            ->groupBy('k.nama_kategori');
        $pemasukan = $pemasukan->orderBy('p.tanggal');

        if ($kategoriPengeluaranId) {
            $pengeluaran = $pengeluaran->where('k.id', '=', $kategoriPengeluaranId);
        }

        if ($kategoriPemasukanId) {
            $pemasukan = $pemasukan->where('k.id', '=', $kategoriPemasukanId);
        }

        $pengeluaran = $pengeluaran->get();
        $pemasukan = $pemasukan->get();

        $labels = $pengeluaran->pluck('nama_kategori');
        $values = $pengeluaran->pluck('jumlah');

        $labelspemasukan = $pemasukan->pluck('nama_kategori');
        $valuespemasukan = $pemasukan->pluck('jumlah');

        $kategoriPengeluaran = KategoriPengeluaran::get();
        $kategoriPemasukan = KategoriPemasukan::get();
        return view('indexv2', compact(
            'pengeluaran',
            'labels',
            'values',
            'pemasukan',
            'labelspemasukan',
            'valuespemasukan',
            'kategoriPengeluaran',
            'kategoriPemasukan'
        ));
    }

    /**
     * Display a listing of the resource.
     */
    public function chart(Request $request)
    {
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
        $data = DB::table('pengeluarans as p')
            ->join('kategori_pengeluarans as k', 'k.id', '=', 'p.kategori_id')
            ->selectRaw('
                k.nama_kategori,
                sum( p.jumlah ) AS jumlah')
            ->groupBy('k.nama_kategori');
        if (isset($request['start']) && isset($request['enddate'])) {
            $data = $data->whereBetween('p.tanggal', [$start_date, $end_date]);
        }
        $data = $data->orderBy('p.tanggal');
        $data = $data->get();
        return view('index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
