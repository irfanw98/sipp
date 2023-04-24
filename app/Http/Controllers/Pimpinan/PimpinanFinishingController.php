<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\OffsetFinishing;
use Carbon\Carbon;

class PimpinanFinishingController extends Controller
{
    protected $PimpinanFinishing;

    public function __construct(OffsetFinishing $PimpinanFinishing)
    {
        $this->PimpinanFinishing = $PimpinanFinishing;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of($this->PimpinanFinishing->getAllOffsetFinishing())
                ->addColumn('jenis_finishing', function($row){
                    $result = [];
                    foreach ($row->finishing as $value) {
                        $result[] = $value->jenis_finishing;
                    };
                    return $result;
                })
                // ->addColumn('aksi', function ($data) {
                //     return '
                //     <a href="" class="btn btn-primary accept_finishing" role="button" id="' . $data->id . '">Terima</a>
                // ';
                // })
                // ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pimpinan.finishings.index');
    }


    public function show($id)
    {
        //
    }

    public function cetakpdf()
    {
        $offsetfinishings = $this->PimpinanFinishing->getAllOffsetFinishing()->get()->toArray();
        $today = Carbon::now()->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('pimpinan.finishings.cetak_pdf', compact('offsetfinishings','today'));
        return $pdf->download('finishings.pdf');
    }
}