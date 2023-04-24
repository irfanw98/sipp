@extends('template.master_template')

@section('title', 'SIPP | User-Admin')

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
                <h3>Data Pengguna</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <a href="{{ route('users.create') }}" name="user_tambah" class="btn btn-primary me-1 mb-3" role="button" style="color: white;">Tambah</a>
                    <table class="table table-bordered table-hover" id="table-users" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Jabatan</th>
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
        $('#table-users').DataTable({
            ordering: true,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('/users') }}",
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data:'role',
                    name:'role'
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
                    "targets": [0,4],
                    "className": "text-center",
                },
                {
                    "targets": [3],
                    render : function (data, type, row) {
                        if(row.role == 'admin' ){
                            return 'Admin'
                        } else if(row.role == 'customer_service'){
                            return 'Costumer Service'
                        } else if(row.role == 'kadiv_offset'){
                            return 'Kepala Divisi Offset'
                        } else if(row.role == 'kadiv_produksi'){
                            return 'Kepala Divisi Produksi'
                        } else if (row.role == 'kadiv_finishing'){
                            return 'Kepala Divisi Finishing'
                        } else {
                            return 'Pimpinan'
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

    //Ubah User
    $('body').on('click', '.edit_user', function(e) {
        e.preventDefault()
        const id = $(this).attr('id')

        $.ajax({
            url: `{{ url('users/${id}/edit') }}`,
            method: 'GET',
            success: function(response){
                window.location.replace(`{{ url('users/${id}/edit') }}`)
            }
        })
    })

    //Hapus user
    $(document).on('click', '.hapus_user', function(e) {
        e.preventDefault()
        const id = $(this).attr('id')
        const nama = $(this).attr('nama_user')
        const confirmation = confirm(`Yakin, pengguna ${nama} akan dihapus?`)

        if (confirmation) {
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `{{ url('/users/${id}') }}`,
                type: "POST",
                data: {
                    multi: null,
                    '_method': 'DELETE',
                    'id': id,
                },
                success: function(response){
                    $('#table-users').DataTable().ajax.reload()

                    //show message
                    if(response.success) {
                        $('#ajax-alert').removeClass('alert-danger')
                        $('#ajax-alert').addClass('alert-success alert-dismissible show fade').show(function(){
                            $(this).html(response.success)
                        })
                        setTimeout(() => {
                            $('#ajax-alert').hide()
                        }, 3000)
                    } else {
                        $('#ajax-alert').addClass('alert-danger alert-dismissible show fade').show(function(){
                            $(this).html(response.errors)
                        })
                        setTimeout(() => {
                            $('#ajax-alert').hide()
                        }, 3000)
                    }
                }
            })
        }
    })
</script>
@endsection
