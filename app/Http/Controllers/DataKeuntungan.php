<?php

namespace App\Http\Controllers;

use App\Models\ReportKeuntungan;
use Illuminate\Http\Request;

class DataKeuntungan extends Controller
{
    public function index(Request $request)
    {
        $reportKeuntungans = ReportKeuntungan::
                            when($request->awalDate != null && $request->akhirDate != null, function($q) use ($request) {
                                return $q->whereBetween('tanggal', [$request->awalDate, $request->akhirDate]);
                            })->get();
                            
        return view('admin.report_keuntungan.index', compact('reportKeuntungans'));
    }
}
