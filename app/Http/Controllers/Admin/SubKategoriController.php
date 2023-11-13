<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubKategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SubKategoriFormRequest;
use App\Models\Kategori;

class SubKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subKategoris = SubKategori::orderBy('id', 'DESC')->simplePaginate(10);
        return view('admin.subkategori.index', compact('subKategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.subkategori.create', compact('kategoris'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubKategoriFormRequest $request)
    {
        $validatedData = $request->validated();
        $subKategori = new SubKategori();
        $subKategori->name = $validatedData['name'];
        $subKategori->id_kategori = $validatedData['id_kategori'];
        $subKategori->slug = Str::slug($validatedData['slug']);
        $subKategori->description = $validatedData['description'];
        $subKategori->status = $request->status == true ? '1' : '0';
        $subKategori->save();
        session()->flash('message', 'Sub Kategori telah ditambahkan');
        // dd('asdfasdf');
        return redirect('admin/sub-kategori');
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
    public function edit(SubKategori $subKategori)
    {
        $kategoris = Kategori::all();
        return view('admin.subkategori.edit', compact('subKategori', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubKategoriFormRequest $request, $id)
    {
        $validatedData = $request->validated();
        $subKategori = SubKategori::findOrFail($id);
        $subKategori->name = $validatedData['name'];
        $subKategori->id_kategori = $validatedData['id_kategori'];
        $subKategori->slug = Str::slug($validatedData['slug']);
        $subKategori->description = $validatedData['description'];
        $subKategori->status = $request->status == true ? '1' : '0';
        $subKategori->update();
        session()->flash('message', 'Kategori telah berhasil di update');
        return redirect('admin/sub-kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = SubKategori::find($id);
        $kategori->delete();
        return back()->with('message', 'Kategori telah dihapus');
    }
}
