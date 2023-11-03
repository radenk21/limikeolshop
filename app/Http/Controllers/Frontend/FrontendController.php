<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Produk;
use App\Models\Slider;
use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status','0')->get();
        return view('frontend.index', compact('sliders'));
    }

    public function kategoris()
    {
        $kategoris = Kategori::where('status', '0')->get();
        return view('frontend.collections.kategoris.index', compact('kategoris'));
    }

    public function produks($kategori_slug)
    {
        $kategori = Kategori::where('slug', $kategori_slug)->first();
        if ($kategori) {
            $subKategoris = SubKategori::where('id_kategori', $kategori->id)->get();
            $produks = Produk::whereIn('id_sub_kategori', $subKategoris->pluck('id'))->get();
            // dd($produks);
            return view('frontend.collections.produks.index', compact('produks', 'kategori', 'subKategoris'));
        } else {
            return redirect()->back();
        }
    }

    public function subKategoriProduks($kategori_slug, $subKategori_slug)
    {
        $subKategori = SubKategori::where('slug', $subKategori_slug)->first();
        $produks = Produk::where('id_sub_kategori', $subKategori->id)->get();
        return view('frontend.collections.subKategoris.index', compact('produks', 'subKategori'));
    }
}
