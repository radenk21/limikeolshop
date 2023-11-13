<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukJenis;
use Illuminate\Http\Request;

class ProdukJenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $produk)
    {
        dd($request->all());
        if ($request->jeniss) {
            // dd('ada kok');
            foreach ($request->jeniss as $key => $jenis) {
                ProdukJenis::create([
                    'id_produk' => $produk->id,
                    'id_jenis' => $jenis,
                    'jumlah' => $request->jumlah_jenis[$key] ?? 0,
                ]);
            }
        }
        // foreach ($request->jeniss as $key => $jenis) {
        //     ProdukJenis::create([
        //         'id_produk' => $produk->id,
        //         'id_jenis' => $jenis,
        //         'jumlah' => $request->jumlah_jenis[$key] ?? 0,
        //     ]);
        // }
        
    }

    public function storeProdukJenis(Request $request, $produk)
    {
        if ($request->jeniss) {
            // dd('ada kok');
            foreach ($request->jeniss as $key => $jenis) {
                ProdukJenis::create([
                    'id_produk' => $produk,
                    'id_jenis' => $jenis,
                    'jumlah' => $request->jumlah_jenis[$key] ?? 0,
                ]);
            }
        }
        return back()->with('message', 'Jenis produk telah diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataProdukJenis = ProdukJenis::findOrFail($id);
        foreach ($request->jumlah_jenis as $key => $jumlah) {
            $dataProdukJenis->update([
                'jumlah' => $request->jumlah_jenis[$key] ?? 0,
            ]);
        }

        return back()->with('message', 'Jumlah jenis produk telah diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produkJenis = ProdukJenis::findOrFail($id);
        // dd($produkJenis);
        $produkJenis->delete();
        return back()->with('message', 'Jenis dalam produk ini telah dihapus');
    }
}
