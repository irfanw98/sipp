<?php

namespace App\Http\Controllers\KadivOffset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offset;

class DashboardKadivOffsetController extends Controller
{
    protected $Offset;

    public function __construct(Offset $Offset)
    {
        $this->Offset = $Offset;
    }

    public function index()
    {
        return view('kadivoffset.dashboard_kadivoffset', [
            'countOffsets' => $this->Offset->countOffsets(),
            'countOffsetProcess' => $this->Offset->countOffsetProcess(),
            'countOffsetAccept' => $this->Offset->countOffsetAccept()

        ]);
    }
}
