<?php

namespace App\Http\Controllers\Cs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offset;

class DashboardCsController extends Controller
{
    protected $Offset;

    public function __construct(Offset $Offset)
    {
        $this->Offset = $Offset;
    }

    public function index()
    {
        return view('cs.dashboard_cs', [
            'countOffsets'                 => $this->Offset->countOffsets(),
            'countOffsetProcess'           => $this->Offset->countOffsetProcess(),
            'countOffsetAccept'            => $this->Offset->countOffsetAccept(),
            'countOffsetProductionProcess' => $this->Offset->countOffsetProductionProcess(),
            'countOffsetProductionFinish'  => $this->Offset->countOffsetProductionFinish(),
            'countOffsetFinishingProcess'  => $this->Offset->countOffsetFinishingProcess(),
            'countOffsetFinishingFinish'   => $this->Offset->countOffsetFinishingFinish()
        ]);
    }
}