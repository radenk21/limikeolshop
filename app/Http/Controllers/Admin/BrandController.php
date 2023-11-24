<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('id')->simplePaginate(10);
        $offset = request()->get('page', 1) * $brands->perPage() - $brands->perPage();

        return view('admin.brand.index', compact('brands', 'offset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandFormRequest $request)
    {
        // dd($request->validated());
        $validatedData = $request->validated();
        Brand::create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'status' => $request->status == true ? '1' : '0',
        ]);
        return redirect()->route('brand.index')->with('message', 'Brand berhasil ditambahkan');
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
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandFormRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $brand = Brand::findOrFail($id);
        $brand->name = $validatedData['name'];
        $brand->slug = Str::slug($validatedData['slug']);
        $brand->status = $request->status == true ? '1' : '0';
        $brand->update();
        
        return redirect()->route('brand.index')->with('message', 'Brand telah diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return back()->with('message', 'Brand telah dihapus');
    }
}
