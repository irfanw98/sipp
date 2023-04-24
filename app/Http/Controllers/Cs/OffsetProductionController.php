<?php

namespace App\Http\Controllers\Cs;

use App\Http\Controllers\Controller;
use App\Models\OffsetProduction;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OffsetProductionController extends Controller
{
    protected $OffsetProduction;

    public function __construct(OffsetProduction $OffsetProduction)
    {
        $this->OffsetProduction = $OffsetProduction;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of($this->OffsetProduction->getAllOffsetProduction())
                ->addColumn('production.jenis_produksi', function($row){
                    $result = [];
                    foreach ($row->production as $value) {
                        $result[] = $value->jenis_produksi;
                    };
                    return $result;
                })
                ->addColumn('aksi', function ($data) {
                    return '
                    <a href="" class="btn btn-warning edit_offsetproduction" role="button" id="' . $data->id . '">Ubah</a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('cs.offsetproduction.index');
    }

    public function edit($id)
    {
        $production = $this->OffsetProduction->getOffsetProductionById($id);

        if($production->status_produksi == '1')
        {
            return response()->json(['errors' => 'Produksi telah diselesaikan.']);
        } else {
            return view('cs.offsetproduction.edit', [
                'offsetproduction' => $this->OffsetProduction->getOffsetProductionById($id),
                'productions' => $this->OffsetProduction->getAllProductions()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $production = $this->OffsetProduction->getOffsetProductionById($id);

        if($production->status_produksi == '1'){
            return redirect('/schedule/productions');
        } else {
            $production->production()->sync($request->jenis_produksi);
            return redirect('/schedule/productions')->with('message', 'Jenis produksi berhasil diubah.');
        }
    }

    public function cetakpdf()
    {
        $offsetproductions = $this->OffsetProduction->getAllOffsetProduction()->toArray();
        $today = Carbon::now()->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('cs.offsetproduction.cetak_pdf', compact('offsetproductions', 'today'));
        return $pdf->download('productions.pdf');
    }
}