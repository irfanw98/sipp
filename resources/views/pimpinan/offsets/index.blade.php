@extends('template.master_template')

@section('title', 'SIPP | Offset - Pimpinan')

@section('header')
<style>
    .page-heading {
        margin-top: -20px;
    },
</style>
@endsection

@section('content')
<div class="page-heading">
    {{-- Message --}}
    <div id="ajax-alert" class="alert" style="display:none"></div>
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible show fade" id="alert">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- End Message --}}

    <div class="page-title mb-2">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Offset</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-8">
                        <a href="" class="btn btn-warning btn-refresh mb-3" role="button"><i class="fas fa-sync-alt"></i> Refresh</a>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end pb-3">
                        <a href="{{ route('pimpinan.offsets') }}" name="pimpinanoffset_cetakpdf" class="btn btn-outline-danger" role="button"><i class="fa-solid fa-print"></i> Cetak Laporan</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover nowrap" id="table-pimpinan-offsets" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Konsumen</th>
                                <th>Nama File</th>
                                <th>Jenis Bahan</th>
                                <th>Jenis Mesin</th>
                                <th>Qty</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#table-pimpinan-offsets').DataTable({
            responsive: true,
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('pimpinan-offsets.index') }}",
                type: "GET",
                dataType: "JSON"
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_konsumen',
                    name: 'nama_konsumen'
                },
                {
                    data: 'nama_file',
                    name: 'nama_file'
                },
                {
                    data: 'jenis_bahan',
                    name: 'jenis_bahan'
                },
                {
                    data: 'jenis_mesin',
                    name: 'jenis_mesin'
                },
                {
                    data: 'qty',
                    name: 'qty'
                },
                {
                    data: 'status_offset',
                    name: 'status_offset'
                },
                // {
                //     data: 'aksi',
                //     name: 'aksi',
                //     orderable: false,
                //     searchable: false
                // }
            ],
            'columnDefs': [
                {
                    "targets": [0,6],
                    "className": "text-center",
                },
                {
                    "targets": [6],
                    render : function (data, type, row) {
                        if(row.status_offset == 0 ){
                            return '<p style="background-color:#FFCA2C; color:#fff; padding:2px; margin:auto; border-radius:2px;">Proses</p>'
                        } else{
                            return '<p style="background-color:#157347; color:#fff; padding:2px; margin:auto; border-radius:2px;">Diterima</p>'
                        }
                    }
                }
            ],
        });
    })

    $(document).ready(function() {
        $('.btn-refresh').click(function(e) {
            e.preventDefault()
            $('#table-pimpinan-offsets').DataTable().ajax.reload()
        })
    });
</script>
@endsection
