<?php

namespace App\Http\Controllers\Cs;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Finishing;

class CsFinishingController extends Controller
{
    protected $CsFinishing;

    public function __construct(Finishing $CsFinishing)
    {
        $this->CsFinishing = $CsFinishing;
    }

    public function index(Request $request)
    {
        // dd($this->CsFinishing->getAllProduction());
        if($request->ajax()){
            return Datatables::of($this->CsFinishing->getAllFinishings())
                ->addColumn('jenis_finishing', function($row){
                    return  str_replace(array('"', '[',']'), " ", $row->jenis_finishing);
                })
                ->addColumn('nama_file', function($row) {
                    return $row->production->offset->nama_file;
                })
                ->addColumn('konsumen', function($row) {
                    return $row->production->offset->nama_konsumen;
                })
                ->addColumn('jenis_bahan', function($row) {
                    return $row->production->offset->jenis_bahan;
                })
                ->addColumn('qty', function($row) {
                    return $row->production->offset->qty;
                })
                ->addColumn('aksi', function ($data) {
                    return '
                    <a href="" class="btn btn-warning edit_csfinishing" role="button" id="' . $data->id . '">Ubah</a>
                    <a href="" class="btn btn-danger hapus_csfinishing" role="button" id="' . $data->id . '" nama_konsumen="' . $data->production->offset->nama_konsumen . '" nama_file="' . $data->production->offset->nama_file . '">Hapus</a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('cs.finishings.index');
    }

    public function create()
    {
        return view('cs.finishings.create', [
            'finishings'  => $this->CsFinishing->getAllFinishings(),
            'productions' => $this->CsFinishing->getAllProductions()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}