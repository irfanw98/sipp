<?php

namespace App\Http\Controllers\KadivOffset;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Offset;

class KadivOffsetController extends Controller
{
    protected $kadivOffset;

    public function __construct(Offset $kadivOffset)
    {
        $this->kadivOffset = $kadivOffset;
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of($this->kadivOffset->getAllOffsets())
                ->addColumn('aksi', function ($data) {
                    return '
                    <a href="" class="btn btn-primary accept_offset" role="button" id="' . $data->id . '" nama_cs="' . $data->user->name . '" nama_konsumen="' . $data->nama_konsumen . '" nama_file="' . $data->nama_file . '" no_nota="' . $data->no_nota . '">Terima</a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('kadivoffset.offset.index');
    }

    public function update($id)
    {
        $kadivOffset = $this->kadivOffset->getOffsetById($id);

        if($kadivOffset->status_offset == '0'){
            $kadivOffset->status_offset = '1';
            $kadivOffset->save();

            return response()->json(['success' => 'Pekerjaan berhasil diterima.']);
        } else{
            return response()->json(['errors' => 'Pekerjaan sudah diterima sebelumnya.']);
        }
    }
}