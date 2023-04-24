@extends('template.master_template')

@section('title', 'SIPP | Schedule - Finishing')

@section('header')
<style>
    .page-heading {
        margin-top: -20px;
    },
</style>
@endsection

@section('content')
<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Finishing</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="production">Produksi</label>
                                <select class="form-select select2multiple" id="production" name="production">
                                    <option value="" disabled="" selected="">--Pilih Produksi--</option>
                                    @foreach($offsets as $offset)
                                        <option value="{{ $offset->id }}"
                                            @foreach($productions as $production)
                                                @if($offset->id == $production->offset_id)
                                                    class="select"
                                                @endif
                                            @endforeach
                                            >{{ $offset->nama_konsumen }} - {{ $offset->no_nota }}</option>
                                    @endforeach
                                </select>
                                @error('offset')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="jenis_produksi">Jenis Produksi</label>
                            <select class="form-select jenis_produksi_multiple" id="jenis_produksi" name="jenis_produksi[]" multiple="multiple">
                                <option value="Laminasi Glossy">Laminasi Glossy</option>
                                <option value="Laminasi Doff">Laminasi Doff</option>
                                <option value="Foil">Foil</option>
                                <option value="Emboss">Emboss</option>
                                <option value="Pond">Pond</option>
                                <option value="Rell">Rell</option>
                                <option value="Lipat">Lipat</option>
                            </select>
                            @error('jenis_produksi')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end mt-2">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                        <a href="{{ route('productions.index') }}" class="btn btn-danger me-1 mb-1">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.select2multiple').select2();
        $('.jenis_produksi_multiple').select2();
        $('.select', this).remove();
    })

    </script>
@endsection