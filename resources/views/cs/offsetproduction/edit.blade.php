@extends('template.master_template')

@section('title', 'SIPP | Schedule - Produksi')

@section('header')
<style>

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
                <form action="{{ route('productions.update', $offsetproduction->id) }}" method="POST" autocomplete="off">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" value="{{ $offsetproduction->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="jenis_produksi">Jenis Produksi</label>
                                <select class="form-select jenis_produksi_multiple" id="jenis_produksi" name="jenis_produksi[]" multiple="multiple">
                                    @foreach($productions as $production)
                                        <option value="{{ $production->id }}"
                                            @foreach($offsetproduction->production as $item)
                                                @if(in_array($production->id, old('jenis_produksi',[$item->id])))
                                                    selected
                                                @endif
                                            @endforeach    
                                        >{{ $production->jenis_produksi }}</option>
                                    @endforeach
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
        $('.jenis_produksi_multiple').select2()
    })
</script>
@endsection