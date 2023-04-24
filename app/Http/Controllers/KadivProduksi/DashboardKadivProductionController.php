<?php

namespace App\Http\Controllers\KadivProduksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offset;

class DashboardKadivProductionController extends Controller
{
    protected $Offset;

    public function __construct(Offset $Offset)
    {
        $this->Offset = $Offset;
    }

    public function index()
    {
        return view('kadivproduction.dashboard_kadivproduction', [
            'countOffsetAccept' => $this->Offset->countOffsetAccept(),
            'countOffsetProductionProcess' => $this->Offset->countOffsetProductionProcess(),
            'countOffsetProductionFinish' => $this->Offset->countOffsetProductionFinish()
        ]);
    }
}