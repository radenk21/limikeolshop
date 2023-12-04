<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReportPenjualan;
use Illuminate\Http\Request;

class DataPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $reportPenjualans = ReportPenjualan::
                            when($request->awalDate != null && $request->akhirDate != null, function($q) use ($request) {
                                return $q->whereBetween('tanggal', [$request->awalDate, $request->akhirDate]);
                            })->get();
                            
        return view('admin.report_penjualan.index', compact('reportPenjualans'));
    }
}
