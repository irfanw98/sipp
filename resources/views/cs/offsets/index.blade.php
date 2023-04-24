@extends('template.master_template')

@section('title', 'SIPP | Schedule - Offsets')

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
                <h3>Divisi Offset</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <a href="" class="btn btn-success btn-refresh" role="button"><i class="fas fa-sync-alt"></i> Refresh</a>
                            <a href="{{ route('offsets.create') }}" name="csoffset_tambah" class="btn btn-primary me-1" role="button" style="color: white;">Tambah</a>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ route('offsets.cetakpdf') }}" name="csoffset_cetakpdf" class="btn btn-outline-danger" role="button"><i class="fa-solid fa-print"></i> Cetak Laporan</a>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover nowrap" id="table-cs-offsets" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Konsumen</th>
                                <th>Nama File</th>
                                <th>Jenis Bahan</th>
                                <th>Jenis Mesin</th>
                                <th>Qty</th>
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
        $('#table-cs-offsets').DataTable({
            responsive: true,
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('/schedule/offsets') }}",
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
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                }
            ],
            'columnDefs': [
                {
                    "targets": [0,6,7],
                    "className": "text-center",
                },
                {
                    "targets": [3],
                    render : function (data, type, row) {
                        if(row.jenis_bahan == 'art carton 190'){
                            return 'art carton 190'
                        } else if(row.jenis_bahan == 'art carton 210'){
                            return 'art carton 210'
                        } else if(row.jenis_bahan == 'art carton 230'){
                            return 'art carton 230'
                        } else if(row.jenis_bahan == 'art carton 260'){
                            return 'art carton 260'
                        } else {
                            return 'art carton 310'
                        }
                    }
                },
                {
                    "targets": [6],
                    render : function (data, type, row) {
                        if(row.status_offset == 0 ){
                            return '<p style="background-color:#FFCA2C; color:#fff; padding:2px; margin:auto; border-radius:2px;">Proses</p>'
                        } else{
                            return '<p style="background-color:#157347; color:#fff; padding:2px; margin:auto; border-radius:2px;">Terima</p>'
                        }
                    }
                }
            ],
        });
    })

    //Aler Check
    if ($("#alert" ).length) {
        setTimeout(() => {
            $('#alert').hide()
        }, 3000)
    }

    //Ubah Pekerjaan
    $('body').on('click', '.edit_csoffset', function(e){
        e.preventDefault()
        const id = $(this).attr('id')

        $.ajax({
            url: `{{ url('schedule/offsets/${id}/edit') }}`,
            method: 'GET',
            success: function(response){
                window.location.replace(`{{ url('schedule/offsets/${id}/edit') }}`)
            }
        })
    })

    //Hapus Pekerjaan
    $(document).on('click', '.hapus_csoffset', function(e){
        e.preventDefault()
        const id = $(this).attr('id')
        const no_nota = $(this).attr('no_nota')
        const nama_konsumen = $(this).attr('nama_konsumen')
        var confirmation = confirm(`Yakin, pekerjaan nomor nota (${no_nota}) - ${nama_konsumen} akan dihapus?`)

        if (confirmation) {
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `{{ url('/schedule/offsets/${id}') }}`,
                type: "POST",
                data: {
                    multi: null,
                    '_method': 'DELETE',
                    'id': id,
                },
                success: function(response){
                    $('#table-cs-offsets').DataTable().ajax.reload()

                    //show message
                    if(response.code === 200) {
                        $('#ajax-alert').addClass('alert-success alert-dismissible show fade').show(function(){
                            $(this).html(response.success)
                        })
                        setTimeout(() => {
                            $('#ajax-alert').hide()
                        }, 2000)
                    } else {
                        $('#ajax-alert').addClass('alert-danger alert-dismissible show fade').show(function(){
                            $(this).html(response.errors)
                        })
                    }
                }
            })
        }
    })

    //Refresh
    $(document).ready(function() {
        $('.btn-refresh').click(function(e) {
            e.preventDefault()
            $('#table-cs-offsets').DataTable().ajax.reload()
        })
    });
</script>
@endsection
