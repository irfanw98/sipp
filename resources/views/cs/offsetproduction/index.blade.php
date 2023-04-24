@extends('template.master_template')

@section('title', 'SIPP | Schedule - Produksi')

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
                <h3>Divisi Produksi</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row mb-2">
                        <div class="col-md-8">
                            <a href="" class="btn btn-success btn-refresh mb-3" role="button"><i class="fas fa-sync-alt"></i> Refresh</a>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end pb-3">
                            <a href="{{ route('productions.cetakpdf') }}" name="csproduction_cetakpdf" class="btn btn-outline-danger" role="button"><i class="fa-solid fa-print"></i> Cetak Laporan</a>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover nowrap" id="table-cs-productions" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Konsumen</th>
                                <th>Nama File</th>
                                <th>Jenis Bahan</th>
                                <th>Qty</th>
                                <th>Jenis Produksi</th>
                                <th>Status</th>
                                <th>Aksi</th>
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
        $('#table-cs-productions').DataTable({
            responsive: true,
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('/schedule/productions') }}",
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
                    data: 'qty',
                    name: 'qty'
                },
                {
                    data: 'production.jenis_produksi',
                    name: 'production.jenis_produksi'
                },
                {
                    data: 'status_produksi',
                    name: 'status_produksi'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                },
            ],
            'columnDefs': [
                {
                    "targets": [0,6,7],
                    "className": "text-center",
                },
                {
                    "targets": [6],
                    render: function(data, type, row){
                        if(row.status_produksi   == 0 ){
                            return '<p style="background-color:#FFCA2C; color:#fff; padding:2px; margin:auto; border-radius:2px;">Proses</p>'
                        } else{
                            return '<p style="background-color:#157347; color:#fff; padding:2px; margin:auto; border-radius:2px;">Selesai</p>'
                        }
                    }
                }
            ]
        })
    })

    //Aler Check
        if ($( "#alert" ).length) {
        setTimeout(() => {
            $('#alert').hide()
        }, 3000)
    }

    //Ubah Jenis Produksi
    $(document).on('click', '.edit_offsetproduction', function(e){
        e.preventDefault()
        const id = $(this).attr('id')

        $.ajax({
            url: `{{ url('schedule/productions/${id}/edit') }}`,
            method: 'GET',
            success: function(response){
                if(response.errors)
                {
                    $('#table-cs-productions').DataTable().ajax.reload()
                    $('#ajax-alert').addClass('alert-danger alert-dismissible show fade').show(function(){
                        $(this).html(response.errors)
                    })
                    setTimeout(() => {
                        $('#ajax-alert').hide()
                    }, 3000)
                } else {
                    window.location.replace(`{{ url('schedule/productions/${id}/edit') }}`)
                }
            }
        })
    })

    //Refresh
    $(document).ready(function() {
        $('.btn-refresh').click(function(e) {
            e.preventDefault()
            $('#table-cs-productions').DataTable().ajax.reload()
        })
    });
</script>
@endsection
