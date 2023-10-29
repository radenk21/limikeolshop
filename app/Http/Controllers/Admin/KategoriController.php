<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\KategoriFormRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::orderBy('id', 'DESC')->simplePaginate(10);
        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriFormRequest $request)
    {
        $validatedData = $request->validated();
        $kategori = new Kategori();
        $kategori->name = $validatedData['name'];
        $kategori->slug = Str::slug($validatedData['slug']);
        $kategori->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/category', $filename);
            $kategori->image = $filename;
        }

        // $kategori->meta_title = $validatedData['meta_title'];
        // $kategori->meta_keyword = $validatedData['meta_keyword'];
        // $kategori->meta_description = $validatedData['meta_description'];
        $kategori->status = $request->status == true ? '1' : '0';
        $kategori->save();
        session()->flash('message', 'Kategori telah ditambahkan');
        return redirect('admin/kategori');
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
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriFormRequest $request, $id)
    {
        $validatedData = $request->validated();
        $kategori = Kategori::findOrFail($id);
        $kategori->name = $validatedData['name'];
        $kategori->slug = Str::slug($validatedData['slug']);
        $kategori->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            $path = 'uploads/category'.$kategori->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/category', $filename);
            $kategori->image = $filename;
        }

        // $kategori->meta_title = $validatedData['meta_title'];
        // $kategori->meta_keyword = $validatedData['meta_keyword'];
        // $kategori->meta_description = $validatedData['meta_description'];
        $kategori->status = $request->status == true ? '1' : '0';
        $kategori->update();
        session()->flash('message', 'Kategori telah berhasil di update');
        return redirect('admin/kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $path = 'uploads/category/'.$kategori->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $kategori->delete();
        return back()->with('message', 'Kategori telah dihapus');
    }
}
