<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\KategoriPengeluaran;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
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
        $kategori = KategoriPengeluaran::where('user_id', auth()->user()->id)->get();
        $pengeluaran = Pengeluaran::with('kategoris')->where('user_id', auth()->user()->id)
            ->whereBetween('tanggal', [$start_date, $end_date]);
        if ($search) {
            $pengeluaran = $pengeluaran->where('keterangan', 'like', '%' . $search . '%');
        }
        if ($kategoriId) {
            $pengeluaran = $pengeluaran->where('kategori_id', '=', $kategoriId);
        }
        $pengeluaran = $pengeluaran->orderBy('tanggal', 'DESC')->paginate($perPage)->appends($request->all());
        return view('pengeluaran.indexv2-new', compact('pengeluaran', 'kategori'));
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
        $save = Pengeluaran::create($data);
        return redirect()->back()->with('success', 'Berhasil Simpan');
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
    public function edit($id, Request $request)
    {
        $pengeluaran = Pengeluaran::find($id)->first();
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
        $save = Pengeluaran::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Berhasil Edit');
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
    public function destroy(Pengeluaran $pengeluaran, $id)
    {
        Pengeluaran::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil Hapus');
    }
}
