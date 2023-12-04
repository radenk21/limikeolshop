<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierFormRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('id','DESC')->get();
        
        return view('admin.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierFormRequest $request)
    {
        $validatedData = $request->validated();
        Supplier::create($validatedData);
        return redirect('admin/supplier')->with('message', 'Distributor berhasil ditambahkan');
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
    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierFormRequest $request, $id)
    {
        $validatedData = $request->validated();
        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'no_telp' => $validatedData['no_telp'],
            'alamat' => $validatedData['alamat'],
        ]);

        return redirect('admin/supplier')->with('message','Supplier berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        
        return back()->with('message', 'Supplier telah dihapus');
    }
}
