<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukFormRequest;
use App\Models\GambarProduk;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\SubKategori;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::orderBy('id', 'DESC')->simplePaginate(10);
        return view('admin.produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $suppliers = Supplier::all();
        return view('admin.produk.create', compact('kategoris', 'suppliers'));
    }

    public function getSubcategories($kategori)
    {
        $subcategories = SubKategori::where('id_kategori', $kategori)->get();
        return response()->json($subcategories);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdukFormRequest $request)
    {
        $validatedData = $request->validated();
        $request->validate(Produk::rules());
        // dd($validatedData);
        $subKategori = SubKategori::findOrFail($validatedData['id_sub_kategori']);
        $produk = $subKategori->produk()->create([
            'name' =>$validatedData['name'],
            'slug' =>$validatedData['slug'],
            'id_sub_kategori' =>$validatedData['id_sub_kategori'],
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
        $id_supplier = $request->input('id_supplier');
        $produk->suppliers()->sync($id_supplier);

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
        $kategoris = Kategori::all();
        $subKategoris = SubKategori::all();
        $suppliers = Supplier::all();
        $selectedSupplier = $produk->suppliers->pluck('id')->toArray();
        // dd($selectedSupplier);
        return view('admin.produk.edit', compact('produk', 'kategoris','suppliers', 'selectedSupplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdukFormRequest $request, $id)
    {
        $validatedData = $request->validated();
        $produk = SubKategori::findOrFail($validatedData['id_sub_kategori'])->produk()->where('id', $id)->first();
        if ($produk) {
            $produk->update([
                'name' =>$validatedData['name'],
                'slug' =>$validatedData['slug'],
                'id_sub_kategori' =>$validatedData['id_sub_kategori'],
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
            $produk->suppliers()->sync($request->input('id_supplier'));
            
            return redirect('admin/produk')->with('message', 'Produk berhasil diupdate');
        } else {
            return redirect()->with('message', 'Kategori tidak tersedia');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
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
