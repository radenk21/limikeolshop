<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Jenis;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\SubKategori;
use App\Models\GambarProduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProdukFormRequest;
use App\Http\Requests\IsiProdukFormRequest;

// use App\Http\Requests\ProdukFormRequest;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::orderBy('id', 'DESC')->simplePaginate(10);
        $offset = request()->get('page', 1) * $produks->perPage() - $produks->perPage();
        
        return view('admin.produk.index', compact('produks', 'offset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $suppliers = Supplier::all();
        $brands = Brand::all();
        $jeniss = Jenis::all();
        return view('admin.produk.create', compact('kategoris', 'brands','suppliers', 'jeniss'));
    }

    public function getSubcategories($kategori)
    {
        $subcategories = SubKategori::where('id_kategori', $kategori)->get();
        return response()->json($subcategories);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(IsiProdukFormRequest $request)
    {
        // dd($request->all());
        $validatedData = $request->validated();
        $request->validate(Produk::rules());
        $subKategori = SubKategori::findOrFail($validatedData['id_sub_kategori']);
        $produk = $subKategori->produk()->create([
            'name' =>$validatedData['name'],
            'slug' =>$validatedData['slug'],
            'deskripsi' =>$validatedData['deskripsi'],
            'id_kategori' =>$validatedData['id_kategori'],
            'id_sub_kategori' =>$validatedData['id_sub_kategori'],
            'id_brand' =>$validatedData['id_brand'],
            'harga_beli' =>$validatedData['harga_beli'],
            'harga_jual' =>$validatedData['harga_jual'],
            'trending' =>$request->trending == true ? '1':'0',
            'status' =>$request->status == true ? '1':'0',
            'jumlah' =>$validatedData['jumlah'],
        ]);
        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/produk/';
            foreach ($request->file('image') as $imageFile) {

                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().'-'.uniqid().'.'. $extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath.$filename;
                
                GambarProduk::create([
                    'id_produk' => $produk->id,
                    'image' => $finalImagePathName
                ]);
            }
        }

        if ($request->jeniss) {
            // dd('ada kok');
            foreach ($request->jeniss as $key => $jenis) {
                $produk->produkJenis()->create([
                    'id_produk' => $produk->id,
                    'id_jenis' => $jenis,
                    'jumlah' => $request->jumlah_jenis[$key] ?? 0,
                ]);
            }
        }
        
        $id_supplier = $request->input('id_supplier');
        $produk->suppliers()->sync($id_supplier);
        // $produk->produkSuppliers()->create([
        //     'id_supplier' => $request->id_supplier,
        //     'id_produk' => $produk->id,
        // ]);
        
        return redirect('admin/produk')->with('message', 'Produk berhasil ditambahkan');
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
    public function edit(Produk $produk)
    {
        $brands = Brand::all();
        $kategoris = Kategori::all();
        $subKategoris = SubKategori::all();
        $suppliers = Supplier::all();
        $selectedSupplier = $produk->suppliers->pluck('id')->toArray();
        $jenisProduk = $produk->produkJenis->pluck('id_jenis')->toArray();
        $jeniss = Jenis::whereNotIn('id', $jenisProduk)->get();
        // dd($selectedSupplier);
        return view('admin.produk.edit', compact('produk', 'kategoris', 'suppliers', 'brands','selectedSupplier', 'jeniss', 'jenisProduk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IsiProdukFormRequest $request, $id)
    {
        // dd('ini update produkcontroller');

        $validatedData = $request->validated();
        $produk = SubKategori::findOrFail($validatedData['id_sub_kategori'])->produk()->where('id', $id)->first();
        if ($produk) {
            $produk->update([
                'name' =>$validatedData['name'],
                'slug' =>$validatedData['slug'],
                'deskripsi' =>$validatedData['deskripsi'],
                'id_kategori' =>$validatedData['id_kategori'],
                'id_sub_kategori' =>$validatedData['id_sub_kategori'],
                'id_brand' =>$validatedData['id_brand'],
                'harga_beli' =>$validatedData['harga_beli'],
                'harga_jual' =>$validatedData['harga_jual'],
                'trending' =>$request->trending == true ? '1':'0',
                'status' =>$request->status == true ? '1':'0',
                'jumlah' =>$validatedData['jumlah'],
            ]);
            if ($request->hasFile('image')) {
                $uploadPath = 'uploads/produk/';
                foreach ($request->file('image') as $imageFile) {
    
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = time().'-'.uniqid().'.'. $extension;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathName = $uploadPath.$filename;
                    
                    GambarProduk::create([
                        'id_produk' => $produk->id,
                        'image' => $finalImagePathName
                    ]);
                }
            }

            if ($request->jeniss) {
                // dd('ada kok');
                foreach ($request->jeniss as $key => $jenis) {
                    $produk->produkJenis()->create([
                        'id_produk' => $produk->id,
                        'id_jenis' => $jenis,
                        'jumlah' => $request->jumlah_jenis[$key] ?? 0,
                    ]);
                }
            }
            
            $produk->suppliers()->sync($request->input('id_supplier'));
            
            return redirect('admin/produk')->with('message', 'Produk berhasil diupdate');
        } else {
            return redirect()->with('message', 'Kategori tidak tersedia');
        }
    }

    public function produkJenisUpdate(Request $request, $produk_jenis_id)
    {
        dd($produk_jenis_id);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd('ini produkcontroller');
        $produk = Produk::findOrFail($id);
        if ($produk->gambarProduk()) {
            foreach ($produk->gambarProduk as $gambarProduk) {
                if(File::exists($gambarProduk->image)){
                    File::delete($gambarProduk->image);
                }
            }
        }
        $produk->delete();
        return back()->with('message', 'Produk telah dihapus');
    }
    
    public function destroyGambar($id)
    {
        $gambarProduk = GambarProduk::findOrFail($id);
        if(File::exists($gambarProduk->image)){
            File::delete($gambarProduk->image);
        }
        $gambarProduk->delete();
        return back()->with('message', 'Gambar produk telah dihapus');
    }
}
