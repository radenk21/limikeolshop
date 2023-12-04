<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReportPengeluaran;
use Illuminate\Http\Request;

class DataPembelianController extends Controller
{
    public function index(Request $request)
    {
        $reportPengeluarans = ReportPengeluaran::
                            when($request->awalDate != null && $request->akhirDate != null, function($q) use ($request) {
                                return $q->whereBetween('created_at', [$request->awalDate, $request->akhirDate]);
                            })->get();
                            
        return view('admin.report_pengeluaran.index', compact('reportPengeluarans'));
    }
}
