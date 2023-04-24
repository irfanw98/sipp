<?php

namespace App\Http\Controllers\Cs;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\OffsetFinishing;

class OffsetFinishingController extends Controller
{
    protected $OffsetFinishing;

    public function __construct(OffsetFinishing $OffsetFinishing)
    {
        $this->OffsetFinishing = $OffsetFinishing;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of($this->OffsetFinishing->getAllOffsetFinishing())
                ->addColumn('finishing.jenis_finishing', function($row){
                    $result = [];
                    foreach ($row->finishing as $value) {
                        $result[] = $value->jenis_finishing;
                    };
                    return $result;
                })
                ->addColumn('aksi', function ($data) {
                    return '
                    <a href="" class="btn btn-warning edit_offsetfinishing" role="button" id="' . $data->id . '">Ubah</a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('cs.offsetfinishing.index');
    }

    public function edit($id)
    {
        $finishing = $this->OffsetFinishing->getOffsetFinishingById($id);

        if ($finishing->status_finishing == '1') {
            return response()->json(['errors' => 'Finishing telah diselesaikan.']);
        } else {
            return view('cs.offsetfinishing.edit', [
                'offsetfinishing' => $this->OffsetFinishing->getOffsetFinishingById($id),
                'finishings' => $this->OffsetFinishing->getAllFinishings()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $finishing = $this->OffsetFinishing->getOffsetFinishingById($id);

        if ($finishing->status_finishing == '1') {
            return redirect('/schedule/finishings');
        } else {
            $finishing->finishing()->sync($request->jenis_finishing);
            return redirect('/schedule/finishings')->with('message', 'Jenis finishing berhasil diubah.');
        }
    }

    public function cetakpdf()
    {
        $offsetfinishings = $this->OffsetFinishing->getAllOffsetFinishing()->get()->toArray();
        $today = Carbon::now()->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('cs.offsetfinishing.cetak_pdf', compact('offsetfinishings','today'));
        return $pdf->download('finishings.pdf');
    }
}