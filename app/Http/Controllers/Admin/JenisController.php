<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisFormRequest;
use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jeniss = Jenis::orderBy('id')->simplePaginate(10);
        return view('admin.jenis.index', compact('jeniss'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jenis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JenisFormRequest $request)
    {
        $validatedData = $request->validated();
        Jenis::create([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'status' => $request->status == true ? '1' : '0',
        ]);
        return redirect()->route('jenis.index')->with('mssage', 'Jenis berhasil ditambahkan');
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
    public function edit(Jenis $jenis)
    {
        return view('admin.jenis.edit', compact('jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JenisFormRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $jenis = Jenis::findOrFail($id);
        $jenis->name = $validatedData['name'];
        $jenis->code = $validatedData['code'];
        $jenis->status = $request->status == true ? '1' : '0';
        $jenis->update();
        
        return redirect()->route('jenis.index')->with('message', 'Jenis telah diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenis = Jenis::findOrFail($id);
        $jenis->delete();

        return back()->with('message', 'Jenis telah dihapus');
    }
}
