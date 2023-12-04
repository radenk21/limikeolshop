<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PemesananProduk;
use App\Models\Produk;
use App\Models\ProdukSupplier;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class PemesananProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pemesananProduks = PemesananProduk::
        when($request->awalDate != null && $request->akhirDate != null, function($q) use ($request) {
            return $q->whereBetween('created_at', [$request->awalDate, $request->akhirDate]);
        })
        ->when($request->status != null, function($q) use ($request) {
            return $q->where('status', $request->status);
        })
        // ->whereNot('status', 'sudah restock')
        ->orderBy('updated_at', 'desc')->get();
        $offset = 0;
        // $offset = request()->get('page', 1) * $pemesananProduks->perPage() - $pemesananProduks->perPage();
        // $pemesananProduks = PemesananProduk::whereNot('status', 'sudah restock')->paginate(10);

        return view('admin.pemesanan_produk.index', compact('pemesananProduks', 'offset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {

    }

    public function tambahPesan($id)
    {
        $produk = Produk::findOrFail($id);
        // dd($produk->jumlah);
        $supplier = ProdukSupplier::where('id_produk', $id)->first();
        // dd($supplier);
        $pemesananProduk = PemesananProduk::create([
            'id_produk' => $produk->id, 
            'id_supplier' => $supplier->id_supplier, 
            'status' => 'belum di pesan', 
            'jumlah_stok_sekarang' => $produk->jumlah, 
        ]);

        // dd($pemesananProduk);

        return redirect()->back();
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pemesananProduk = PemesananProduk::where('id', $id)->first();
        return view('admin.pemesanan_produk.edit', compact('pemesananProduk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pemesananProduk = PemesananProduk::findOrFail($id);
        
        $request->validate([
            'jumlah_beli_stok' => 'required|integer|min:1',
            'hidden_total_harga_pesan' => 'required|integer|min:1',
        ]);
        
        // dd($request->validated());
        // Update data pada model PemesananProduk
        $pemesananProduk->update([
            'jumlah_beli_stok' => $request->input('jumlah_beli_stok'),
            'total_harga_pesan' => $request->input('hidden_total_harga_pesan'),
            'status' => 'telah di pesan',
        ]);
        
        // Redirect atau tampilkan pesan sukses
        return redirect()->back()->with('message', 'Data Pemesanan Produk berhasil diupdate!');
    }

    public function verifikasiStok(string $id)
    {
        $pemesananProduk = PemesananProduk::findOrFail($id);
        $pemesananProduk->update([
            'status' => 'sudah restock'
        ]);

        return redirect()->back()->with('message', 'Pemesanan Produk Telah Berhasil Di Verifikasi!');
    }

    public function batalPemesanan(string $id)
    {
        $pemesananProduk = PemesananProduk::findOrFail($id);
        $pemesananProduk->update([
            'status' => 'batal'
        ]);

        return redirect()->back()->with('message', 'Pemesanan Produk Telah Berhasil Di Batalkan');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PemesananProduk::findOrFail($id)->delete();
        return redirect()->back();
    }
}
