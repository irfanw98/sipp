<?php

namespace App\Http\Controllers\Cs;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Production;

class CsProductionController extends Controller
{
    protected $CsProduction;

    public function __construct(Production $CsProduction)
    {
        $this->CsProduction = $CsProduction;
    }

    public function index(Request $request)
    {
        // dd($this->CsProduction->getAllOffsets());
        if ($request->ajax()) {
            return DataTables::of($this->CsProduction->getAllProductions())
                ->addColumn('jenis_produksi', function($row){
                    return  str_replace(array('"', '[',']'), " ", $row->jenis_produksi);
                })
                ->addColumn('nama_file', function($row) {
                    return $row->offset->nama_file;
                })
                ->addColumn('konsumen', function($row) {
                    return $row->offset->nama_konsumen;
                })
                ->addColumn('jenis_bahan', function($row) {
                    return $row->offset->jenis_bahan;
                })
                ->addColumn('qty', function($row) {
                    return $row->offset->qty;
                })
                ->addColumn('aksi', function ($data) {
                    return '
                    <a href="" class="btn btn-warning edit_csproduction" role="button" id="' . $data->id . '">Ubah</a>
                    <a href="" class="btn btn-danger hapus_csproduction" role="button" id="' . $data->id . '" nama_konsumen="' . $data->offset->nama_konsumen . '" nama_file="' . $data->offset->nama_file . '">Hapus</a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('cs.productions.index');
    }

    public function create()
    {
        return view('cs.productions.create', [
            'productions' => $this->CsProduction->getAllProductions(),
            'offsets'     => $this->CsProduction->getAllOffsets()
        ]);
    }

    public function store(Request $request)
    {
        Production::create([
            'offset_id'      => $request->offset,
            'jenis_produksi' => json_encode($request->jenis_produksi),
            'status'         => '0'
        ]);

        return redirect('/schedule/productions')->with('message', 'Produksi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('cs.productions.edit', [
            'offsets'    => $this->CsProduction->getAllOffsets(),
            'production' => $this->CsProduction->getProductionById($id),
        ]);
    }

    public function update(Request $request, $id)
    {

        $this->CsProduction->getProductionById($id)->update([
            'jenis_produksi' => json_encode($request->jenis_produksi),
        ]);

        return redirect('/schedule/productions')->with('message', 'Produksi berhasil diubah.');
    }

    public function destroy($id)
    {
        $this->CsProduction->getProductionById($id)->delete();

        return response()->json(['code'=>200,'success' => 'Produksi berhasil dihapus.']);
    }
}