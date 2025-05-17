<?php

namespace App\Http\Controllers;

use App\Models\KategoriPemasukan;
use Illuminate\Http\Request;

class KategoriPemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->limit ?? 10;
        $search = $request->search;
        $kategori = KategoriPemasukan::where('user_id', auth()->user()->id)->orderBy('id', 'desc');
        if ($search) {
            $kategori = $kategori->where('nama_kategori', 'like', '%' . $search . '%');
        }
        $kategori = $kategori->paginate($perPage)->appends($request->all());
        return view('kategori_pemasukan.index', compact('kategori'));
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
        KategoriPemasukan::create($data);
        return redirect()->back()->with('success', 'Berhasil Simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriPemasukan $kategoriPemasukan)
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
        $save = KategoriPemasukan::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Berhasil Edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriPemasukan $kategoriPemasukan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriPemasukan $kategoriPemasukan, $id)
    {
        $kategori = KategoriPemasukan::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil Hapus');
    }
}
