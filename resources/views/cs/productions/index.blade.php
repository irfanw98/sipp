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
                    <a href="" class="btn btn-success btn-refresh mb-3" role="button"><i class="fas fa-sync-alt"></i> Refresh</a>
                    <a href="{{ route('productions.create') }}" name="user_tambah" class="btn btn-primary me-1 mb-3" role="button" style="color: white;">Tambah</a>
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
                    name: 'DT_RowIndex'
                },
                {
                    data: 'konsumen',
                    name: 'konsumen'
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
                    data: 'jenis_produksi',
                    name: 'jenis_produksi'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
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
                        if(row.status == 0 ){
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
        }, 2000)
    }

    //Ubah Produksi
    $('body').on('click', '.edit_csproduction', function(e){
        e.preventDefault()
        const id = $(this).attr('id')
        
        $.ajax({
            url: `{{ url('schedule/productions/${id}/edit') }}`,
            method: 'GET',
            success: function(response){
                window.location.replace(`{{ url('schedule/productions/${id}/edit') }}`)
            }
        })
    })

    //Hapus Produksi
    $(document).on('click', '.hapus_csproduction', function(e){
        e.preventDefault()
        const id = $(this).attr('id')
        const nama_konsumen = $(this).attr('nama_konsumen')
        const nama_file = $(this).attr('nama_file')
        const confirmation = confirm(`Yakin ${nama_konsumen} - ${nama_file}, pada proses produksi akan dihapus?`)

        if (confirmation) {
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `{{ url('/schedule/productions/${id}') }}`,
                type: "POST",
                data: {
                    multi: null,
                    '_method': 'DELETE',
                    'id': id,
                },
                success: function(response){
                    $('#table-cs-productions').DataTable().ajax.reload()

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
            $('#table-cs-productions').DataTable().ajax.reload()
        })
    });
</script>
@endsection