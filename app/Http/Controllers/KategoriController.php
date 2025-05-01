<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('kategori.index', compact('kategori'));
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
        Kategori::create($data);
        return redirect('/kategori')->with('success', 'Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
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
        $save = Kategori::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Berhasil edit!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori, $id)
    {
        $kategori = Kategori::find($id)->delete();
        return redirect('/kategori')->with('success', 'Berhasil Hapus');
    }
}
