<?php

namespace App\Http\Controllers\KadivFinishing;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\OffsetFinishing;

class KadivFinishingController extends Controller
{
    protected $KadivFinishing;

    public function __construct(OffsetFinishing $KadivFinishing)
    {
        $this->KadivFinishing = $KadivFinishing;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of($this->KadivFinishing->getAllOffsetFinishing())
                ->addColumn('jenis_finishing', function($row){
                    $result = [];
                    foreach ($row->finishing as $value) {
                        $result[] = $value->jenis_finishing;
                    };
                    return $result;
                })
                ->addColumn('aksi', function ($data) {
                    return '
                    <a href="" class="btn btn-primary accept_finishing" role="button" id="' . $data->id . '" nama_konsumen="' . $data->nama_konsumen . '" nama_file="' . $data->nama_file . '">Terima</a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('kadivfinishing.finishing.index');
    }

    public function update(Request $request, $id)
    {
        $kadivFinishing = $this->KadivFinishing->getOffsetFinishingById($id);

        if ($kadivFinishing->status_finishing == '0') 
        {
            $kadivFinishing->status_finishing = '1';
            $kadivFinishing->save();
            
            return response()->json(['success' => 'Finishing berhasil diterima.']);
        }
            return response()->json(['errors' => 'Finishing sudah diterima sebelumnya.']);
    }
}