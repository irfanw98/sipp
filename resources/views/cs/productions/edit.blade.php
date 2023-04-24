@extends('template.master_template')

@section('title', 'SIPP | Schedule - Productions')

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
                <h4 class="card-title">Ubah Produksi</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('productions.update', $production->id) }}" method="POST" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value="{{ $production->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="offset">Pekerjaan</label>
                                <select class="form-select" id="offset" name="offset">
                                    @foreach($offsets as $offset)
                                        <option value="{{ $offset->id }}"
                                            @if($production->offset_id  != $offset->id) 
                                                class="select" selected
                                            @endif
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
                            <select class="form-control jenis_produksi_multiple" id="jenis_produksi" name="jenis_produksi[]" multiple="multiple">
                                @php
                                    $JenisProduksi = json_decode($production->jenis_produksi)
                                @endphp
                                <option value="Laminasi Glossy" 
                                    @foreach($JenisProduksi as $value)
                                        @if($value == 'Laminasi Glossy') selected @endif
                                    @endforeach
                                >Laminasi Glossy</option>
                                <option value="Laminasi Doff" 
                                    @foreach($JenisProduksi as $value)
                                        @if($value == 'Laminasi Doff') selected @endif
                                    @endforeach
                                >Laminasi Doff</option>
                                <option value="Foil" 
                                    @foreach($JenisProduksi as $value)
                                        @if($value == 'Foil') selected @endif
                                    @endforeach
                                >Foil</option>
                                <option value="Emboss" 
                                    @foreach($JenisProduksi as $value)
                                        @if($value == 'Emboss') selected @endif
                                    @endforeach
                                >Emboss</option>
                                <option value="Pond" 
                                    @foreach($JenisProduksi as $value)
                                        @if($value == 'Pond') selected @endif
                                    @endforeach
                                >Pond</option>
                                <option value="Rell" 
                                    @foreach($JenisProduksi as $value)
                                        @if($value == 'Rell') selected @endif
                                    @endforeach
                                >Rell</option>
                                <option value="Lipat" 
                                    @foreach($JenisProduksi as $value)
                                        @if($value == 'Lipat') selected @endif
                                    @endforeach
                                >Lipat</option>
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