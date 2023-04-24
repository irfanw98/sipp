@extends('template.master_template')

@section('title', 'SIPP | User-Admin')

@section('header')
<style>

</style>
@endsection

@section('content')
<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ubah Pengguna</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST" autocomplete="off">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                @error('name')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role">Jabatan</label>
                                <select class="form-select" id="role" name="role">
                                    <option value="" disabled>--Pilih Jabatan--</option>
                                    <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                    <option value="pimpinan" @if($user->role == 'pimpinan') selected @endif>Pimpinan</option>
                                    <option value="customer_service" @if($user->role == 'customer_service') selected @endif>Customer Service</option>
                                    <option value="kadiv_offset" @if($user->role == 'kadiv_offset') selected @endif>Kepala Divisi Offset</option>
                                    <option value="kadiv_produksi" @if($user->role == 'kadiv_produksi') selected @endif>Kepala Divisi Produksi</option>
                                    <option value="kadiv_finishing" @if($user->role == 'kadiv_finishing') selected @endif>Kepala Divisi Finishing</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                                @error('username')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                                @error('password')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                @error('email')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 d-flex justify-content-start mt-2">
                            <p><strong>*Note: Kosongkan password, jika tidak ingin ganti password!.</strong></p>
                        </div>
                        <div class="col-6 d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger me-1 mb-1">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script>

</script>
@endsection