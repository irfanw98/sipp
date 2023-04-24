<?php

namespace App\Http\Controllers\Cs;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Offset;
use App\Http\Requests\Cs\{
    StoreOffsetRequest,
    UpdateOffsetRequest
};


class CsOffsetController extends Controller
{
    protected $CsOffset;

    public function __construct(Offset $CsOffset)
    {
        $this->CsOffset = $CsOffset;
    }

    public function index(Request $request)
    {
        $offsets = Offset::with('user')->orderBy('nama_konsumen', 'asc');

        if ($request->ajax()) {
            return DataTables::of($this->CsOffset->getAllOffsets())
                ->addColumn('aksi', function ($data) {
                    return '
                    <a href="" class="btn btn-warning edit_csoffset" role="button" id="' . $data->id . '">Ubah</a>
                    <a href="" class="btn btn-danger hapus_csoffset" role="button" id="' . $data->id . '" no_nota="' . $data->no_nota . '" nama_konsumen="' . $data->nama_konsumen . '">Hapus</a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('cs.offsets.index');
    }

    public function create()
    {
        return view('cs.offsets.create', [
            'productions' => $this->CsOffset->getAllProductions(),
            'finishings'  => $this->CsOffset->getAllFinishings()
        ]);
    }

    public function store(StoreOffsetRequest $request)
    {
        $offsets = Offset::create([
            'user_id'       => Auth::user()->id,
            'no_nota'       => $request->no_nota,
            'nama_konsumen' => $request->nama_konsumen,
            'nama_file'     => $request->nama_file,
            'jenis_bahan'   => $request->jenis_bahan,
            'jenis_mesin'   => $request->jenis_mesin,
            'qty'           => $request->qty,
        ]);

        $offsets->production()->sync($request->jenis_produksi);
        $offsets->finishing()->sync($request->jenis_finishing);

        return redirect('/schedule/offsets')->with('message', 'Pekerjaan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('cs.offsets.edit', [
            'offset'        => $this->CsOffset->getOffsetById($id),
            'productions'   => $this->CsOffset->getAllProductions(),
            'finishings'    => $this->CsOffset->getAllFinishings()
        ]);
    }

    public function update(UpdateOffsetRequest $request, $id)
    {
        $offset = $this->CsOffset->getOffsetById($id);

        $offset->update([
            'no_nota'       => $request->no_nota,
            'nama_konsumen' => $request->nama_konsumen,
            'nama_file'     => $request->nama_file,
            'jenis_bahan'   => $request->jenis_bahan,
            'jenis_mesin'   => $request->jenis_mesin,
            'qty'           => $request->qty,
        ]);

        $offset->production()->sync($request->jenis_produksi);
        $offset->finishing()->sync($request->jenis_finishing);

        return redirect('/schedule/offsets')->with('message', 'Pekerjaan berhasil diubah.');
    }

    public function destroy($id)
    {
        $this->CsOffset->getOffsetById($id)->delete();

        return response()->json(['code'=>200,'success' => 'Pekerjaan berhasil dihapus.']);
    }

    public function cetakpdf()
    {
        $offsets = $this->CsOffset->getAllOffsets()->get()->toArray();
        $today = Carbon::now()->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('cs.offsets.cetak_pdf', compact('offsets','today'));
        return $pdf->download('offsets.pdf');
    }
}
