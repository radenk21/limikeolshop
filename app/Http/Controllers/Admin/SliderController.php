<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::orderBy('id')->simplePaginate(10);
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $path = 'uploads/slider/';
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'-'.uniqid().'.'.$ext;
            $file->move($path, $fileName);
            $validatedData['image'] = $path.$fileName;
        }
        
        $validatedData['status'] = $request->status == true ? '1' : '0';
        
        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status'],
        ]);

        return redirect('admin/slider')->with('message'. 'Slider berhasil ditambahkan');
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
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderFormRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $destination = $slider->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            
            $path = 'uploads/slider/';
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'-'.uniqid().'.'.$ext;
            $file->move($path, $fileName);
            $validatedData['image'] = $path.$fileName;
        }
        
        $validatedData['status'] = $request->status == true ? '1' : '0';
        
        Slider::where('id', $slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status'],
        ]);

        return redirect('admin/slider')->with('message'. 'Slider berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::find($id);
        $path = 'uploads/category/'.$slider->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $slider->delete();
        return back()->with('message', 'Slider telah dihapus');
    }
}
