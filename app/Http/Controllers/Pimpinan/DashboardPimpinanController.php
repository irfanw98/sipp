<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Offset;
use Carbon\Carbon;

class DashboardPimpinanController extends Controller
{
    protected $Offset;

    public function __construct(Offset $Offset)
    {
        $this->Offset = $Offset;
    }

    public function index()
    {
        return view('pimpinan.dashboard_pimpinan', [
            'countOffsets'                 => $this->Offset->countOffsets(),
            'countOffsetProcess'           => $this->Offset->countOffsetProcess(),
            'countOffsetAccept'            => $this->Offset->countOffsetAccept(),
            'countOffsetProductionProcess' => $this->Offset->countOffsetProductionProcess(),
            'countOffsetProductionFinish'  => $this->Offset->countOffsetProductionFinish(),
            'countOffsetFinishingProcess'  => $this->Offset->countOffsetFinishingProcess(),
            'countOffsetFinishingFinish'   => $this->Offset->countOffsetFinishingFinish()
        ]);
    }

    public function cetakLaporan()
    {
        $offsets = $this->Offset->getAllOffsets()->get()->toArray();
        $today = Carbon::now()->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('pimpinan.cetak_laporan', compact('offsets','today'));
        return $pdf->download('laporan.pdf');
    }
}
