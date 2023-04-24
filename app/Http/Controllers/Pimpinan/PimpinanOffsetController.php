<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Offset;
use Carbon\Carbon;

class PimpinanOffsetController extends Controller
{
    protected $PimpinanOffset;

    public function __construct(Offset $PimpinanOffset)
    {
        $this->PimpinanOffset = $PimpinanOffset;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            return Datatables::of($this->PimpinanOffset->getAllOffsets())
            // ->addColumn('aksi', function ($data) {
            //     return '
            //     <a href="" class="btn btn-info accept_offset" role="button" id="' . $data->id . '"></a>
            // ';
            // })
            // ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('pimpinan.offsets.index');
    }

    public function show($id)
    {
        //
    }

    public function cetakpdf()
    {
        $offsets = $this->PimpinanOffset->getAllOffsets()->get()->toArray();
        $today = Carbon::now()->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('pimpinan.offsets.cetak_pdf', compact('offsets','today'));
        return $pdf->download('offsets.pdf');
    }
}
