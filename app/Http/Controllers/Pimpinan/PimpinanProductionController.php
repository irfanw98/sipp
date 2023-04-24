<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\OffsetProduction;
use Carbon\Carbon;

class PimpinanProductionController extends Controller
{
    protected $PimpinanProduction;

    public function __construct(OffsetProduction $PimpinanProduction)
    {
        $this->PimpinanProduction = $PimpinanProduction;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            return DataTables::of($this->PimpinanProduction->getAllOffsetProduction())
            ->addColumn('jenis_produksi', function($row){
                $result = [];
                foreach ($row->production as $value) {
                    $result[] = $value->jenis_produksi;
                };
                return $result;
            })
            // ->addColumn('aksi', function ($data) {
            //     return '<a href="" class="btn btn-info accept_production" role="button" id="' . $data->id . '">Terima</a>';
            // })
            // ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('pimpinan.productions.index');
    }

    public function show($id)
    {
        //
    }

    public function cetakpdf()
    {
        $offsetproductions = $this->PimpinanProduction->getAllOffsetProduction()->toArray();
        $today = Carbon::now()->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('pimpinan.productions.cetak_pdf', compact('offsetproductions', 'today'));
        return $pdf->download('productions.pdf');
    }
}