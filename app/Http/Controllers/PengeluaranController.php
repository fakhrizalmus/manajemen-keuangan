<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengeluaran = Pengeluaran::with('kategoris')->orderBy('id', 'DESC')->get();
        return view('pengeluaran.index', compact('pengeluaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::get();
        return view('pengeluaran.add-pengeluaran', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'kategori_id'   => ['required'],
            'jumlah'        => ['required'],
            'tanggal'       => ['required']
        ]);
        $data = [
            'kategori_id'   => $validatedData['kategori_id'],
            'jumlah'        => $validatedData['jumlah'],
            'tanggal'       => $validatedData['tanggal'],
            'keterangan'    => $request['keterangan']
        ];
        $save = Pengeluaran::create($data);
        return redirect('/pengeluaran')->with('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        //
    }
}
