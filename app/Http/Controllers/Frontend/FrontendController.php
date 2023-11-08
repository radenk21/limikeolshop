<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Produk;
use App\Models\Slider;
use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

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

    public function kategori($kategori_slug)
    {
        $kategori = Kategori::where('slug', $kategori_slug)->first();

        if ($kategori) {
            $subKategoris = SubKategori::where('id_kategori', $kategori->id)->get();
            $produks = Produk::whereIn('id_sub_kategori', $subKategoris->pluck('id'))->get();
            $brands = $produks->groupBy('id_brand')->keys();
            $uniqueBrands = Brand::whereIn('id', $brands)->get();
            return view('frontend.collections.produks.index', compact('produks', 'kategori', 'subKategoris', 'uniqueBrands'));
        } else {
            return redirect()->back();
        }
    }

    public function subKategori($kategori_slug, $subkategori_slug)
    {
        $kategori = Kategori::where('slug', $kategori_slug)->first();
        $subKategori = SubKategori::where('slug', $subkategori_slug)->first();

        $produks = Produk::where('id_sub_kategori', $subKategori->id)->get();
        $brands = $produks->groupBy('id_brand')->keys();
        $uniqueBrands = Brand::whereIn('id', $brands)->get();

        return view('frontend.collections.subKategoris.index', compact('produks', 'kategori', 'subKategori', 'uniqueBrands'));
    }

    public function produkView($produk_slug)
    {
        $produk = Produk::where('slug', $produk_slug)->where('status', '0')->firstOrFail();
        // dd($produk);
        return view('frontend.collections.produks.view', compact('produk'));
    }
}
