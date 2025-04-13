<?php

namespace App\Http\Controllers;

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
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
        $data = DB::table('pengeluarans as p')
            ->join('kategoris as k', 'k.id', '=', 'p.kategori_id')
            ->selectRaw('
                k.nama_kategori,
                p.tanggal,
                sum( p.jumlah ) AS jumlah')
            ->groupBy('k.nama_kategori', 'p.tanggal');
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
