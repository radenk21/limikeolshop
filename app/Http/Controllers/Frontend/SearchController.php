<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchProduks(Request $request)
    {
        // dd($request->all());
        if ($request->search_produk) {
            $produks = Produk::where('status', 0)->where('name', 'LIKE', '%'.$request->search_produk. '%')->latest()->paginate(15);
            return view('frontend.search-produks', compact('produks'));
        }else {
            
        }
    }
}
