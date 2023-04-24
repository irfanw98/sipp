<?php

namespace App\Http\Controllers\KadivProduksi;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\OffsetProduction;

class KadivProductionController extends Controller
{
    protected $kadivProduction;

    public function __construct(OffsetProduction $kadivProduction)
    {
        $this->kadivProduction = $kadivProduction;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of($this->kadivProduction->getAllOffsetProduction())
            ->addColumn('jenis_produksi', function($row){
                $result = [];
                foreach ($row->production as $value) {
                    $result[] = $value->jenis_produksi;
                };
                return $result;
            })
            ->addColumn('aksi', function ($data) {
                return '<a href="" class="btn btn-primary accept_production" role="button" id="' . $data->id . '" nama_konsumen="' . $data->nama_konsumen . '" nama_file="' . $data->nama_file . '">Terima</a>';
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('kadivproduction.produksi.index');
    }

    public function update($id)
    {
        $kadivProduction = $this->kadivProduction->getOffsetProductionById($id);

        if($kadivProduction->status_produksi == '0'){
            $kadivProduction->status_produksi = '1';
            $kadivProduction->save();

            return response()->json(['success' => 'Produksi berhasil diterima.']);
        } 
            return response()->json(['errors' => 'Produksi sudah diterima sebelumnya.']);
    }
}