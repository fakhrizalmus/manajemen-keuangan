<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\KategoriPengeluaran;
use Illuminate\Http\Request;

class KategoriPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->limit ?? 10;
        $search = $request->search;
        $kategori = KategoriPengeluaran::where('user_id', auth()->user()->id)->orderBy('id', 'desc');
        if ($search) {
            $kategori = $kategori->where('nama_kategori', 'like', '%' . $search . '%');
        }
        $kategori = $kategori->paginate($perPage)->appends($request->all());
        return view('kategori_pengeluaran.indexv2-new', compact('kategori'));
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
        $validatedData = $this->validate($request, [
            'nama_kategori' => ['required']
        ]);
        $data = [
            'nama_kategori' => $validatedData['nama_kategori'],
            'user_id' => auth()->user()->id
        ];
        KategoriPengeluaran::create($data);
        return redirect()->back()->with('success', 'Berhasil Simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriPengeluaran $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $validatedData = $this->validate($request, [
            'nama_kategori' => ['required']
        ]);
        $data = [
            'nama_kategori' => $validatedData['nama_kategori']
        ];
        $save = KategoriPengeluaran::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Berhasil Edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriPengeluaran $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriPengeluaran $kategori, $id)
    {
        $kategori = KategoriPengeluaran::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil Hapus');
    }
}
