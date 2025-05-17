<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\KategoriPemasukan;
use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->limit ?? 10;
        $start_date = $request['start_date'] ?? date('Y-m-01');
        $end_date = $request['end_date'] ?? date('Y-m-d');
        $search = $request->search;
        $kategoriId = $request->kategori_id;
        $kategori = KategoriPemasukan::where('user_id', auth()->user()->id)->get();
        $pemasukan = Pemasukan::with('kategoris')->where('user_id', auth()->user()->id)
            ->whereBetween('tanggal', [$start_date, $end_date]);
        if ($search) {
            $pemasukan = $pemasukan->where('keterangan', 'like', '%' . $search . '%');
        }
        if ($kategoriId) {
            $pemasukan = $pemasukan->where('kategori_id', '=', $kategoriId);
        }
        $pemasukan = $pemasukan->orderBy('tanggal', 'DESC')->paginate($perPage)->appends($request->all());
        return view('pemasukan.index', compact('pemasukan', 'kategori'));
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
            'kategori_id'   => ['required'],
            'jumlah'        => ['required'],
            'tanggal'       => ['required']
        ]);
        $data = [
            'kategori_id'   => $validatedData['kategori_id'],
            'jumlah'        => $validatedData['jumlah'],
            'tanggal'       => $validatedData['tanggal'],
            'keterangan'    => $request['keterangan'],
            'user_id'       => auth()->user()->id
        ];
        $save = Pemasukan::create($data);
        return redirect()->back()->with('success', 'Berhasil Simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $pemasukan = Pemasukan::find($id)->first();
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
        $save = Pemasukan::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Berhasil Edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemasukan $pemasukan, $id)
    {
        Pemasukan::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil Hapus');
    }
}
