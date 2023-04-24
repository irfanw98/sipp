<?php

namespace App\Http\Controllers\KadivFinishing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offset;

class DashboardKadivFinishingController extends Controller
{
    protected $Offset;

    public function __construct(Offset $Offset)
    {
        $this->Offset = $Offset;
    }

    public function index()
    {
        return view('kadivfinishing.dashboard_kadivfinishing', [
            'countOffsetProductionFinish' => $this->Offset->countOffsetProductionFinish(),
            'countOffsetFinishingProcess' => $this->Offset->countOffsetFinishingProcess(),
            'countOffsetFinishingFinish' => $this->Offset->countOffsetFinishingFinish()
        ]);
    }
}